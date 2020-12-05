<?php
namespace App\Controller\Profile;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function profile()
    {
        $user = $this->Users->get($this->Auth->User('id'), [
            'contain' => ['ChildUsers', 'ChildUsers.ChildUsers']
        ]);
        
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $avatar = $data['avatar_image'];
            unset($data['avatar_image']);
            $arr_ext = ['jpg', 'jpeg', 'png'];
            if (!empty($avatar['name'])) { //upload file
                if (in_array(pathinfo($avatar['name'], PATHINFO_EXTENSION), $arr_ext)) {
                    if (move_uploaded_file($avatar['tmp_name'], WWW_ROOT . '/img/profile_images/' . $avatar['name'])) {
                        $data['avatar_image'] = $avatar['name'];
                    }
                } else {
                    $this->Flash->error('Wrong image format');
                    return $this->redirect('/profile');
                }
            }
            $updateUser = $this->Users->patchEntity($user, $data, ['validation' => false]);
            if ($this->Users->save($updateUser)) {
                $user = $updateUser;
                $this->Flash->success('Profile updated.');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['PostComments', 'Posts'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function assignUser () {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $unassigned_user = $this->Users->get($data['unassigned_id']);
            $unassigned_user->parent_id = $data['parent_id'];
            if ($this->Users->save($unassigned_user)) {
                $this->Users->adjustCoinsByPairing($data['parent_id']);
                $this->Flash->success('User successfully assigned.');
                return $this->redirect(['action' => 'myNetwork']);
            }
        }
    }

    public function changePassword ($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $user = $this->Users->get($user_id);
            if ($this->checkPassword($user->password, $this->request->data['current_pass'])) {
                $user->password = $this->request->data['password1'];
                if ($this->Users->save($user)) {
                    $this->Flash->success('Password changed');
                }
            } else {
                $this->Flash->error('Incorrect password');
            }
            return $this->redirect(['action' => 'profile']);
        }
    }

    private function checkPassword ($password, $input_password) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->check($input_password, $password);
    }

    public function myNetwork () {
        $a = $this->Users;
        $a->recover();
        $q = $this->Users->find('children', [
            'for' => $this->Auth->User('id'), 
            'contain' => [
                'ParentUsers' => [
                    'fields' => [
                        'first_name', 
                        'last_name', 
                        'id'
                    ]
                ]
            ]
        ])
        ->find('threaded')
        ->where(['Users.level <=' => 4])
        ->toArray();
        $children = $this->Users->find('children', [
            'for' => $this->Auth->User('id'),
            'contain' => [
                'ChildUsers'
            ],

        ]);

        $unassigned_users = $this->Users->find('all', [
                'conditions' => [
                    'is_active' => 1,
                    'invited_by' => $this->Auth->User('id')
                ]
            ])
            ->where(function ($q) {
                return $q->isNull('parent_id');
            });
        
        // pr($unassigned_users);die();
        $open_users = [];
        $unassigned_list = [];
        $completePath = $this->Users->find('all', [
            'contain' => [
                'ParentUsers'
            ]
        ]);
        if (count($q) < 2) {
            $open_users[$this->Auth->User('id')] = $this->Auth->User('first_name') . ' ' . $this->Auth->User('last_name');

        }
        foreach ($children as $child) {
            if (count($child->child_users) < 2) {
                $open_users[$child->id] = $child->first_name . ' ' . $child->last_name;
            }
        }
        foreach ($unassigned_users as $user) {
            $unassigned_list[$user->id] = $user->first_name . ' ' . $user->last_name;
        }
        $data = [
            'level_0' => [
                'first_name' => $this->Auth->User('first_name'),
                'last_name' => $this->Auth->User('last_name'),
            ]
        ];

        foreach ($q as $child) {
            
            $data['level_1'][] = [
                'first_name' => $child->first_name,
                'last_name' => $child->last_name,
                'lft' => $child->lft,
                'rght' => $child->rght
            ];
            if ($child->has('children')) {
                foreach ($child->children as $child2) {
                    $data['level_2'][] = [
                        'first_name' => $child2->first_name,
                        'last_name' => $child2->last_name,
                        'lft' => $child2->lft,
                        'rght' => $child2->rght
                    ];
                    if ($child2->has('children')) {
                        foreach ($child2->children as $child3) {
                            $data['level_3'][] = [
                                'first_name' => $child3->first_name,
                                'last_name' => $child3->last_name,
                                'lft' => $child3->lft,
                                'rght' => $child3->rght
                            ];
                            if ($child3->has('children')) {
                                foreach ($child3->children as $child4) {
                                    $data['level_4'][] = [
                                        'first_name' => $child4->first_name,
                                        'last_name' => $child4->last_name,
                                        'lft' => $child4->lft,
                                    'rght' => $child3->rght
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->set(compact('q', 'data', 'open_users', 'unassigned_list'));
    }
}
