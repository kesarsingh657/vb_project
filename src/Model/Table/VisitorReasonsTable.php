<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitReasonsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Your table name in DB
        $this->setTable('visitor_reasons');

        $this->setPrimaryKey('id');
    }
}
