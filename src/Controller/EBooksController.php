<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * EBooks Controller
 *
 * @property \App\Model\Table\EBooksTable $EBooks
 *
 * @method \App\Model\Entity\EBook[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EBooksController extends AppController
{

    public function beforeFilter (Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->EBooks->find('all', [
            'order' => [
                'created' => 'DESC'
            ]
        ]);
        if (isset($this->request->query['s']) && !empty($this->request->query['s'])) {
            $query->where(['title LIKE' => '%'.$this->request->query['s'].'%']);
        }
        $EBooks = $this->paginate($query, ['limit' => 9]);

        $this->set(compact('eBooks'));
    }

    /**
     * View method
     *
     * @param string|null $id E Book id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eBook = $this->EBooks->get($id, [
            'contain' => [],
        ]);

        $this->set('eBook', $eBook);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eBook = $this->EBooks->newEntity();
        if ($this->request->is('post')) {
            $eBook = $this->EBooks->patchEntity($eBook, $this->request->getData());
            if ($this->EBooks->save($eBook)) {
                $this->Flash->success(__('The e book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The e book could not be saved. Please, try again.'));
        }
        $this->set(compact('eBook'));
    }

    /**
     * Edit method
     *
     * @param string|null $id E Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eBook = $this->EBooks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eBook = $this->EBooks->patchEntity($eBook, $this->request->getData());
            if ($this->EBooks->save($eBook)) {
                $this->Flash->success(__('The e book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The e book could not be saved. Please, try again.'));
        }
        $this->set(compact('eBook'));
    }

    /**
     * Delete method
     *
     * @param string|null $id E Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eBook = $this->EBooks->get($id);
        if ($this->EBooks->delete($eBook)) {
            $this->Flash->success(__('The e book has been deleted.'));
        } else {
            $this->Flash->error(__('The e book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function download ($id) {
        $this->autoRender = false;
        if ($id && $this->Auth->User('is_active')) {
            $eBook = $this->EBooks->get($id);
            $file_path = WWW_ROOT . 'assets/' . $eBook->pdf_file;
            if (file_exists($file_path)) {
                $response = $this->response->withFile($file_path, ['download' => 'true', 'name' => $eBook->pdf_file]);
                return $response;
            }
        }
    }
}
