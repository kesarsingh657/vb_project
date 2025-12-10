<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VisitorGroupMembersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_group_members');
        $this->setPrimaryKey('id');
    }
}
