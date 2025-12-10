<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class VisitorsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // Load all models using TableRegistry (CakePHP 5 correct way)
        $this->Visits               = TableRegistry::getTableLocator()->get('Visits');
        $this->VisitorMasters       = TableRegistry::getTableLocator()->get('VisitorMaster');
        $this->VisitReasons         = TableRegistry::getTableLocator()->get('VisitReason');
        $this->VisitorGroupMembers  = TableRegistry::getTableLocator()->get('VisitorGroupMembers');
        $this->Users                = TableRegistry::getTableLocator()->get('Users');

        // Sidebar layout for all pages
        $this->viewBuilder()->setLayout('sidebar');
    }

    /* ============================================
     * DEFAULT → REDIRECT TO DASHBOARD
     * ============================================ */
    public function index()
    {
        return $this->redirect('/dashboard/admin');
    }

    /* ============================================
     * ADD SINGLE VISITOR
     * ============================================ */
    public function addSingle()
    {
        if ($this->request->is('post')) {

            // Create new visit record
            $visit = $this->Visits->newEmptyEntity();
            $visit = $this->Visits->patchEntity($visit, $this->request->getData());

            if ($this->Visits->save($visit)) {
                $this->Flash->success("Visitor added successfully!");
                return $this->redirect('/dashboard/admin');
            }

            $this->Flash->error("Error saving visitor!");
        }

        $reasons = $this->VisitReasons->find('list')->toArray();
        $this->set(compact('reasons'));
    }

    /* ============================================
     * ADD GROUP VISITOR
     * ============================================ */
    public function addGroup()
    {
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            // Save main visit record
            $visit = $this->Visits->newEmptyEntity();
            $visit = $this->Visits->patchEntity($visit, $data);

            if ($this->Visits->save($visit)) {

                $visit_id = $visit->id;

                // Save group members
                if (!empty($data['group_members'])) {
                    foreach ($data['group_members'] as $m) {
                        if (!empty($m['name'])) {
                            $member = $this->VisitorGroupMembers->newEmptyEntity();
                            $member->visit_id = $visit_id;
                            $member->name     = $m['name'];
                            $member->mobile   = $m['mobile'] ?? null;

                            $this->VisitorGroupMembers->save($member);
                        }
                    }
                }

                $this->Flash->success("Group visit registered successfully!");
                return $this->redirect('/dashboard/admin');
            }

            $this->Flash->error("Error adding group visit!");
        }

        $reasons = $this->VisitReasons->find('list')->toArray();
        $this->set(compact('reasons'));
    }

    /* ============================================
     * VIEW VISITOR DETAILS
     * ============================================ */
    public function view($id)
    {
        $visit = $this->Visits->get($id);
        $this->set(compact('visit'));
    }

    /* ============================================
     * INVITE VISITOR
     * ============================================ */
    public function invite()
    {
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $invite = $this->Visits->newEntity([
                'visitor_name'    => $data['visitor_name'],
                'visitor_email'   => $data['visitor_email'],
                'visitor_mobile'  => $data['visitor_mobile'],
                'host_name'       => $data['host_name'],
                'host_department' => $data['host_department'],
                'host_mobile'     => $data['host_mobile'],
                'visit_date'      => $data['visit_date'],
                'visit_time'      => $data['visit_time'],
                'visit_reason'    => $data['visit_reason'],
                'host_status'     => 'approved',
                'created_by'      => 'admin'
            ]);

            if ($this->Visits->save($invite)) {
                $this->Flash->success("Invitation sent successfully!");
                return $this->redirect('/dashboard/admin');
            }

            $this->Flash->error("Failed to send invitation.");
        }

        $reasons = $this->VisitReasons->find('list')->toArray();
        $this->set(compact('reasons'));
    }

    /* ============================================
     * REPORTS
     * ============================================ */
    public function reports()
{
    $from = $this->request->getQuery('from');
    $to   = $this->request->getQuery('to');

    $conditions = [];

    if ($from) $conditions['visit_date >='] = $from;
    if ($to)   $conditions['visit_date <='] = $to;

    $visits = $this->Visits
        ->find()
        ->where($conditions)
        ->order(['visit_date' => 'DESC'])
        ->all();

    $this->set(compact('visits'));
}


    /* ============================================
     * SETTINGS
     * ============================================ */
    public function settings()
    {
        $user = $this->Users->find()->first();

        if ($this->request->is('post')) {

            $u = $this->Users->get($user->id);
            $u->username = $this->request->getData('username');
            $u->password = $this->request->getData('password'); // as per your requirement, NOT hashed

            $this->Users->save($u);

            $this->Flash->success("Settings updated!");
            return $this->redirect('/settings');
        }

        $this->set(compact('user'));
    }
}
