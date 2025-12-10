<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // FIXED: CakePHP 5 – loadModel removed
        $this->Users = TableRegistry::getTableLocator()->get('Users');

        $this->viewBuilder()->setLayout('login');
    }

    public function login()
    {
        if ($this->request->is('post')) {

            $username = $this->request->getData('username');
            $password = $this->request->getData('password');
            $role     = $this->request->getData('role');

            // Since we are NOT using hashed password
            $user = $this->Users
                ->find()
                ->where([
                    'username' => $username,
                    'password' => $password,
                    'role'     => $role
                ])
                ->first();

            if ($user) {

                // Save session
                $this->request->getSession()->write('user', $user);

                if ($user->role === 'admin') {
                    return $this->redirect('/dashboard/admin');
                }

                if ($user->role === 'security') {
                    return $this->redirect('/dashboard/security');
                }

                if ($user->role === 'employee') {
                    return $this->redirect('/dashboard/employee');
                }
            }

            $this->Flash->error("Invalid credentials!");
        }
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        $this->Flash->success("Logged out successfully!");
        return $this->redirect('/users/login');
    }
}
