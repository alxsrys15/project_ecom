<?php
namespace App\Controller\Admin;

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
        $this->Auth->allow(['index','add','edit','view']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {   

        $eBooks = $this->paginate($this->Ebooks);
        
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
        $eBook = $this->Ebooks->get($id, [
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
        $years_option = [];
        foreach (range(1990, date('Y')) as $year) {
            $years_option[$year] = $year; 
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $new_ebook = $this->Ebooks->newEntity();
            $arr_ext = ['jpg', 'jpeg', 'png'];
            $valid_pdf = in_array(pathinfo($data['pdf_file']['name'], PATHINFO_EXTENSION), ['pdf']);
            $valid_image = in_array(pathinfo($data['cover_image']['name'], PATHINFO_EXTENSION), $arr_ext);
            if ($valid_pdf && $valid_image) {
                if (move_uploaded_file($data['pdf_file']['tmp_name'], WWW_ROOT . 'assets/' . $data['pdf_file']['name']) && move_uploaded_file($data['cover_image']['tmp_name'], WWW_ROOT . 'img/ebook_images/' . $data['cover_image']['name'])) {
                    $save_data = $data;
                    $save_data['pdf_file'] = $data['pdf_file']['name'];
                    $save_data['cover_images'] = $data['cover_image']['name'];
                    $new_ebook = $this->Ebooks->patchEntity($new_ebook, $save_data);
                    if ($this->Ebooks->save($new_ebook)) {
                        $this->Flash->success('Ebook has been added');
                        return $this->redirect(['action' => 'index']);
                    }
                }
            } else {
                $this->Flash->error('Invalid file format');
            }
            // if ($this->Ebooks->save($eBook)) {
            //     $this->Flash->success(__('The e book has been saved.'));

            //     return $this->redirect(['action' => 'index']);
            // }
            $this->Flash->error(__('The e book could not be saved. Please, try again.'));
        }
        $this->set(compact('years_option'));
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
            $eBook = $this->Ebooks->patchEntity($eBook, $this->request->getData());
            if ($this->Ebooks->save($eBook)) {
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
        $eBook = $this->Ebooks->get($id);
        if ($this->EBooks->delete($eBook)) {
            $this->Flash->success(__('The e book has been deleted.'));
        } else {
            $this->Flash->error(__('The e book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
