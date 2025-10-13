<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

class IdentityHelper extends Helper
{
    /**
     * Check if a user is logged in
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        $identity = $this->getView()->getRequest()->getAttribute('identity');
        return $identity !== null;
    }

    /**
     * Get the current user's data
     *
     * @param string|null $field Specific field to get
     * @return mixed
     */
    public function get($field = null)
    {
        $identity = $this->getView()->getRequest()->getAttribute('identity');
        
        if ($identity === null) {
            return null;
        }
        
        if ($field === null) {
            return $identity;
        }
        
        return $identity->get($field) ?? null;
    }

    /**
     * Get the current user's ID
     *
     * @return int|string|null
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * Get the current user's username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->get('username');
    }

    /**
     * Get the current user's email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->get('email');
    }

    /**
     * Check if the current user has a specific role
     *
     * @param string $role Role to check
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        $userRole = $this->get('role');
        return $userRole === $role;
    }
}