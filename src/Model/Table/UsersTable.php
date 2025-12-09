<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;


class UsersTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        
        $this->setTable('users');
        
        
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        
        $this->addBehavior('Timestamp');

        
        
        
        $this->hasMany('Visits', [
            'foreignKey' => 'host_id',
            'dependent' => false, // Don't delete visits when user is deleted
        ]);
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create'); // Only allow empty on create (auto-increment)

        
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

        
        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 100)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name', 'Full name is required');

        
        $validator
            ->email('email', true, 'Please enter a valid email address')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'Email is required');

        
        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role', 'Role is required')
            ->inList('role', ['admin', 'security', 'employee'], 'Invalid role selected');

        return $validator;
    }

    
    public function buildRules(\Cake\ORM\RulesChecker $rules): \Cake\ORM\RulesChecker
    {
        
        $rules->add($rules->isUnique(['username'], 'This username is already registered'));
        
        
        $rules->add($rules->isUnique(['email'], 'This email is already registered'));

        return $rules;
    }
}