<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Log\Log;

class AdminsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    
    // Allow login, signup, forgot password and reset password without authentication
    $this->Authentication->addUnauthenticatedActions(['login', 'signup', 'forgotPassword', 'resetPassword']);
    
    // Set auth layout for authentication pages
    if (in_array($this->request->getParam('action'), ['login', 'signup', 'forgotPassword', 'resetPassword'])) {
        $this->viewBuilder()->setLayout('auth');
    }

    // Allow updateStatus action without authentication check
    $this->Authentication->addUnauthenticatedActions(['login', 'updateStatus']);
}

    public function login()
{
    $this->request->allowMethod(['get', 'post']);
    
    $result = $this->Authentication->getResult();

    // Add detailed logging
    Log::write('debug', '-------- Login Attempt Details --------');
    Log::write('debug', 'Is POST request: ' . ($this->request->is('post') ? 'Yes' : 'No'));
    if ($this->request->is('post')) {
        Log::write('debug', 'POST data: ' . json_encode($this->request->getData()));
    }
    Log::write('debug', 'Authentication Result: ' . ($result ? 'Exists' : 'None'));
    if ($result) {
        Log::write('debug', 'Is Valid: ' . ($result->isValid() ? 'Yes' : 'No'));
        Log::write('debug', 'Status: ' . $result->getStatus());
        Log::write('debug', 'Errors: ' . json_encode($result->getErrors()));
    }

    // If user is already logged in, redirect them
    if ($result && $result->isValid()) {
        $redirect = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Dashboard', 'action' => 'index'];
        Log::write('debug', 'Redirecting to: ' . json_encode($redirect));
        return $this->redirect($redirect);
    }

    if ($this->request->is('post')) {
        $this->Flash->error('Invalid username or password');
    }

}

    public function signup()
    {
        $admin = $this->Admins->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Debug signup data
            Log::write('debug', 'Signup attempt with username: ' . $data['username']);
            Log::write('debug', 'Password length: ' . strlen($data['password']));
            
            $admin = $this->Admins->patchEntity($admin, $data);
            
            if ($this->Admins->save($admin)) {
                Log::write('debug', 'Signup successful');
                $this->Flash->success('Registration successful. Please login.');
                return $this->redirect(['action' => 'login']);
            }
            Log::write('debug', 'Signup failed. Errors: ' . json_encode($admin->getErrors()));
            $this->Flash->error('Registration failed. Please try again.');
        }
        $this->set(compact('admin'));
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Admins', 'action' => 'login']);
    }

    public function forgotPassword()
{
    $this->request->allowMethod(['get', 'post']);
    
    if ($this->request->is('post')) {
        $email = $this->request->getData('email');
        
        // Find the admin with the given email
        $admin = $this->Admins->findByEmail($email)->first();
        
        if ($admin) {
            // Generate a unique token
            $token = sha1($email . rand(0, 1000) . time());
            
            // Set token and expiry (24 hours from now)
            $admin->reset_password_token = $token;
            $admin->reset_token_expires = date('Y-m-d H:i:s', strtotime('+24 hours'));
            
            if ($this->Admins->save($admin)) {
                // Send email with reset link
                // For now, just show the token
                $this->Flash->success('Reset password link has been sent to your email. Token: ' . $token);
                return $this->redirect(['action' => 'login']);
            }
        }
        
        // Always show this message to prevent email enumeration
        $this->Flash->success('If your email exists in our system, you will receive a password reset link.');
        return $this->redirect(['action' => 'login']);
    }
}

public function profile()
{
    $identity = $this->Authentication->getIdentity();
    $username = $identity ? $identity->username : null;
    
    if (!$username) {
        $this->Flash->error(__('Unable to find your profile.'));
        return $this->redirect(['action' => 'login']);
    }

    $admin = $this->Admins->findByUsername($username)->firstOrFail();

    if ($this->request->is(['patch', 'post', 'put'])) {
        $data = $this->request->getData();
        
        // Only allow updating full_name and email
        $admin = $this->Admins->patchEntity($admin, [
            'full_name' => $data['full_name'],
            'email' => $data['email']
        ]);

        if ($this->Admins->save($admin)) {
            $this->Flash->success(__('Your profile has been updated.'));
            return $this->redirect(['action' => 'profile']);
        }
        $this->Flash->error(__('Unable to update your profile. Please check the form and try again.'));
    }

    $this->set(compact('admin'));
}

public function updateStatus()
{
    $this->request->allowMethod(['post', 'ajax']);
    
    $response = ['success' => false, 'message' => ''];

    try {
        if ($this->request->is('ajax')) {
            $status = $this->request->getData('status');
            $validStatuses = ['Online', 'Offline', 'Break'];
            
            if (in_array($status, $validStatuses)) {
                $identity = $this->Authentication->getIdentity();
                $admin = $this->Admins->get($identity->id);
                $admin->status = $status;
                
                if ($this->Admins->save($admin)) {
                    $response = [
                        'success' => true,
                        'message' => 'Status updated successfully',
                        'status' => $status
                    ];
                } else {
                    $response['message'] = 'Could not save status';
                }
            } else {
                $response['message'] = 'Invalid status';
            }
        }
    } catch (\Exception $e) {
        $response['message'] = 'An error occurred';
        $this->log($e->getMessage()); // Log the error
    }

    return $this->response
        ->withType('application/json')
        ->withStringBody(json_encode($response));
}


public function resetPassword($token = null)
{
    if (!$token) {
        $this->Flash->error('Invalid password reset token.');
        return $this->redirect(['action' => 'login']);
    }

    $admin = $this->Admins->find()
        ->where([
            'reset_password_token' => $token,
            'reset_token_expires >' => date('Y-m-d H:i:s')
        ])
        ->first();

    if (!$admin) {
        $this->Flash->error('The password reset token is invalid or has expired.');
        return $this->redirect(['action' => 'login']);
    }

    if ($this->request->is(['patch', 'post', 'put'])) {
        $admin = $this->Admins->patchEntity($admin, $this->request->getData());
        
        // Clear the reset token
        $admin->reset_password_token = null;
        $admin->reset_token_expires = null;

        if ($this->Admins->save($admin)) {
            $this->Flash->success('Your password has been reset successfully.');
            return $this->redirect(['action' => 'login']);
        }
        $this->Flash->error('Unable to reset password. Please try again.');
    }

    $this->set(compact('admin'));
}
}