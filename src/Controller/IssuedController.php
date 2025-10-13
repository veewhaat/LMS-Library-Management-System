<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;  // Add this line

class IssuedController extends AppController
{
    use LocatorAwareTrait;  // Add this line

    public function initialize(): void
    {
        parent::initialize();
        // Change loadModel to getTableLocator
        $this->Books = $this->getTableLocator()->get('Books');
    }

    public function index()
    {
        $issued = $this->paginate($this->Issued, [
            'order' => ['issue_date' => 'DESC']
        ]);
        $this->set(compact('issued'));
    }

    public function add()
    {
        $issued = $this->Issued->newEmptyEntity();
        
        // Get list of books for dropdown
        $books = $this->Books->find('list', [
            'keyField' => 'isbn',
            'valueField' => 'title'
        ])->toArray();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Set the current user
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            
            // Add created_by and modified_by
            $data['created_by'] = $currentUser;
            $data['modified_by'] = $currentUser;
            
            // Set initial status
            $data['status'] = 'Issued';
            
            // Get book details
            $book = $this->Books->get($data['book_number']);
            $data['book_title'] = $book->title;
            
            $issued = $this->Issued->patchEntity($issued, $data);
            
            if ($this->Issued->save($issued)) {
                $this->Flash->success(__('The book has been issued successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be issued. Please, try again.'));
        }
        $this->set(compact('issued', 'books'));
    }

    public function edit($issued_id = null)
    {
        $issued = $this->Issued->get($issued_id, [
            'contain' => []
        ]);
        
        $books = $this->Books->find('list', [
            'keyField' => 'isbn',
            'valueField' => 'title'
        ])->toArray();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            $data['modified_by'] = $currentUser;
            
            if ($data['book_number'] !== $issued->book_number) {
                $book = $this->Books->get($data['book_number']);
                $data['book_title'] = $book->title;
            }
            
            $issued = $this->Issued->patchEntity($issued, $data);
            
            if ($this->Issued->save($issued)) {
                $this->Flash->success(__('The issued record has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issued record could not be updated. Please, try again.'));
        }
        $this->set(compact('issued', 'books'));
    }


    public function delete($issued_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issued = $this->Issued->get($issued_id);
        if ($this->Issued->delete($issued)) {
            $this->Flash->success(__('The issued record has been deleted.'));
        } else {
            $this->Flash->error(__('The issued record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function notReturned()
    {
        $notReturned = $this->Issued->find()
            ->where(['status' => 'Issued'])
            ->order(['issue_date' => 'DESC']);
            
        $notReturned = $this->paginate($notReturned);
        $this->set(compact('notReturned'));
    }
}