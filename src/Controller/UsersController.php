<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($this->request->is('post')) {
            if ($result && $result->isValid()) {
                $user = $this->Authentication->getIdentity();
                
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => ucfirst($user->role),
                    'action' => 'dashboard'
                ]);

                return $this->redirect($redirect);
            }
            
            $this->Flash->error('Invalid username or password. Please try again.');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}