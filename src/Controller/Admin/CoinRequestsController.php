<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CoinRequests Controller
 *
 * @property \App\Model\Table\CoinRequestsTable $CoinRequests
 *
 * @method \App\Model\Entity\CoinRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoinRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Statuses'],
        ];
        $coinRequests = $this->paginate($this->CoinRequests);

        $this->set(compact('coinRequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Coin Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coinRequest = $this->CoinRequests->get($id, [
            'contain' => ['Users', 'Statuses'],
        ]);

        $this->set('coinRequest', $coinRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coinRequest = $this->CoinRequests->newEntity();
        if ($this->request->is('post')) {
            $coinRequest = $this->CoinRequests->patchEntity($coinRequest, $this->request->getData());
            if ($this->CoinRequests->save($coinRequest)) {
                $this->Flash->success(__('The coin request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coin request could not be saved. Please, try again.'));
        }
        $users = $this->CoinRequests->Users->find('list', ['limit' => 200]);
        $statuses = $this->CoinRequests->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('coinRequest', 'users', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coin Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coinRequest = $this->CoinRequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coinRequest = $this->CoinRequests->patchEntity($coinRequest, $this->request->getData());
            if ($this->CoinRequests->save($coinRequest)) {
                $this->Flash->success(__('The coin request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coin request could not be saved. Please, try again.'));
        }
        $users = $this->CoinRequests->Users->find('list', ['limit' => 200]);
        $statuses = $this->CoinRequests->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('coinRequest', 'users', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coin Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coinRequest = $this->CoinRequests->get($id);
        if ($this->CoinRequests->delete($coinRequest)) {
            $this->Flash->success(__('The coin request has been deleted.'));
        } else {
            $this->Flash->error(__('The coin request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function acceptRequest ($id) {
        $data = [
            'status_id' => 2
        ];
        $this->autoRender = false;
        if ($id) {
            $request = $this->CoinRequests->get($id);
            $updatePr = $this->CoinRequests->patchEntity($request, $data);
            if ($this->CoinRequests->save($updatePr)) {
                $user = $this->CoinRequests->Users->get($request->user_id);
                $user->coins_balance += $request->amount;
                if ($this->CoinRequests->Users->save($user)) {
                    $this->Flash->success('Request accepted');
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
    }
}
