<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class EmployeeMaster extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }
}