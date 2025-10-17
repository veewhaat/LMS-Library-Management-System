<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        // Set the layout
        $this->viewBuilder()->setLayout('default');

        // Only set these variables if user is authenticated
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            $currentUser = $identity->get('username');
            
            // Set Malaysian timezone (UTC+8)
            $currentDateTime = FrozenTime::now()
                ->setTimezone('Asia/Kuala_Lumpur')
                ->format('Y-m-d H:i:s');

            // Make these variables available in all views
            $this->set(compact('currentUser', 'currentDateTime'));
        }
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'updateStatus']);
    } 
}
