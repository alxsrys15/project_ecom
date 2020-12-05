<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function beforeFilter (Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view']);
    }

    public function index()
    {
        $query = $this->Posts->find('all', [
            'order' => [
                'Posts.modified' => 'DESC'
            ],
            'contain' => [
                'Users'
            ]
        ]);

        if (isset($this->request->query['s']) && !empty($this->request->query['s'])) {
            $query->where(['title LIKE' => '%'.$this->request->query['s'].'%']);
        }

        $posts = $this->paginate($query, ['limit' => 9]);

        $this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users']
        ]);

        $query = $this->Posts->PostComments->find('all', [
            'conditions' => [
                'post_id' => $id
            ],
            'order' => [
                'created' => 'DESC'
            ],
            'contain' => ['Users']
        ]);

        $post_comments = $this->paginate($query, ['limit' => 5]);

        $this->set(compact('post', 'post_comments'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        $arr_ext = ['jpg', 'jpeg', 'png'];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['user_id'] = $this->Auth->User('id');
            $post_images = $data['post_images'];
            if (count($post_images) > 5) {
                $this->Flash->error('Maximum images upload is 5');
                return $this->redirect(['action' => 'index']);
            }
            unset($this->request->data['post_images']);
            $image_array = [];
            foreach ($post_images as $post_image) {
                if (in_array(pathinfo($post_image['name'], PATHINFO_EXTENSION), $arr_ext)) {
                    if (move_uploaded_file($post_image['tmp_name'], WWW_ROOT . '/img/market_images/' . $post_image['name'])) {
                        $image_array[] = $post_image['name'];
                    }
                } else {
                    $this->Flash->error('Wrong file format');
                    return $this->redirect(['action' => 'index']);
                }
            }
            $data['post_images'] = implode(',', $image_array);
            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function postComment () {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $comment = $this->Posts->PostComments->newEntity($data);
            if ($this->Posts->PostComments->save($comment)) {
                $post = $this->Posts->get($data['post_id']);
                $updatePost = $this->Posts->patchEntity($post, ['modified' => date('Y-m-d H:i:s')]);
                if ($this->Posts->save($post)) {
                    $this->Flash->success('Comment added');
                    return $this->redirect(['action' => 'view', $data['post_id']]);
                }
            }
        }
    }
}
