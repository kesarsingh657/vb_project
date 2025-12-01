<?php
namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Routing\Router;

class VisitorsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function dashboard()
    {
        $visitors = $this->Visitors->find()
            ->where(['visit_date' => date('Y-m-d')])
            ->orderDesc('created_at')
            ->toArray();

        $this->set(compact('visitors'));
    }

    public function add()
    {
        $visitor = $this->Visitors->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            $photoFile = $this->request->getData('photo');
            if ($photoFile && $photoFile->getError() === UPLOAD_ERR_OK) {
                $filename = time() . '_' . $photoFile->getClientFilename();
                $uploadsDir = WWW_ROOT . 'img' . DS . 'uploads';
                
                if (!is_dir($uploadsDir)) {
                    mkdir($uploadsDir, 0755, true);
                }
                
                $destination = $uploadsDir . DS . $filename;
                $photoFile->moveTo($destination);
                $data['photo'] = $filename;
            }
            
            $visitor = $this->Visitors->patchEntity($visitor, $data);
            
            if ($this->Visitors->save($visitor)) {
                $this->sendApprovalRequest($visitor);
                
                $this->Flash->success('Visitor added successfully. Approval request sent to host.');
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error('Unable to add visitor.');
        }
        
        $this->set(compact('visitor'));
    }

    public function checkExisting()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        
        $mobile = $this->request->getQuery('mobile');
        
        $visitor = $this->Visitors->find()
            ->where(['mobile_number' => $mobile])
            ->first();
        
        $result = [
            'exists' => $visitor ? true : false,
            'data' => $visitor ? [
                'name' => $visitor->visitor_name,
                'email' => $visitor->email,
                'address' => $visitor->address,
                'company' => $visitor->company_name
            ] : null
        ];
        
        $this->response = $this->response->withStringBody(json_encode($result));
        return $this->response;
    }

    public function searchHost()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        
        $term = $this->request->getQuery('term');
        
        $employeesTable = $this->fetchTable('EmployeeMaster');
        
        $hosts = $employeesTable->find()
            ->where(['emp_name LIKE' => '%' . $term . '%'])
            ->limit(10)
            ->toArray();
        
        $result = [];
        foreach ($hosts as $host) {
            $result[] = [
                'name' => $host->emp_name,
                'employee_code' => $host->emp_code,
                'department' => $host->department,
                'phone' => $host->mobile_number
            ];
        }
        
        $this->response = $this->response->withStringBody(json_encode($result));
        return $this->response;
    }

    private function sendApprovalRequest($visitor)
    {
        $approvalRequestsTable = $this->fetchTable('ApprovalRequests');
        
        $approvalRequest = $approvalRequestsTable->newEntity([
            'visitor_id' => $visitor->id,
            'host_email' => $this->request->getData('host_email'),
            'host_phone' => $visitor->host_phone,
            'approval_token' => bin2hex(random_bytes(16)),
            'status' => 'pending'
        ]);
        
        $approvalRequestsTable->save($approvalRequest);
        $this->sendApprovalEmail($visitor, $approvalRequest);
    }

    private function sendApprovalEmail($visitor, $approvalRequest)
    {
        try {
            $mailer = new Mailer('default');
            $approveUrl = Router::url([
                'controller' => 'Visitors',
                'action' => 'hostApproval',
                $approvalRequest->approval_token
            ], true);
            
            $mailer->setFrom(['noreply@visitormanagement.com' => 'Visitor Management'])
                ->setTo($approvalRequest->host_email)
                ->setSubject('Visitor Approval Request')
                ->setEmailFormat('html')
                ->deliver("
                    <h3>Visitor Approval Request</h3>
                    <p><strong>Name:</strong> {$visitor->visitor_name}</p>
                    <p><strong>Mobile:</strong> {$visitor->mobile_number}</p>
                    <p><strong>Company:</strong> {$visitor->company_name}</p>
                    <p><strong>Purpose:</strong> {$visitor->visit_reason}</p>
                    <br>
                    <a href='{$approveUrl}' style='background:#007bff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>View & Respond</a>
                ");
        } catch (\Exception $e) {
            // Email failed
        }
    }

    public function hostApproval($token = null)
    {
        $approvalRequestsTable = $this->fetchTable('ApprovalRequests');
        
        $approvalRequest = $approvalRequestsTable->find()
            ->where(['approval_token' => $token])
            ->first();
        
        if (!$approvalRequest) {
            $this->Flash->error('Invalid approval link.');
            return $this->redirect('/');
        }
        
        $visitor = $this->Visitors->get($approvalRequest->visitor_id);
        
        if ($this->request->is('post')) {
            $action = $this->request->getData('action');
            
            if ($action === 'approve') {
                $approvalRequest->status = 'approved';
                $approvalRequest->approved_at = date('Y-m-d H:i:s');
                $approvalRequestsTable->save($approvalRequest);
                
                $visitor->host_status = 'approved';
                $visitor->host_approval_time = date('Y-m-d H:i:s');
                $this->Visitors->save($visitor);
                
                $this->Flash->success('Visit approved successfully.');
            } else {
                $approvalRequest->status = 'rejected';
                $approvalRequestsTable->save($approvalRequest);
                
                $visitor->host_status = 'rejected';
                $this->Visitors->save($visitor);
                
                $this->Flash->error('Visit rejected.');
            }
            
            return $this->redirect(['action' => 'hostApproval', $token]);
        }
        
        $this->set(compact('visitor', 'approvalRequest'));
    }

    public function invite()
    {
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['is_pre_registered'] = 1;
            
            $visitor = $this->Visitors->newEntity($data);
            
            if ($this->Visitors->save($visitor)) {
                $qrCode = 'VP_' . $visitor->id;
                $this->sendQRCodeEmail($visitor, $qrCode);
                
                $this->Flash->success('Invitation sent successfully with QR code to ' . $visitor->email);
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error('Unable to send invitation.');
        }
        
    }

    private function sendQRCodeEmail($visitor, $qrCode)
    {
        try {
            $mailer = new Mailer('default');
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . $qrCode;
            $content="";
            $content .= "<h3>Visitor Pass</h3>";
            $content .= "<p><strong>Name:</strong> " . $visitor->name . "</p>";
            $content .= "<p><strong>Email:</strong> " . $visitor->email . "</p>";
            $content .= "<p><strong>Phone:</strong> " . $visitor->phone . "</p>";
            $content .= "<p><strong>Company:</strong> " . $visitor->company . "</p>";
            $mailer->setTo($visitor->email)
                ->setSubject('Your Visitor Pass')
                ->setEmailFormat('html')
                ->deliver($content);
        } catch (\Exception $e) {
            echo "<pre>";
            print_r($e->getMessage());
            die;
        }
    }

    public function checkIn($id = null)
    {
        if ($id) {
            $visitor = $this->Visitors->get($id);
            $visitor->check_in_time = date('Y-m-d H:i:s');
            $this->Visitors->save($visitor);
            
            $this->Flash->success('Visitor checked in.');
        }
        return $this->redirect(['action' => 'dashboard']);
    }

    public function checkOut($id = null)
    {
        if ($id) {
            $visitor = $this->Visitors->get($id);
            $visitor->check_out_time = date('Y-m-d H:i:s');
            $this->Visitors->save($visitor);
            
            $this->Flash->success('Visitor checked out.');
        }
        return $this->redirect(['action' => 'dashboard']);
    }

    public function view($id = null)
    {
        $visitor = $this->Visitors->get($id);
        
        $history = $this->Visitors->find()
            ->where([
                'mobile_number' => $visitor->mobile_number,
                'id !=' => $id
            ])
            ->orderDesc('visit_date')
            ->toArray();
        
        $this->set(compact('visitor', 'history'));
    }

    public function downloadPhoto($id = null)
    {
        $visitor = $this->Visitors->get($id);
        
        if (!empty($visitor->photo)) {
            $filePath = WWW_ROOT . 'img' . DS . 'uploads' . DS . $visitor->photo;
            
            if (file_exists($filePath)) {
                $this->response = $this->response->withFile($filePath, [
                    'download' => true,
                    'name' => $visitor->visitor_name . '_photo.jpg'
                ]);
                return $this->response;
            }
        }
        
        $this->Flash->error('Photo not found.');
        return $this->redirect(['action' => 'view', $id]);
    }

    public function edit($id = null)
    {
        $visitor = $this->Visitors->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            $photoFile = $this->request->getData('photo');
            if ($photoFile && $photoFile->getError() === UPLOAD_ERR_OK) {
                $filename = time() . '_' . $photoFile->getClientFilename();
                $uploadsDir = WWW_ROOT . 'img' . DS . 'uploads';
                
                if (!is_dir($uploadsDir)) {
                    mkdir($uploadsDir, 0755, true);
                }
                
                $destination = $uploadsDir . DS . $filename;
                $photoFile->moveTo($destination);
                $data['photo'] = $filename;
            }
            
            $visitor = $this->Visitors->patchEntity($visitor, $data);
            
            if ($this->Visitors->save($visitor)) {
                $this->Flash->success('Visitor updated.');
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error('Unable to update visitor.');
        }
        
        $this->set(compact('visitor'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visitor = $this->Visitors->get($id);
        
        if ($this->Visitors->delete($visitor)) {
            $this->Flash->success('Visitor deleted.');
        } else {
            $this->Flash->error('Unable to delete visitor.');
        }
        
        return $this->redirect(['action' => 'dashboard']);
    }

    public function reports()
    {
        $query = $this->Visitors->find();
        
        if ($this->request->getQuery('from_date')) {
            $query->where(['visit_date >=' => $this->request->getQuery('from_date')]);
        }
        
        if ($this->request->getQuery('to_date')) {
            $query->where(['visit_date <=' => $this->request->getQuery('to_date')]);
        }
        
        if ($this->request->getQuery('host')) {
            $query->where(['host_name LIKE' => '%' . $this->request->getQuery('host') . '%']);
        }
        
        if ($this->request->getQuery('visitor')) {
            $query->where([
                'OR' => [
                    'visitor_name LIKE' => '%' . $this->request->getQuery('visitor') . '%',
                    'mobile_number LIKE' => '%' . $this->request->getQuery('visitor') . '%'
                ]
            ]);
        }
        
        $visitors = $query->orderDesc('visit_date')->toArray();
        
        $this->set(compact('visitors'));
    }

    public function settings()
    {
        if ($this->request->is('post')) {
            $this->Flash->success('Settings saved.');
            return $this->redirect(['action' => 'settings']);
        }
    }
}