<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class VisitReasonsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Correct table name
        $this->setTable('visitor_reasons');

        $this->setPrimaryKey('id');
    }
}
