<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\FrozenTime;

class DashboardController extends AppController
{
    use LocatorAwareTrait;

    public function initialize(): void
    {
        parent::initialize();
        // Load all required models
        $this->Books = $this->getTableLocator()->get('Books');
        $this->Magazines = $this->getTableLocator()->get('Magazines');
        $this->Newspapers = $this->getTableLocator()->get('Newspapers');
        $this->Issued = $this->getTableLocator()->get('Issued');
        $this->Returned = $this->getTableLocator()->get('Returned');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $result = $this->Authentication->getResult();
        if (!$result->isValid()) {
            return $this->redirect(['controller' => 'Admins', 'action' => 'login']);
        }
    }

    public function index()
    {
        // Get counts for various items
        $totalBooks = $this->Books ? $this->Books->find()->count() : 0;
        $totalMagazines = $this->Magazines ? $this->Magazines->find()->count() : 0;
        $totalNewspapers = $this->Newspapers ? $this->Newspapers->find()->count() : 0;
        
        // Get counts for issued items
        $totalIssued = $this->Issued ? $this->Issued->find()
            ->where(['status' => 'Issued'])
            ->count() : 0;
            
        // Get counts for returned items
        $totalReturned = $this->Returned ? $this->Returned->find()
            ->where(['status' => 'Cleared'])
            ->count() : 0;
            
        $totalPending = $this->Returned ? $this->Returned->find()
            ->where(['status' => 'Pending'])
            ->count() : 0;

        // Get not returned items (items that are still issued)
        $notReturned = $this->Issued ? $this->Issued->find()
            ->where(['status' => 'Issued'])
            ->count() : 0;

        // Get current user's information
        $identity = $this->Authentication->getIdentity();
        $currentUser = 'veewhaat'; // Default value
        if ($identity) {
            $user = $identity->getOriginalData();
            $currentUser = $user->username;
        }

        // Set Malaysian timezone (UTC+8)
        $currentDateTime = FrozenTime::now()
        ->setTimezone('Asia/Kuala_Lumpur')
        ->format('Y-m-d H:i:s');


        // Set user's role and status
        $userRole = 'Admin';
        $userStatus = 'Online';

        // Add this new query for due books
    $dueToday = $this->Issued->find()
        ->where([
            'status' => 'Issued',
            'DATE(due_date)' => FrozenTime::now()->format('Y-m-d')
        ])
        ->order(['due_date' => 'ASC'])
        ->all();

    // Get overdue books
    $overdueBooks = $this->Issued->find()
        ->where([
            'status' => 'Issued',
            'due_date <' => FrozenTime::now()->format('Y-m-d')
        ])
        ->order(['due_date' => 'ASC'])
        ->all();

        $this->set(compact(
            'totalBooks',
            'totalMagazines',
            'totalNewspapers',
            'totalIssued',
            'totalReturned',
            'totalPending',
            'notReturned',
            'currentUser',
            'currentDateTime',
            'user',
            'dueToday',
            'overdueBooks'
        ));
    }
}