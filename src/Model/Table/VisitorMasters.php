<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitorMasterTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visitor_master');
        $this->setPrimaryKey('id');
        
        $this->hasMany('Visits', [
            'foreignKey' => 'visitor_id'
        ]);
    }
}