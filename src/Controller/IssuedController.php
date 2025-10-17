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
    // Get search and filter parameters
    $search = $this->request->getQuery('search');
    $status = $this->request->getQuery('status');
    $dateRange = $this->request->getQuery('date_range', 'all');

    // Base query
    $query = $this->Issued->find()
        ->order(['issue_date' => 'DESC']);

    // Apply search if provided
    if ($search) {
        $query->where([
            'OR' => [
                'member LIKE' => '%' . $search . '%',
                'number LIKE' => '%' . $search . '%',
                'book_number LIKE' => '%' . $search . '%',
                'book_title LIKE' => '%' . $search . '%'
            ]
        ]);
    }

    // Apply status filter if provided
    if ($status && $status !== 'all') {
        $query->where(['status' => $status]);
    }

    // Apply date range filter
    switch ($dateRange) {
        case 'today':
            $query->where(['DATE(issue_date)' => date('Y-m-d')]);
            break;
        case 'week':
            $query->where(['issue_date >=' => date('Y-m-d', strtotime('-1 week'))]);
            break;
        case 'month':
            $query->where(['issue_date >=' => date('Y-m-d', strtotime('-1 month'))]);
            break;
    }

    // Get unique statuses for filter dropdown
    $statuses = $this->Issued->find()
        ->select(['status'])
        ->distinct(['status'])
        ->where(['status IS NOT' => null])
        ->order(['status' => 'ASC'])
        ->all()
        ->extract('status')
        ->toArray();

    // Paginate the results
    $issued = $this->paginate($query);

    $this->set(compact('issued', 'statuses', 'search', 'status', 'dateRange'));
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