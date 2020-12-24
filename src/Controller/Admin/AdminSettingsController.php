<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * AdminSettings Controller
 *
 * @property \App\Model\Table\AdminSettingsTable $AdminSettings
 *
 * @method \App\Model\Entity\AdminSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminSettingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $adminSetting = $this->AdminSettings->get(1);

        $this->set(compact('adminSetting'));
    }

    /**
     * View method
     *
     * @param string|null $id Admin Setting id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminSetting = $this->AdminSettings->get($id, [
            'contain' => [],
        ]);

        $this->set('adminSetting', $adminSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminSetting = $this->AdminSettings->newEntity();
        if ($this->request->is('post')) {
            $adminSetting = $this->AdminSettings->patchEntity($adminSetting, $this->request->getData());
            if ($this->AdminSettings->save($adminSetting)) {
                $this->Flash->success(__('The admin setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin setting could not be saved. Please, try again.'));
        }
        $this->set(compact('adminSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminSetting = $this->AdminSettings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminSetting = $this->AdminSettings->patchEntity($adminSetting, $this->request->getData());
            if ($this->AdminSettings->save($adminSetting)) {
                $this->Flash->success(__('The admin setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin setting could not be saved. Please, try again.'));
        }
        $this->set(compact('adminSetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminSetting = $this->AdminSettings->get($id);
        if ($this->AdminSettings->delete($adminSetting)) {
            $this->Flash->success(__('The admin setting has been deleted.'));
        } else {
            $this->Flash->error(__('The admin setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
