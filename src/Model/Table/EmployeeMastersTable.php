<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class EmployeeMastersTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('employee_masters');
        $this->setDisplayField('emp_code');
        $this->setPrimaryKey('id');
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('emp_code')
            ->maxLength('emp_code', 50)
            ->requirePresence('emp_code', 'create')
            ->notEmptyString('emp_code')
            ->add('emp_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('emp_name')
            ->maxLength('emp_name', 100)
            ->requirePresence('emp_name', 'create')
            ->notEmptyString('emp_name');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->allowEmptyString('mobile_number');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('role')
            ->allowEmptyString('role');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['emp_code']), ['errorField' => 'emp_code']);

        return $rules;
    }
}
