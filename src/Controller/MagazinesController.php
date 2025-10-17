<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

class MagazinesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
{
    // Get search and filter parameters
    $search = $this->request->getQuery('search');
    $magazineType = $this->request->getQuery('type');

    // Base query
    $query = $this->Magazines->find();

    // Apply search if provided
    if ($search) {
        $query->where([
            'OR' => [
                'name LIKE' => '%' . $search . '%',
                'publisher LIKE' => '%' . $search . '%'
            ]
        ]);
    }

    // Apply type filter if provided
    if ($magazineType && $magazineType !== 'all') {
        $query->where(['type' => $magazineType]);
    }

    // Get unique magazine types for filter dropdown
    $magazineTypes = $this->Magazines->find()
        ->select(['type'])
        ->distinct(['type'])
        ->where(['type IS NOT' => null])
        ->order(['type' => 'ASC'])
        ->all()
        ->extract('type')
        ->toArray();

    // Paginate the results
    $magazines = $this->paginate($query);

    $this->set(compact('magazines', 'magazineTypes', 'search', 'magazineType'));
}

    public function add()
    {
        $magazine = $this->Magazines->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Set the current user
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            
            // Add created_by and modified_by
            $data['created_by'] = $currentUser;
            $data['modified_by'] = $currentUser;
            
            $magazine = $this->Magazines->patchEntity($magazine, $data);
            
            if ($this->Magazines->save($magazine)) {
                $this->Flash->success(__('The magazine has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The magazine could not be saved. Please, try again.'));
        }
        $this->set(compact('magazine'));
    }

    public function edit($id = null)
    {
        $magazine = $this->Magazines->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Set modified_by
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            $data['modified_by'] = $currentUser;
            
            $magazine = $this->Magazines->patchEntity($magazine, $data);
            if ($this->Magazines->save($magazine)) {
                $this->Flash->success(__('The magazine has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The magazine could not be updated. Please, try again.'));
        }
        $this->set(compact('magazine'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $magazine = $this->Magazines->get($id);
        if ($this->Magazines->delete($magazine)) {
            $this->Flash->success(__('The magazine has been deleted.'));
        } else {
            $this->Flash->error(__('The magazine could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}