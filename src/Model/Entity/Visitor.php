<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visitor extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'visitor_name' => true,
        'mobile_number' => true,
        'email' => true,
        'address' => true,
        'company_name' => true,
        'visit_reason' => true,
        'host_name' => true,
        'host_department' => true,
        'host_phone' => true,
        'photo' => true,
        'visit_date' => true,
        'visit_time' => true,
        'check_in_time' => true,
        'check_out_time' => true,
        'status' => true,
        'created_at' => true
    ];
}
