<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ApprovalRequestsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->setTable('approval_requests');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('Visitors', [
            'foreignKey' => 'visitor_id'
        ]);
    }
}