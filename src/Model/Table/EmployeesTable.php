<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class EmployeesTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('employees');
        $this->setDisplayField('employee_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('employee_name')
            ->maxLength('employee_name', 100)
            ->requirePresence('employee_name', 'create')
            ->notEmptyString('employee_name');

        $validator
            ->scalar('employee_email')
            ->maxLength('employee_email', 100)
            ->requirePresence('employee_email', 'create')
            ->notEmptyString('employee_email')
            ->add('employee_email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('employee_phone')
            ->maxLength('employee_phone', 20)
            ->allowEmptyString('employee_phone');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 100)
            ->allowEmptyString('designation');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['employee_email']), ['errorField' => 'employee_email']);

        return $rules;
    }
}
