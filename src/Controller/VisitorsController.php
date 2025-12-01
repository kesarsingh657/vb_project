<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class VisitorsController extends AppController
{
    // Dashboard
    public function dashboard()
    {
    }

    // Settings Page (FIX FOR YOUR ERROR)
    public function settings()
    {
        // logic later
    }

    // Invite Page
    public function invite()
    {
        // logic later
    }

    // List all visitors
    public function index()
    {
        $visitors = $this->paginate($this->Visitors);
        $this->set(compact('visitors'));
    }

    // Reports page
    public function reports()
    {
        $visitors = $this->Visitors->find()->all();
        $this->set(compact('visitors'));
    }

    // View visitor
    public function view($id = null)
    {
        $visitor = $this->Visitors->get($id);
        $this->set(compact('visitor'));
    }

    // Add visitor
    public function add()
    {
        $visitor = $this->Visitors->newEmptyEntity();

        if ($this->request->is('post')) {
            $visitor = $this->Visitors->patchEntity($visitor, $this->request->getData());

            if ($this->Visitors->save($visitor)) {
                $this->Flash->success(__('Visitor saved successfully.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to save visitor.'));
        }

        $this->set(compact('visitor'));
    }

    // Edit visitor
    public function edit($id = null)
    {
        $visitor = $this->Visitors->get($id);

        if ($this->request->is(['post', 'put'])) {
            $visitor = $this->Visitors->patchEntity($visitor, $this->request->getData());

            if ($this->Visitors->save($visitor)) {
                $this->Flash->success(__('Visitor updated.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to update visitor.'));
        }

        $this->set(compact('visitor'));
    }

    // Delete visitor
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visitor = $this->Visitors->get($id);

        if ($this->Visitors->delete($visitor)) {
            $this->Flash->success(__('Visitor deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete visitor.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
