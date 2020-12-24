<?php
namespace App\Controller\Profile;

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
        $query = $this->CoinRequests->find('all', [
            'conditions' => [
                'user_id' => $this->Auth->User('id')
            ],
            'order' => [
                'created' => 'DESC'
            ],
            'contain' => [
                'Statuses'
            ]
        ]);
        $coinRequests = $this->paginate($query, ['limit' => 5]);

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
        $this->loadModel('AdminSettings');
        $setting = $this->AdminSettings->get(1);
        $coinRequest = $this->CoinRequests->newEntity();
        $arr_ext = ['jpg', 'jpeg', 'png'];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $payment_image = $data['payment_image'];
            if (in_array(pathinfo($payment_image['name'], PATHINFO_EXTENSION), $arr_ext)) {
                if (move_uploaded_file($payment_image['tmp_name'], WWW_ROOT . '/img/payment_images/' . $payment_image['name'])) {
                    $data['payment_image'] = $payment_image['name'];
                    $data['status_id'] = 1;
                    $data['user_id'] = $this->Auth->User('id');
                    $data['peso_value'] = $data['amount'] * $setting->value;
                }
            } else {
                $this->Flash->error('Wrong image format');
                return $this->redirect(['action' => 'add']);
            }
            $coinRequest = $this->CoinRequests->patchEntity($coinRequest, $data);
            if ($this->CoinRequests->save($coinRequest)) {
                $this->Flash->success('Coin Request successfully added.');
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('coinRequest', 'setting'));
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
}
