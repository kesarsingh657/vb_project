<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visits');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('VisitorMaster', [
            'foreignKey' => 'visitor_id'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'host_id'
        ]);
        
        $this->belongsTo('VisitReasons', [
            'foreignKey' => 'visit_reason_id'
        ]);
        
        $this->hasMany('VisitDetails', [
            'foreignKey' => 'visit_id'
        ]);
    }
}