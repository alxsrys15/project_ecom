<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * EBooks Controller
 *
 * @property \App\Model\Table\EBooksTable $EBooks
 *
 * @method \App\Model\Entity\EBook[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EBooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $eBooks = $this->paginate($this->EBooks);

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
}
