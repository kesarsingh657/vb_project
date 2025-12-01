<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visitor extends Entity
{
    // Mass assignment allowed fields
    protected array $_accessible = [
        'visitor_name'     => true,
        'mobile_number'    => true,
        'email'            => true,
        'address'          => true,
        'company_name'     => true,
        'visit_reason'     => true,
        'host_name'        => true,
        'host_department'  => true,
        'host_phone'       => true,
        'visit_date'       => true,
        'visit_time'       => true,
        'photo'            => true,
        'created_at'       => true,
        'updated_at'       => true,
    ];
}
