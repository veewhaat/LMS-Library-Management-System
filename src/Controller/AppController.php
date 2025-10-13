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

        // Get current user's information
        $identity = $this->Authentication->getIdentity();
        $currentUser = $identity ? $identity->username : 'veewhaat';
        
        // Set Malaysian timezone (UTC+8)
        $currentDateTime = FrozenTime::now()
            ->setTimezone('Asia/Kuala_Lumpur')
            ->format('Y-m-d H:i:s');

        // Make these variables available in all views
        $this->set(compact('currentUser', 'currentDateTime'));
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Get authentication status
        $identity = $this->Authentication->getIdentity();
        
        // Pass authentication status to all views
        $this->set('logged_in', !is_null($identity));
        if ($identity) {
            $this->set('current_user', $identity);
        }
    }
}