<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitReasonTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visit_reasons'); // Point to your plural table name
        $this->setPrimaryKey('id');
        $this->setDisplayField('name'); // Optional: adjust to your field
    }
}