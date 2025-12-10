<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitReasonsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Correct table name
        $this->setTable('visit_reasons');
        $this->setPrimaryKey('id');
    }
}
