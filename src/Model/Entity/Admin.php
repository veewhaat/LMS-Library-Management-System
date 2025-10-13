<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Log\Log;

class Admin extends Entity
{
    protected array $_accessible = [
        'full_name' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'is_active' => true,
        'last_login' => true,
        'created' => true,
        'modified' => true,
    ];

    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            Log::write('debug', 'Hashing password in Entity');
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }
}