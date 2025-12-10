<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class VisitorsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->Visits = TableRegistry::getTableLocator()->get('Visits');
        $this->VisitorMaster = TableRegistry::getTableLocator()->get('VisitorMaster');
        $this->VisitReason = TableRegistry::getTableLocator()->get('VisitReason');
        $this->VisitorGroupMembers = TableRegistry::getTableLocator()->get('VisitorGroupMembers');

        $this->viewBuilder()->setLayout('sidebar');
    }

    public function index()
    {
        return $this->redirect('/dashboard/admin');
    }

    public function addSingle()
    {
        echo "Add Single Visitor Page Loaded!";
        exit;
    }

    public function addGroup()
    {
        echo "Add Group Visitor Page Loaded!";
        exit;
    }

    public function view($id)
    {
        echo "View Visitor ID: " . $id;
        exit;
    }
    
    public function invite()
{
    $this->viewBuilder()->setLayout('sidebar');

    if ($this->request->is('post')) {

        $data = $this->request->getData();

        // SAVE INVITE LOGIC (insert into visits table)
        $invite = $this->Visits->newEntity([
            'visitor_name'     => $data['visitor_name'],
            'visitor_email'    => $data['visitor_email'],
            'visitor_mobile'   => $data['visitor_mobile'],
            'host_name'        => $data['host_name'],
            'host_department'  => $data['host_department'],
            'host_mobile'      => $data['host_mobile'],
            'visit_date'       => $data['visit_date'],
            'visit_time'       => $data['visit_time'],
            'visit_reason'     => $data['visit_reason'],
            'host_status'      => 'approved',
            'created_by'       => 'admin'
        ]);

        if ($this->Visits->save($invite)) {
            $this->Flash->success("Visitor Invited Successfully!");
            return $this->redirect('/dashboard/admin');
        }

        $this->Flash->error("Could not send invite. Try again.");
    }
}


public function reports()
{
    $this->viewBuilder()->setLayout('sidebar');

    $from = $this->request->getQuery('from');
    $to   = $this->request->getQuery('to');

    $query = $this->Visits->find();

    if ($from && $to) {
        $query->where([
            'visit_date >=' => $from,
            'visit_date <=' => $to
        ]);
    }

    $visits = $query->order(['visit_date' => 'DESC'])->all();

    $this->set(compact('visits'));
}


public function settings()
{
    $this->viewBuilder()->setLayout('sidebar');

    $user = $this->request->getSession()->read('user');

    if ($this->request->is('post')) {
        $username = $this->request->getData('username');
        $password = $this->request->getData('password');

        $u = $this->Users->get($user->id);
        $u->username = $username;
        $u->password = $password; // no hashing as per your requirement

        $this->Users->save($u);

        $this->Flash->success("Settings updated!");
        return $this->redirect('/dashboard/admin');
    }

    $this->set(compact('user'));
}

}
