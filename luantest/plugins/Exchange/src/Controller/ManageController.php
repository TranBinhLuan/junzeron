<?php
namespace Exchange\Controller;

use Exchange\Controller\AppController;

/**
 * Manage Controller
 *
 * @property \Exchange\Model\Table\ManageTable $Manage
 */
class ManageController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('manage', $this->paginate($this->Manage));
        $this->set('_serialize', ['manage']);
    }

    /**
     * View method
     *
     * @param string|null $id Manage id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manage = $this->Manage->get($id, [
            'contain' => []
        ]);
        $this->set('manage', $manage);
        $this->set('_serialize', ['manage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manage = $this->Manage->newEntity();
        if ($this->request->is('post')) {
            $manage = $this->Manage->patchEntity($manage, $this->request->data);
            if ($this->Manage->save($manage)) {
                $this->Flash->success(__('The manage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manage could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('manage'));
        $this->set('_serialize', ['manage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Manage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manage = $this->Manage->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manage = $this->Manage->patchEntity($manage, $this->request->data);
            if ($this->Manage->save($manage)) {
                $this->Flash->success(__('The manage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The manage could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('manage'));
        $this->set('_serialize', ['manage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Manage id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manage = $this->Manage->get($id);
        if ($this->Manage->delete($manage)) {
            $this->Flash->success(__('The manage has been deleted.'));
        } else {
            $this->Flash->error(__('The manage could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
