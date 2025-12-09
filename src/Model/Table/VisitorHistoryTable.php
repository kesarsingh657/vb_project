<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class VisitorHistoryTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_history');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Visitors', [
            'foreignKey' => 'visitor_id',
            'joinType' => 'INNER',
        ]);
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('visitor_id')
            ->notEmptyString('visitor_id');

        $validator
            ->date('visit_date')
            ->allowEmptyDate('visit_date');

        $validator
            ->time('visit_time')
            ->allowEmptyTime('visit_time');

        $validator
            ->dateTime('check_in_time')
            ->allowEmptyDateTime('check_in_time');

        $validator
            ->dateTime('check_out_time')
            ->allowEmptyDateTime('check_out_time');

        $validator
            ->scalar('host_name')
            ->maxLength('host_name', 100)
            ->allowEmptyString('host_name');

        $validator
            ->scalar('visit_reason')
            ->maxLength('visit_reason', 50)
            ->allowEmptyString('visit_reason');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['visitor_id'], 'Visitors'), ['errorField' => 'visitor_id']);

        return $rules;
    }
}
