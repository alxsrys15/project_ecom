<?php
namespace App\Controller\Profile;

use App\Controller\AppController;

/**
 * PackageRequests Controller
 *
 * @property \App\Model\Table\PackageRequestsTable $PackageRequests
 *
 * @method \App\Model\Entity\PackageRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackageRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->PackageRequests->find('all', [
            'contain' => [
                'Statuses',
                'Packages'
            ],
            'order' => [
                'created' => 'desc'
            ],
            'conditions' => [
                'is_active' => 1,
                'user_id' => $this->Auth->User('id')
            ]
        ]);
        $packageRequests = $this->paginate($query, ['limit' => 5]);

        $this->set(compact('packageRequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Package Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packageRequest = $this->PackageRequests->get($id, [
            'contain' => ['Users', 'Packages', 'Statuses'],
        ]);

        $this->set('packageRequest', $packageRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packageRequest = $this->PackageRequests->newEntity();
        $arr_ext = ['jpg', 'jpeg', 'png'];
        $user = $this->PackageRequests->Users->get($this->Auth->User('id'));
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $payment_image = $data['payment_image'];
            
            unset($data['payment_image']);
            if ($data['payment_type'] === "bank") {
                if (in_array(pathinfo($payment_image['name'], PATHINFO_EXTENSION), $arr_ext)) {
                    if (move_uploaded_file($payment_image['tmp_name'], WWW_ROOT . '/img/payment_images/' . $payment_image['name'])) {
                        $data['payment_image'] = $payment_image['name'];
                        $data['status_id'] = 1;
                        $data['user_id'] = $this->Auth->User('id');
                    }
                } else {
                    $this->Flash->error('Wrong image format');
                }
            } elseif ($data['payment_type'] === "coins") {
                $data['status_id'] = 2;
                $data['user_id'] = $this->Auth->User('id');
                $user->coins_balance -= $data['payment_price'];
                
            }
            $packageRequest = $this->PackageRequests->patchEntity($packageRequest, $data);
            if ($entity = $this->PackageRequests->save($packageRequest)) {
                if ($data['payment_type'] === "coins") {
                    $package = $this->PackageRequests->Packages->get($entity->package_id);
                    $qty = $package->qty;
                    $raw_activaton_codes = [];
                    for ($i=0; $i < $qty; $i++) { 
                        $raw_activaton_codes[$i] = [
                            'user_id' => $this->Auth->User('id'),
                            'code' => $this->codeGenerator(8)
                        ];
                    }
                    $activaton_codes = $this->PackageRequests->Users->ActivationCodes->newEntities($raw_activaton_codes);
                    if ($this->PackageRequests->Users->ActivationCodes->saveMany($activaton_codes)) {
                        if ($this->PackageRequests->Users->save($user)) {
                            $this->Auth->setUser($user);
                        }
                    }
                }
                $this->Flash->success('Package request has been saved.');

                return $this->redirect(['action' => 'index']);
            }
        }
        $packages = $this->PackageRequests->Packages->find();
        $this->set(compact('packages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packageRequest = $this->PackageRequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packageRequest = $this->PackageRequests->patchEntity($packageRequest, $this->request->getData());
            if ($this->PackageRequests->save($packageRequest)) {
                $this->Flash->success(__('The package request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package request could not be saved. Please, try again.'));
        }
        $users = $this->PackageRequests->Users->find('list', ['limit' => 200]);
        $packages = $this->PackageRequests->Packages->find('list', ['limit' => 200]);
        $statuses = $this->PackageRequests->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('packageRequest', 'users', 'packages', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packageRequest = $this->PackageRequests->get($id);
        if ($this->PackageRequests->delete($packageRequest)) {
            $this->Flash->success(__('The package request has been deleted.'));
        } else {
            $this->Flash->error(__('The package request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function codeGenerator ($length) {
        $characters = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomString = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
