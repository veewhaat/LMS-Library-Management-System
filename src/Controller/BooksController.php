<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

class BooksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
{
    // Get search and filter parameters
    $search = $this->request->getQuery('search');
    $bookType = $this->request->getQuery('book_type');

    // Base query
    $query = $this->Books->find();

    // Apply search if provided
    if ($search) {
        $query->where([
            'OR' => [
                'title LIKE' => '%' . $search . '%',
                'author_name LIKE' => '%' . $search . '%',
                'isbn LIKE' => '%' . $search . '%',
                'publisher LIKE' => '%' . $search . '%'
            ]
        ]);
    }

    // Apply book type filter if provided
    if ($bookType && $bookType !== 'all') {
        $query->where(['book_type' => $bookType]);
    }

    // Get unique book types for filter dropdown
    $bookTypes = $this->Books->find()
        ->select(['book_type'])
        ->distinct(['book_type'])
        ->where(['book_type IS NOT' => null])
        ->order(['book_type' => 'ASC'])
        ->all()
        ->extract('book_type')
        ->toArray();

    // Paginate the results
    $books = $this->paginate($query);

    $this->set(compact('books', 'bookTypes', 'search', 'bookType'));
}

    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Set the current user
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            
            // Add created_by and modified_by
            $data['created_by'] = $currentUser;
            $data['modified_by'] = $currentUser;
            
            $book = $this->Books->patchEntity($book, $data);
            
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
            
            // Debug validation errors
            if ($book->getErrors()) {
                $errors = json_encode($book->getErrors());
                $this->log("Validation errors: " . $errors, 'debug');
            }
        }
        $this->set(compact('book'));
    }

    public function edit($isbn = null)
    {
        $book = $this->Books->get($isbn, [
            'contain' => [],
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Set modified_by
            $identity = $this->Authentication->getIdentity();
            $currentUser = $identity ? $identity->username : 'veewhaat';
            $data['modified_by'] = $currentUser;
            
            $book = $this->Books->patchEntity($book, $data);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be updated. Please, try again.'));
        }
        $this->set(compact('book'));
    }

    public function delete($isbn = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($isbn);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}