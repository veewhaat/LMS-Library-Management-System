<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\FrozenTime;

class ReturnedController extends AppController
{
    use LocatorAwareTrait;

    public function initialize(): void
    {
        parent::initialize();
        $this->Issued = $this->getTableLocator()->get('Issued');
    }

    public function index()
    {
        $returned = $this->paginate($this->Returned, [
            'order' => ['return_date' => 'DESC']
        ]);
        $this->set(compact('returned'));
    }

    public function add()
    {
        $returned = $this->Returned->newEmptyEntity();
        
        // Get list of returned books from Issued table (changed from Not Returned to Returned)
        $returnedIssues = $this->Issued->find('list', [
            'keyField' => 'issued_id',
            'valueField' => function ($issue) {
                return $issue->book_title . ' (Issued to: ' . $issue->member . ')';
            }
        ])
        ->where(['status' => 'Returned'])  // Changed from 'Not Returned' to 'Returned'
        ->order(['issue_date' => 'DESC'])
        ->toArray();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Get the issued record details
            $issuedRecord = $this->Issued->get($data['issued_id']);
            
            // Set the current user
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            
            // Populate data from issued record
            $data['book_number'] = $issuedRecord->book_number;
            $data['book_title'] = $issuedRecord->book_title;
            $data['issue_date'] = $issuedRecord->issue_date;
            $data['due_date'] = $issuedRecord->due_date;
            $data['member'] = $issuedRecord->member;
            $data['number'] = $issuedRecord->number;
            
            // Add created_by and modified_by
            $data['created_by'] = $currentUser;
            $data['modified_by'] = $currentUser;
            
            // Set initial status to Pending
            $data['status'] = 'Pending';
            
            $returned = $this->Returned->patchEntity($returned, $data);
            
            if ($this->Returned->save($returned)) {
                // No need to update issued record status as it's already 'Returned'
                $this->Flash->success(__('The return record has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The return record could not be saved. Please, try again.'));
        }
        
        $this->set(compact('returned', 'returnedIssues'));  // Changed variable name to match
    }

    public function edit($id = null)
    {
        $returned = $this->Returned->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Set modified_by
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            $data['modified_by'] = $currentUser;
            
            $returned = $this->Returned->patchEntity($returned, $data);
            if ($this->Returned->save($returned)) {
                $this->Flash->success(__('The return record has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The return record could not be updated. Please, try again.'));
        }
        
        $this->set(compact('returned'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $returned = $this->Returned->get($id);
        
        if ($this->Returned->delete($returned)) {
            $this->Flash->success(__('The return record has been deleted.'));
        } else {
            $this->Flash->error(__('The return record could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}