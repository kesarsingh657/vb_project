<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function login()
    {
        // Simple login page - no authentication logic
        // Just display the login form
        $this->viewBuilder()->setLayout('login');
    }

    public function logout()
    {
        // Simple logout redirect
        $this->Flash->success('You have been logged out.');
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function index()
    {
        $users = $this->Users->find('all');
        $this->set(compact('users'));
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