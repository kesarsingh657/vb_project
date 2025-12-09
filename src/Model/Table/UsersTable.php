<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 * 
 * This handles all database operations for the users table.
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     * 
     * This runs when the table is loaded.
     * We use it to set up relationships and behaviors.
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Tell CakePHP which table in the database to use
        $this->setTable('users');
        
        // Tell CakePHP which column is the primary key
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        // Enable automatic created and modified timestamps
        $this->addBehavior('Timestamp');

        // Relationships with other tables
        
        // One user can host many visits
        $this->hasMany('Visits', [
            'foreignKey' => 'host_id',
            'dependent' => false, // Don't delete visits when user is deleted
        ]);
    }

    /**
     * Validation rules
     * 
     * These rules check if the data is valid before saving to database.
     */
    public function validationDefault(Validator $validator): Validator
    {
        // ID field - auto-generated, don't need to validate
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create'); // Only allow empty on create (auto-increment)

        // Username field - required and must be unique
        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create') // Must be provided when creating user
            ->notEmptyString('username', 'Username is required')
            ->add('username', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'This username is already taken'
            ]);

        // Password field - required
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required');

        // Full name field - required
        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 100)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name', 'Full name is required');

        // Email field - required and must be valid email format
        $validator
            ->email('email', true, 'Please enter a valid email address')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'Email is required');

        // Role field - must be one of: admin, security, employee
        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role', 'Role is required')
            ->inList('role', ['admin', 'security', 'employee'], 'Invalid role selected');

        return $validator;
    }

    /**
     * Build rules
     * 
     * Additional validation rules that involve database checks.
     */
    public function buildRules(\Cake\ORM\RulesChecker $rules): \Cake\ORM\RulesChecker
    {
        // Make sure username is unique in database
        $rules->add($rules->isUnique(['username'], 'This username is already registered'));
        
        // Make sure email is unique in database
        $rules->add($rules->isUnique(['email'], 'This email is already registered'));

        return $rules;
    }
}