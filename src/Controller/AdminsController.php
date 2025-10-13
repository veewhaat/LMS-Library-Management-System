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
}

    public function login()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Find the user
            $user = $this->Admins->find()
                ->where(['username' => $data['username']])
                ->first();
            
            if ($user) {
                $hasher = new DefaultPasswordHasher();
                $passwordMatch = $hasher->check($data['password'], $user->password);
                
                // Log authentication attempt details
                Log::write('debug', 'Login attempt details:');
                Log::write('debug', 'Username found: Yes');
                Log::write('debug', 'Password match: ' . ($passwordMatch ? 'Yes' : 'No'));
                Log::write('debug', 'Stored hash: ' . substr($user->password, 0, 10) . '...');
                Log::write('debug', 'Input password length: ' . strlen($data['password']));
                
                if ($passwordMatch) {
                    // Manually set the user identity
                    $this->Authentication->setIdentity($user);
                    
                    // Log successful authentication
                    Log::write('debug', 'Authentication successful, redirecting to dashboard');
                    
                    return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                }
            }
            
            // If we get here, authentication failed
            Log::write('debug', 'Authentication failed');
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