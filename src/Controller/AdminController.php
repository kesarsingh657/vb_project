<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class AdminController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // Load models
        $this->Visits = $this->fetchTable('Visits');
        $this->VisitorMaster = $this->fetchTable('VisitorMaster');
        $this->Users = $this->fetchTable('Users');
        $this->VisitReasons = $this->fetchTable('VisitReasons');

        // Authentication
        $this->loadComponent('Authentication.Authentication');
    }

    public function dashboard()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user || $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $visits = $this->Visits->find()
            ->order(['created' => 'DESC'])
            ->limit(50)
            ->all();

        $totalVisitors = $this->VisitorMaster->find()->count();
        $totalVisits = $this->Visits->find()->count();
        $todayVisits = $this->Visits->find()->where(['visit_date' => date('Y-m-d')])->count();

        $this->set(compact('user', 'visits', 'totalVisitors', 'totalVisits', 'todayVisits'));
    }

    public function visitors()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user || $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $visitors = $this->VisitorMaster->find()
            ->order(['created' => 'DESC'])
            ->all();

        $this->set(compact('user', 'visitors'));
    }

    public function visitReasons()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user || $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        if ($this->request->is('post')) {
            $reason = $this->VisitReasons->newEntity($this->request->getData());

            if ($this->VisitReasons->save($reason)) {
                $this->Flash->success('Visit reason added!');
                return $this->redirect(['action' => 'visitReasons']);
            }

            $this->Flash->error('Unable to save visit reason.');
        }

        $reasons = $this->VisitReasons->find()
            ->order(['created' => 'DESC'])
            ->all();

        $this->set(compact('user', 'reasons'));
    }

    public function reports()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user || $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $date = $this->request->getQuery('date', date('Y-m-d'));

        $visits = $this->Visits->find()
            ->where(['visit_date' => $date])
            ->order(['created' => 'DESC'])
            ->all();

        $this->set(compact('user', 'visits', 'date'));
    }

    public function users()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user || $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $newUser = $this->Users->newEntity($data);

            if ($this->Users->save($newUser)) {
                $this->Flash->success('User added!');
                return $this->redirect(['action' => 'users']);
            }

            $this->Flash->error('Unable to add user.');
        }

        $allUsers = $this->Users->find()
            ->order(['created' => 'DESC'])
            ->all();

        $this->set(compact('user', 'allUsers'));
    }
}
