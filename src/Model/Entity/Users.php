<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 * 
 * This represents a single user from the database.
 * It handles automatic password hashing.
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned
     * 
     * These fields can be set using $this->Users->newEntity($data)
     */
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'full_name' => true,
        'email' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'visits' => true,
    ];

    /**
     * Fields that are hidden when converting to JSON/Array
     * 
     * Password should never be shown in API responses
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Automatically hash password when it's set
     * 
     * This runs automatically whenever you do: $user->password = 'something';
     * It converts plain text password into a secure hash before saving to database.
     * 
     * For example:
     * - Input: 'admin'
     * - Output: '$2y$10$abc123def456...' (60 character hash)
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
        }
        return null;
    }
}