<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class VisitorsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ApprovalRequests', [
            'foreignKey' => 'visitor_id',
        ]);

        // 🔥 FIX: Avoid conflict with "visitor_history" column
        $this->hasMany('VisitorHistory', [
            'foreignKey' => 'visitor_id',
            'propertyName' => 'history_records', // custom safe name
        ]);
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('visitor_name')
            ->maxLength('visitor_name', 255)
            ->allowEmptyString('visitor_name');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 50)
            ->allowEmptyString('mobile_number');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 255)
            ->allowEmptyString('company_name');

        $validator
            ->scalar('visit_reason')
            ->maxLength('visit_reason', 255)
            ->allowEmptyString('visit_reason');

        $validator
            ->scalar('host_name')
            ->maxLength('host_name', 255)
            ->allowEmptyString('host_name');

        $validator
            ->scalar('host_department')
            ->maxLength('host_department', 255)
            ->allowEmptyString('host_department');

        $validator
            ->scalar('host_phone')
            ->maxLength('host_phone', 50)
            ->allowEmptyString('host_phone');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->allowEmptyString('photo');

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
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->scalar('visit_type')
            ->maxLength('visit_type', 20)
            ->allowEmptyString('visit_type');

        $validator
            ->integer('group_size')
            ->allowEmptyString('group_size');

        $validator
            ->scalar('host_status')
            ->maxLength('host_status', 20)
            ->allowEmptyString('host_status');

        $validator
            ->dateTime('host_approval_time')
            ->allowEmptyDateTime('host_approval_time');

        $validator
            ->scalar('qr_code')
            ->maxLength('qr_code', 255)
            ->allowEmptyString('qr_code');

        $validator
            ->boolean('badge_printed')
            ->allowEmptyString('badge_printed');

        $validator
            ->boolean('is_pre_registered')
            ->allowEmptyString('is_pre_registered');

        // column does NOT conflict anymore
        $validator
            ->scalar('visitor_history')
            ->allowEmptyString('visitor_history');

        $validator
            ->integer('photo_downloaded_count')
            ->allowEmptyString('photo_downloaded_count');

        return $validator;
    }
}
