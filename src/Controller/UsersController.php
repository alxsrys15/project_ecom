<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter (Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'login', 'logout']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
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
            'contain' => [],
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
    
    public function login () {
        if ($this->Auth->User('id')) {
            return $this->redirect($this->Auth->User('is_admin') ? '/admin' : ['controller' => 'Home']);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($user['is_admin'] ? '/admin' : ['controller' => 'Home']);
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function register () {
        $errors = [];
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['invite_code'])) {
                $recruiter = $this->Users->getUserId($data['invite_code']);
                $data['invited_by'] = $recruiter;
            }
            unset($data['invite_code']);
            $newUser = $this->Users->newEntity($data);
            $errors = $newUser->getErrors();
            if ($this->Users->save($newUser)) {
                $this->Flash->success(__('Registration successful.'));
                $this->redirect(['action' => 'login']);
            }
        }
        $this->set(compact('errors'));
    }

    public function logout () {
        $this->Auth->logout();
        return $this->redirect('/');
    }

    public function activateAccount () {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $query = $this->Users->ActivationCodes->findByCode($this->request->data['activation_code']);
            
            if ($query->first()) {
                $code = $query->first();
                $code->is_used = 1;
                $user = $this->Users->get($this->Auth->User('id'));
                $user->is_active = 1;
                $user->coins_balance += 500;
                if ($user->invited_by) {
                    $recruiter = $this->Users->find('all')
                        ->where(['id' => $user->invited_by])
                        ->contain(['ChildUsers'])
                        ->first();
                    if (count($recruiter->child_users) === 0) {
                        $user->parent_id = $recruiter->id;
                    }
                }

                if ($this->Users->save($user) && $this->Users->ActivationCodes->save($code)) {
                    $this->Auth->setUser($user);
                    if ($user->invited_by) {
                        $this->Users->adjustCoins($user->invited_by);
                    }

                    $this->Flash->success('Account activated');
                    return $this->redirect(['controller' => 'Home']);
                }
            }
            $this->Flash->error('Invalid code');
            return $this->redirect(['controller' => 'Home']);
        }
    }
}
