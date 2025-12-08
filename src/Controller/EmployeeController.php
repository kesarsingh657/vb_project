<?php
// File: src/Controller/EmployeeController.php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

class EmployeeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Visits');
        $this->loadModel('VisitorMaster');
        $this->loadModel('VisitReasons');
        $this->loadModel('VisitDetails');
        $this->loadModel('Users');
    }

    public function dashboard()
    {
        // Check if user is employee
        $user = $this->Authentication->getIdentity();
        if ($user->role !== 'employee' && $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        // Get visits where user is the host
        $visits = $this->Visits->find()
            ->contain(['VisitorMaster', 'VisitReasons'])
            ->where(['Visits.host_id' => $user->id])
            ->order(['Visits.created' => 'DESC'])
            ->limit(50)
            ->toArray();

        // Today's visitors
        $today = date('Y-m-d');
        $todayVisits = array_filter($visits, function($v) use ($today) {
            return $v->visit_date === $today;
        });

        // Pending approvals
        $pendingCount = count(array_filter($visits, function($v) {
            return $v->approval_status === 'pending';
        }));

        $this->set(compact('visits', 'todayVisits', 'pendingCount', 'user'));
    }

    public function newInvite()
    {
        $user = $this->Authentication->getIdentity();
        if ($user->role !== 'employee' && $user->role !== 'admin') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $visitReasons = $this->VisitReasons->find('list', [
            'keyField' => 'id',
            'valueField' => 'reason_name'
        ])->where(['is_active' => 1])->toArray();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Handle visitor master entry
            $visitor = $this->VisitorMaster->find()
                ->where(['mobile_number' => $data['mobile_number']])
                ->first();

            if (!$visitor) {
                $visitor = $this->VisitorMaster->newEntity([
                    'name' => $data['name'],
                    'mobile_number' => $data['mobile_number'],
                    'email' => $data['email'] ?? null,
                    'address' => $data['address'] ?? null,
                    'company_name' => $data['company_name'] ?? null
                ]);
                $this->VisitorMaster->save($visitor);
            }

            // Create visit invite
            $qrCode = 'VP_' . uniqid();
            
            $visit = $this->Visits->newEntity([
                'visitor_id' => $visitor->id,
                'visit_type' => 'single',
                'visit_date' => $data['visit_date'],
                'visit_time' => $data['visit_time'],
                'visit_reason_id' => $data['visit_reason_id'],
                'host_id' => $user->id,
                'host_department' => $user->department,
                'host_phone' => $user->phone_number,
                'note_to_host' => $data['note_to_visitor'] ?? null,
                'approval_status' => 'approved',
                'is_pre_registered' => 1,
                'qr_code' => $qrCode,
                'created_by' => $user->id,
                'created_role' => 'employee'
            ]);

            if ($this->Visits->save($visit)) {
                // Send invitation email to visitor
                $this->sendVisitorInvitation($visit, $visitor, $user, $qrCode);
                
                $this->Flash->success('Visitor invitation created successfully!');
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error('Failed to create invitation. Please try again.');
            }
        }

        $this->set(compact('visitReasons', 'user'));
    }

    public function approveVisit($id)
    {
        $visit = $this->Visits->get($id);
        
        if ($visit->host_id != $this->Authentication->getIdentity()->id) {
            $this->Flash->error('Unauthorized action');
            return $this->redirect(['action' => 'dashboard']);
        }

        $visit->approval_status = 'approved';
        
        if ($this->Visits->save($visit)) {
            $this->Flash->success('Visit approved successfully!');
        } else {
            $this->Flash->error('Failed to approve visit.');
        }
        
        return $this->redirect(['action' => 'dashboard']);
    }

    public function rejectVisit($id)
    {
        $visit = $this->Visits->get($id);
        
        if ($visit->host_id != $this->Authentication->getIdentity()->id) {
            $this->Flash->error('Unauthorized action');
            return $this->redirect(['action' => 'dashboard']);
        }

        $visit->approval_status = 'rejected';
        
        if ($this->Visits->save($visit)) {
            $this->Flash->success('Visit rejected.');
        } else {
            $this->Flash->error('Failed to reject visit.');
        }
        
        return $this->redirect(['action' => 'dashboard']);
    }

    public function cancelInvite($id)
    {
        $visit = $this->Visits->get($id);
        
        if ($visit->host_id != $this->Authentication->getIdentity()->id) {
            $this->Flash->error('Unauthorized action');
            return $this->redirect(['action' => 'dashboard']);
        }

        if ($this->Visits->delete($visit)) {
            $this->Flash->success('Invitation cancelled successfully!');
        } else {
            $this->Flash->error('Failed to cancel invitation.');
        }
        
        return $this->redirect(['action' => 'dashboard']);
    }

    private function sendVisitorInvitation($visit, $visitor, $host, $qrCode)
    {
        try {
            $visitDate = date('d M Y', strtotime($visit->visit_date));
            $visitTime = date('h:i A', strtotime($visit->visit_time));
            
            $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($qrCode);
            
            $email = new Email('default');
            $email->setTo($visitor->email ?? 'kesarsingh6578@gmail.com')
                ->setSubject('Visitor Invitation - LAVA')
                ->setEmailFormat('html')
                ->send("
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                        <h2 style='color: #dc3545;'>🏢 Visitor Invitation</h2>
                        <p>Dear {$visitor->name},</p>
                        <p>You have been invited to visit LAVA premises by <strong>{$host->username}</strong> from {$host->department}.</p>
                        
                        <div style='background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 20px 0;'>
                            <h3 style='margin-top: 0;'>Visit Details:</h3>
                            <p><strong>Date:</strong> {$visitDate}</p>
                            <p><strong>Time:</strong> {$visitTime}</p>
                            <p><strong>Host:</strong> {$host->username}</p>
                            <p><strong>Department:</strong> {$host->department}</p>
                        </div>

                        <div style='text-align: center; margin: 30px 0;'>
                            <p><strong>Your QR Code (Show this at reception):</strong></p>
                            <img src='{$qrCodeUrl}' alt='QR Code' style='max-width: 200px;'>
                            <p style='color: #666; font-size: 14px;'>QR Code: {$qrCode}</p>
                        </div>

                        <p style='color: #666; font-size: 14px;'>Please carry a valid ID proof for verification.</p>
                        
                        <hr style='border: none; border-top: 1px solid #ddd; margin: 30px 0;'>
                        <p style='color: #999; font-size: 12px;'>This is an automated email from LAVA Visitor Management System.</p>
                    </div>
                ");
        } catch (\Exception $e) {
            // Log error but don't stop execution
        }
    }
}