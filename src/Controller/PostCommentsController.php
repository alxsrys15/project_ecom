<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostComments Controller
 *
 * @property \App\Model\Table\PostCommentsTable $PostComments
 *
 * @method \App\Model\Entity\PostComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Posts', 'Users'],
        ];
        $postComments = $this->paginate($this->PostComments);

        $this->set(compact('postComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Post Comment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postComment = $this->PostComments->get($id, [
            'contain' => ['Posts', 'Users'],
        ]);

        $this->set('postComment', $postComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postComment = $this->PostComments->newEntity();
        if ($this->request->is('post')) {
            $postComment = $this->PostComments->patchEntity($postComment, $this->request->getData());
            if ($this->PostComments->save($postComment)) {
                $this->Flash->success(__('The post comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post comment could not be saved. Please, try again.'));
        }
        $posts = $this->PostComments->Posts->find('list', ['limit' => 200]);
        $users = $this->PostComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('postComment', 'posts', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postComment = $this->PostComments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postComment = $this->PostComments->patchEntity($postComment, $this->request->getData());
            if ($this->PostComments->save($postComment)) {
                $this->Flash->success(__('The post comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post comment could not be saved. Please, try again.'));
        }
        $posts = $this->PostComments->Posts->find('list', ['limit' => 200]);
        $users = $this->PostComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('postComment', 'posts', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postComment = $this->PostComments->get($id);
        if ($this->PostComments->delete($postComment)) {
            $this->Flash->success(__('The post comment has been deleted.'));
        } else {
            $this->Flash->error(__('The post comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
