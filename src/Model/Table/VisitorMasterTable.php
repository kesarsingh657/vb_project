<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorMasterTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_master');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Visits', [
            'foreignKey' => 'visitor_id'
        ]);

        $this->hasMany('VisitDetails', [
            'foreignKey' => 'visitor_id'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->scalar('name')->maxLength('name', 100)->requirePresence('name', 'create')->notEmptyString('name')
            ->scalar('mobile_number')->maxLength('mobile_number', 10)->requirePresence('mobile_number', 'create')->notEmptyString('mobile_number')
            ->email('email')->allowEmptyString('email')
            ->scalar('address')->maxLength('address', 250)->allowEmptyString('address')
            ->scalar('company_name')->maxLength('company_name', 150)->allowEmptyString('company_name')
            ->scalar('photo')->maxLength('photo', 255)->allowEmptyFile('photo');

        return $validator;
    }

    public function buildRules($rules)
    {
        $rules->add($rules->isUnique(['mobile_number']), ['errorField' => 'mobile_number']);
        return $rules;
    }
}
