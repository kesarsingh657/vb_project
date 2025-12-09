<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class VisitorReasonsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_reasons');
        $this->setDisplayField('visit_reason');
        $this->setPrimaryKey('id');
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('visit_reason')
            ->maxLength('visit_reason', 100)
            ->requirePresence('visit_reason', 'create')
            ->notEmptyString('visit_reason');

        $validator
            ->dateTime('created_on')
            ->allowEmptyDateTime('created_on');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 50)
            ->allowEmptyString('created_by');

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

        return $validator;
    }
}
