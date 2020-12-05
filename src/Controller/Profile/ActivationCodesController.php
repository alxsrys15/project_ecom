<?php
namespace App\Controller\Profile;

use App\Controller\AppController;

/**
 * ActivationCodes Controller
 *
 * @property \App\Model\Table\ActivationCodesTable $ActivationCodes
 *
 * @method \App\Model\Entity\ActivationCode[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivationCodesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->ActivationCodes->find('all')
            ->where(['user_id' => $this->Auth->User('id')])
            ->order(['created' => 'desc']);
        $activationCodes = $this->paginate($query, ['limit' => 5]);

        $this->set(compact('activationCodes'));
    }

    /**
     * View method
     *
     * @param string|null $id Activation Code id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activationCode = $this->ActivationCodes->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('activationCode', $activationCode);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activationCode = $this->ActivationCodes->newEntity();
        if ($this->request->is('post')) {
            $activationCode = $this->ActivationCodes->patchEntity($activationCode, $this->request->getData());
            if ($this->ActivationCodes->save($activationCode)) {
                $this->Flash->success(__('The activation code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activation code could not be saved. Please, try again.'));
        }
        $users = $this->ActivationCodes->Users->find('list', ['limit' => 200]);
        $this->set(compact('activationCode', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activation Code id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activationCode = $this->ActivationCodes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activationCode = $this->ActivationCodes->patchEntity($activationCode, $this->request->getData());
            if ($this->ActivationCodes->save($activationCode)) {
                $this->Flash->success(__('The activation code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activation code could not be saved. Please, try again.'));
        }
        $users = $this->ActivationCodes->Users->find('list', ['limit' => 200]);
        $this->set(compact('activationCode', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activation Code id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activationCode = $this->ActivationCodes->get($id);
        if ($this->ActivationCodes->delete($activationCode)) {
            $this->Flash->success(__('The activation code has been deleted.'));
        } else {
            $this->Flash->error(__('The activation code could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
