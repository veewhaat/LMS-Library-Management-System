<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

class NewspapersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $newspapers = $this->paginate($this->Newspapers);
        $this->set(compact('newspapers'));
    }

    public function add()
    {
        $newspaper = $this->Newspapers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Set the current user
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            
            // Add created_by and modified_by
            $data['created_by'] = $currentUser;
            $data['modified_by'] = $currentUser;
            
            $newspaper = $this->Newspapers->patchEntity($newspaper, $data);
            
            if ($this->Newspapers->save($newspaper)) {
                $this->Flash->success(__('The newspaper has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newspaper could not be saved. Please, try again.'));
        }
        $this->set(compact('newspaper'));
    }

    public function edit($id = null)
    {
        $newspaper = $this->Newspapers->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Set modified_by
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            $data['modified_by'] = $currentUser;
            
            $newspaper = $this->Newspapers->patchEntity($newspaper, $data);
            if ($this->Newspapers->save($newspaper)) {
                $this->Flash->success(__('The newspaper has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newspaper could not be updated. Please, try again.'));
        }
        $this->set(compact('newspaper'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newspaper = $this->Newspapers->get($id);
        if ($this->Newspapers->delete($newspaper)) {
            $this->Flash->success(__('The newspaper has been deleted.'));
        } else {
            $this->Flash->error(__('The newspaper could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}