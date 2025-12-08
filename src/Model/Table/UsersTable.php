<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('users');
        $this->setPrimaryKey('id');
        
        $this->hasMany('Visits', [
            'foreignKey' => 'host_id'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username')
            ->notEmptyString('email')
            ->email('email')
            ->notEmptyString('role');

        return $validator;
    }
}