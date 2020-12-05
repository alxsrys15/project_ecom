<?php
namespace App\Controller\Admin;

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
        $this->paginate = [
            'contain' => ['Users', 'Packages', 'Statuses'],
            'order' => ['created' => 'DESC'],
        ];
        $packageRequests = $this->paginate($this->PackageRequests);

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
        if ($this->request->is('post')) {
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

    public function acceptRequest ($id) {
        $data = [
            'status_id' => 2
        ];
        $this->autoRender = false;
        if ($id) {
            $pr = $this->PackageRequests->get($id, [
                'contain' => 'Packages'
            ]);
            $package = $pr->package;
            $updatePr = $this->PackageRequests->patchEntity($pr, $data);
            if ($this->PackageRequests->save($updatePr)) {
                $raw_activation_codes = [];
                for ($i=0; $i < $package->qty; $i++) { 
                    $raw_activaton_codes[$i] = [
                        'user_id' => $pr->user_id,
                        'code' => $this->codeGenerator(8)
                    ];
                }
                $activaton_codes = $this->PackageRequests->Users->ActivationCodes->newEntities($raw_activaton_codes);
                if ($this->PackageRequests->Users->ActivationCodes->saveMany($activaton_codes)) {
                    $this->Flash->success('Request accepted');
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
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
