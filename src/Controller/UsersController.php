<?php
namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $user = $this->Authentication->getIdentity();
            $role = $user->role;

            return $this->redirect([
                'controller' => ucfirst($role),
                'action' => 'dashboard'
            ]);
        }

        if ($this->request->is('post') && (!$result || !$result->isValid())) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['action' => 'login']);
    }
}
