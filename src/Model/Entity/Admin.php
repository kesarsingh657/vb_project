<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Admin extends Entity
{
    // Must be an array
    protected array $_accessible = [
        'id' => true,
        'username' => true,
        'password' => true,
        'created_at' => true,
    ];
}
