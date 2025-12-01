<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class EmployeeController extends AppController
{
    public function index()
    {
        $userId = $this->request->getSession()->read('User.id');
        $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
        
        $today = date('Y-m-d');
        $dateFilter = $this->request->getQuery('date', $today);
        $search = $this->request->getQuery('search');
        
        $query = $visitorVisitsTable->find()
            ->where(['host_id' => $userId, 'visit_date' => $dateFilter])
            ->order(['created_date' => 'DESC']);
        
        if ($search) {
            $query->where([
                'OR' => [
                    'visitor_name LIKE' => '%' . $search . '%',
                    'visitor_mobile LIKE' => '%' . $search . '%',
                    'group_name LIKE' => '%' . $search . '%'
                ]
            ]);
        }
        
        $visits = $query->toArray();
        
        $this->set(compact('visits', 'dateFilter'));
    }
    
    public function newInvite()
    {
        $visitReasonsTable = TableRegistry::getTableLocator()->get('VisitReasons');
        
        $visitReasons = $visitReasonsTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'reason_name'
        ])->where(['status' => 'active'])->toArray();
        
        $this->set(compact('visitReasons'));
    }
    
    public function createInvite()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            $visitorMastersTable = TableRegistry::getTableLocator()->get('VisitorMasters');
            $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
            
            $user = $this->request->getSession()->read('User');
            $inviteType = $data['invite_type'];
            
            if ($inviteType == 'single') {
                // Check if visitor exists
                $visitor = $visitorMastersTable->find()
                    ->where(['mobile_number' => $data['visitor_mobile']])
                    ->first();
                
                if (!$visitor) {
                    $visitor = $visitorMastersTable->newEntity([
                        'visitor_name' => $data['visitor_name'],
                        'mobile_number' => $data['visitor_mobile'],
                        'email' => $data['visitor_email'],
                        'address' => $data['visitor_address'],
                        'company_name' => $data['visitor_company']
                    ]);
                    $visitorMastersTable->save($visitor);
                }
                
                // Generate QR code
                $qrData = 'VP_' . time();
                
                // Create visit
                $visit = $visitorVisitsTable->newEntity([
                    'visit_type' => 'single',
                    'visitor_id' => $visitor->id,
                    'visitor_name' => $data['visitor_name'],
                    'visitor_mobile' => $data['visitor_mobile'],
                    'visitor_email' => $data['visitor_email'],
                    'visitor_address' => $data['visitor_address'],
                    'visitor_company' => $data['visitor_company'],
                    'host_id' => $user['id'],
                    'host_name' => $user['name'],
                    'host_department' => $user['department'],
                    'host_phone' => $user['phone'],
                    'visit_date' => $data['visit_date'],
                    'visit_time' => $data['visit_time'],
                    'visit_reason_id' => $data['visit_reason'],
                    'visit_reason_text' => $data['visit_reason_text'],
                    'note_to_host' => $data['note_to_visitor'],
                    'host_approval_status' => 'approved',
                    'visit_status' => 'pending',
                    'is_pre_registered' => 'yes',
                    'qr_code_path' => $qrData,
                    'created_by' => $user['id']
                ]);
                
                if ($visitorVisitsTable->save($visit)) {
                    $this->Flash->success('Invite created successfully');
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                // Group invite
                $groupId = time();
                $qrData = 'VP_' . $groupId;
                
                foreach ($data['visitors'] as $visitorData) {
                    $visitor = $visitorMastersTable->find()
                        ->where(['mobile_number' => $visitorData['mobile']])
                        ->first();
                    
                    if (!$visitor) {
                        $visitor = $visitorMastersTable->newEntity([
                            'visitor_name' => $visitorData['name'],
                            'mobile_number' => $visitorData['mobile'],
                            'email' => $visitorData['email'],
                            'address' => $visitorData['address'],
                            'company_name' => $visitorData['company']
                        ]);
                        $visitorMastersTable->save($visitor);
                    }
                    
                    $visit = $visitorVisitsTable->newEntity([
                        'visit_type' => 'group',
                        'visitor_id' => $visitor->id,
                        'visitor_name' => $visitorData['name'],
                        'visitor_mobile' => $visitorData['mobile'],
                        'visitor_email' => $visitorData['email'],
                        'visitor_address' => $visitorData['address'],
                        'visitor_company' => $visitorData['company'],
                        'group_name' => $data['group_name'],
                        'group_id' => $groupId,
                        'host_id' => $user['id'],
                        'host_name' => $user['name'],
                        'host_department' => $user['department'],
                        'host_phone' => $user['phone'],
                        'visit_date' => $data['visit_date'],
                        'visit_time' => $data['visit_time'],
                        'visit_reason_id' => $data['visit_reason'],
                        'visit_reason_text' => $data['visit_reason_text'],
                        'host_approval_status' => 'approved',
                        'visit_status' => 'pending',
                        'is_pre_registered' => 'yes',
                        'qr_code_path' => $qrData,
                        'created_by' => $user['id']
                    ]);
                    
                    $visitorVisitsTable->save($visit);
                }
                
                $this->Flash->success('Group invite created successfully');
                return $this->redirect(['action' => 'index']);
            }
        }
    }
    
    public function approveVisit($id)
    {
        $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
        $visit = $visitorVisitsTable->get($id);
        
        $visit->host_approval_status = 'approved';
        
        if ($visitorVisitsTable->save($visit)) {
            $this->Flash->success('Visit approved successfully');
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    public function rejectVisit($id)
    {
        $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
        $visit = $visitorVisitsTable->get($id);
        
        $visit->host_approval_status = 'rejected';
        $visit->visit_status = 'rejected';
        
        if ($visitorVisitsTable->save($visit)) {
            $this->Flash->success('Visit rejected successfully');
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    public function cancelInvite($id)
    {
        $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
        $visit = $visitorVisitsTable->get($id);
        
        $visit->visit_status = 'cancelled';
        
        if ($visitorVisitsTable->save($visit)) {
            $this->Flash->success('Invite cancelled successfully');
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    public function viewVisit($id)
    {
        $visitorVisitsTable = TableRegistry::getTableLocator()->get('VisitorVisits');
        $visit = $visitorVisitsTable->get($id);
        
        $previousVisits = $visitorVisitsTable->find()
            ->where([
                'visitor_id' => $visit->visitor_id,
                'id !=' => $id
            ])
            ->order(['visit_date' => 'DESC'])
            ->toArray();
        
        $this->set(compact('visit', 'previousVisits'));
    }
}