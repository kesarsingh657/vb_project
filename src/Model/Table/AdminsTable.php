<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AdminsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('admins');
    }

    // Validate login with password_verify()
    public function validateLogin($username, $password)
    {
        $admin = $this->find()->where(['username' => $username])->first();

        if (!$admin) {
            return false;
        }

        return password_verify($password, $admin->password);
    }
}
