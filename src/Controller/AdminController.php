<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AdminController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }
    
    public function login()
    {
        $this->viewBuilder()->setLayout('login');

        if ($this->request->is('post')) {

            $username = $this->request->getData('username');
            $password = $this->request->getData('password');

            $adminsTable = $this->getTableLocator()->get('Admins');

            $admin = $adminsTable->find()
                ->where(['username' => $username])
                ->first();

            // 🔥 Plain password check (no hashing)
            if ($admin && $password === $admin->password) {

                $session = $this->request->getSession();
                $session->write('admin_id', $admin->id);
                $session->write('admin_username', $admin->username);

                return $this->redirect(['controller' => 'Visitors', 'action' => 'dashboard']);
            }

            $this->Flash->error('Invalid username or password.');
        }
    }

    public function logout()
    {
        $session = $this->request->getSession();
        $session->destroy();
        $this->Flash->success('Logged out successfully');
        return $this->redirect(['action' => 'login']);
    }
}
