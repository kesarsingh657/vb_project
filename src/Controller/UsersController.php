<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function login()
    {
        if ($this->request->is('post')) {

            $username = $this->request->getData('username');
            $password = $this->request->getData('password');
            $role     = $this->request->getData('role');
            $user = $this->Users->find()
                ->where([
                    'username'  => $username,
                    'password'  => $password,
                    'role'      => $role,
                    'is_active' => 1
                ])
                ->first();

            if ($user) {
                $this->request->getSession()->write('User', [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'role'     => $user->role,
                    'email'    => $user->email
                ]);
                switch ($user->role) {
                    case 'admin':
                        return $this->redirect(['action' => 'adminDashboard']);
                    case 'security':
                        return $this->redirect(['action' => 'securityDashboard']);
                    case 'employee':
                        return $this->redirect(['action' => 'employeeDashboard']);
                }

            } else {
                $this->Flash->error('Invalid username, password or role.');
            }
        }
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        return $this->redirect(['action' => 'login']);
    }

    public function adminDashboard()
    {
        $this->checkLogin('admin');
    }

    public function securityDashboard()
    {
        $this->checkLogin('security');
    }

    public function employeeDashboard()
    {
        $this->checkLogin('employee');
    }

    private function checkLogin($role)
    {
        $session = $this->request->getSession();

        if (!$session->check('User')) {
            return $this->redirect(['action' => 'login']);
        }

        if ($session->read('User.role') !== $role) {
            return $this->redirect(['action' => 'login']);
        }
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if ($this->Users->save($user)) {
                $this->Flash->success('User has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to add the user.');
        }
        
        $this->set('user', $user);
    }
}