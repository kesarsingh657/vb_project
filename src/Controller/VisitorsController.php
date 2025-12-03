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

    /* ---------------------------
        VISITOR DASHBOARD (TODAY)
    ----------------------------*/
    public function dashboard()
    {
        $visitors = $this->Visitors->find()
            ->where(['visit_date' => date('Y-m-d')])
            ->orderDesc('created_at')
            ->toArray();

        $this->set(compact('visitors'));
    }

    /* ---------------------------
        ADD NEW VISITOR
    ----------------------------*/
    public function add()
    {
        $visitor = $this->Visitors->newEmptyEntity();

        if ($this->request->is('post')) {

            $formData = $this->request->getData();

            // Handle photo upload
            $photoFile = $formData['photo'] ?? null;

            if ($photoFile && $photoFile->getError() === UPLOAD_ERR_OK) {

                $fileName = time() . "_" . $photoFile->getClientFilename();
                $uploadPath = WWW_ROOT . "img/uploads";

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $photoFile->moveTo($uploadPath . DS . $fileName);
                $formData['photo'] = $fileName;
            }

            // Save visitor details
            $visitor = $this->Visitors->patchEntity($visitor, $formData);

            if ($this->Visitors->save($visitor)) {
                $this->sendApprovalRequest($visitor);

                $this->Flash->success("Visitor added successfully. Approval request sent.");
                return $this->redirect(['action' => 'dashboard']);
            }

            $this->Flash->error("Unable to add visitor.");
        }

        $this->set(compact('visitor'));
    }

    /* ---------------------------
        CHECK IF VISITOR ALREADY EXISTS (AJAX)
    ----------------------------*/
    public function checkExisting()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('json');

        $mobile = $this->request->getQuery('mobile');

        $visitor = $this->Visitors->find()
            ->where(['mobile_number' => $mobile])
            ->first();

        $result = [
            "exists" => $visitor ? true : false,
            "data" => $visitor ? [
                "name" => $visitor->visitor_name,
                "email" => $visitor->email,
                "address" => $visitor->address,
                "company" => $visitor->company_name
            ] : null
        ];

        return $this->response->withStringBody(json_encode($result));
    }

    /* ---------------------------
        SEARCH HOST (AJAX)
    ----------------------------*/
    public function searchHost()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('json');

        $term = $this->request->getQuery('term');
        $employees = $this->fetchTable('EmployeeMaster');

        $hosts = $employees->find()
            ->where(['emp_name LIKE' => "%$term%"])
            ->limit(10)
            ->toArray();

        $data = [];

        foreach ($hosts as $host) {
            $data[] = [
                "name" => $host->emp_name,
                "employee_code" => $host->emp_code,
                "department" => $host->department,
                "phone" => $host->mobile_number
            ];
        }

        return $this->response->withStringBody(json_encode($data));
    }

    /* ---------------------------
        CREATE APPROVAL REQUEST AND EMAIL HOST
    ----------------------------*/
    private function sendApprovalRequest($visitor)
    {
        $approvalTable = $this->fetchTable('ApprovalRequests');

        $approvalRequest = $approvalTable->newEntity([
            "visitor_id" => $visitor->id,
            "host_email" => $this->request->getData('host_email'),
            "host_phone" => $visitor->host_phone,
            "approval_token" => bin2hex(random_bytes(16)),
            "status" => "pending"
        ]);

        $approvalTable->save($approvalRequest);

        // Send approval email
        $this->sendApprovalEmail($visitor, $approvalRequest);
    }

    /* ---------------------------
        SEND APPROVAL EMAIL TO HOST
    ----------------------------*/
    private function sendApprovalEmail($visitor, $approvalRequest)
    {
        try {
            $mailer = new Mailer("default");

            // Create URL for host to approve visitor
            $approvalUrl = Router::url([
                "controller" => "Visitors",
                "action" => "hostApproval",
                $approvalRequest->approval_token
            ], true);

            $emailBody = "
                <h3>Visitor Approval Request</h3>
                <p><strong>Name:</strong> {$visitor->visitor_name}</p>
                <p><strong>Mobile:</strong> {$visitor->mobile_number}</p>
                <p><strong>Company:</strong> {$visitor->company_name}</p>
                <p><strong>Purpose:</strong> {$visitor->visit_reason}</p>
                <br>
                <a href='{$approvalUrl}' style='background:#007bff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>
                    Approve / Reject
                </a>
            ";

            $mailer->setFrom(['kesarsingh6578@gmail.com' => "Visitor System"])
                ->setTo($approvalRequest->host_email)
                ->setSubject("Visitor Approval Request")
                ->setEmailFormat("html")
                ->deliver($emailBody);

        } catch (\Exception $e) {
            debug($e->getMessage());
        }
    }

    /* ---------------------------
        HOST APPROVAL PAGE
    ----------------------------*/
    public function hostApproval($token = null)
    {
        $approvalTable = $this->fetchTable('ApprovalRequests');
        $approval = $approvalTable->find()->where(['approval_token' => $token])->first();

        if (!$approval) {
            $this->Flash->error("Invalid approval link.");
            return $this->redirect('/');
        }

        $visitor = $this->Visitors->get($approval->visitor_id);

        if ($this->request->is('post')) {

            $action = $this->request->getData('action');

            if ($action === "approve") {
                $approval->status = "approved";
                $approval->approved_at = date('Y-m-d H:i:s');
                $approvalTable->save($approval);

                $visitor->host_status = "approved";
                $visitor->host_approval_time = date('Y-m-d H:i:s');
                $this->Visitors->save($visitor);

                $this->Flash->success("Visitor approved.");
            } else {
                $approval->status = "rejected";
                $approvalTable->save($approval);

                $visitor->host_status = "rejected";
                $this->Visitors->save($visitor);

                $this->Flash->error("Visitor rejected.");
            }

            return $this->redirect(['action' => 'hostApproval', $token]);
        }

        $this->set(compact('visitor', 'approval'));
    }

    /* ---------------------------
        INVITE VISITOR (QR CODE EMAIL)
    ----------------------------*/
    public function invite()
    {
        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['is_pre_registered'] = 1;

            $visitor = $this->Visitors->newEntity($data);

            if ($this->Visitors->save($visitor)) {
                $qrCode = "VP_" . $visitor->id;

                $this->sendQRCodeEmail($visitor, $qrCode);

                $this->Flash->success("Invitation sent with QR code to {$visitor->email}");
                return $this->redirect(['action' => 'dashboard']);
            }

            $this->Flash->error("Unable to send invitation.");
        }
    }

    /* ---------------------------
        SEND QR CODE EMAIL
    ----------------------------*/
    private function sendQRCodeEmail($visitor, $qrCode)
    {
        try {
            $mailer = new Mailer("default");

            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . $qrCode;

            // Save QR image
            $qrDir = WWW_ROOT . "img/qrcodes/";

            if (!file_exists($qrDir)) {
                mkdir($qrDir, 0777, true);
            }

            $qrImage = $qrCode . ".png";
            $qrPath = $qrDir . $qrImage;

            file_put_contents($qrPath, file_get_contents($qrUrl));

            $emailContent = "
                <h3>Your Visitor Pass</h3>
                <p><strong>Name:</strong> {$visitor->visitor_name}</p>
                <p><strong>Email:</strong> {$visitor->email}</p>
                <p><strong>Phone:</strong> {$visitor->mobile_number}</p>
                <img src='" . Router::url("/img/qrcodes/$qrImage", true) . "' alt='QR Code'>
            ";

            $mailer->setFrom(['kesarsingh6578@gmail.com' => "Visitor System"])
                ->setTo($visitor->email)
                ->setSubject("Your Visitor Pass")
                ->setEmailFormat("html")
                ->deliver($emailContent);

        } catch (\Exception $e) {
            debug($e->getMessage());
        }
    }

    /* ---------------------------
        CHECK IN
    ----------------------------*/
    public function checkIn($id = null)
    {
        if ($id) {
            $visitor = $this->Visitors->get($id);
            $visitor->check_in_time = date('Y-m-d H:i:s');
            $this->Visitors->save($visitor);
            $this->Flash->success("Visitor checked in.");
        }

        return $this->redirect(['action' => 'dashboard']);
    }

    /* ---------------------------
        CHECK OUT
    ----------------------------*/
    public function checkOut($id = null)
    {
        if ($id) {
            $visitor = $this->Visitors->get($id);
            $visitor->check_out_time = date('Y-m-d H:i:s');
            $this->Visitors->save($visitor);
            $this->Flash->success("Visitor checked out.");
        }

        return $this->redirect(['action' => 'dashboard']);
    }

    /* ---------------------------
        VIEW VISITOR DETAILS + HISTORY
    ----------------------------*/
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

    /* ---------------------------
        DOWNLOAD VISITOR PHOTO
    ----------------------------*/
    public function downloadPhoto($id = null)
    {
        $visitor = $this->Visitors->get($id);

        if (!empty($visitor->photo)) {
            $filePath = WWW_ROOT . "img/uploads/" . $visitor->photo;

            if (file_exists($filePath)) {
                return $this->response->withFile($filePath, [
                    "download" => true,
                    "name" => $visitor->visitor_name . "_photo.jpg"
                ]);
            }
        }

        $this->Flash->error("Photo not found.");
        return $this->redirect(['action' => 'view', $id]);
    }

    /* ---------------------------
        EDIT VISITOR
    ----------------------------*/
    public function edit($id = null)
    {
        $visitor = $this->Visitors->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            // Photo update
            $photoFile = $data['photo'] ?? null;

            if ($photoFile && $photoFile->getError() === UPLOAD_ERR_OK) {

                $fileName = time() . "_" . $photoFile->getClientFilename();
                $uploadDir = WWW_ROOT . "img/uploads";

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $photoFile->moveTo($uploadDir . DS . $fileName);
                $data['photo'] = $fileName;
            }

            $visitor = $this->Visitors->patchEntity($visitor, $data);

            if ($this->Visitors->save($visitor)) {
                $this->Flash->success("Visitor updated.");
                return $this->redirect(['action' => 'dashboard']);
            }

            $this->Flash->error("Unable to update visitor.");
        }

        $this->set(compact('visitor'));
    }

    /* ---------------------------
        DELETE VISITOR
    ----------------------------*/
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visitor = $this->Visitors->get($id);

        if ($this->Visitors->delete($visitor)) {
            $this->Flash->success("Visitor deleted.");
        } else {
            $this->Flash->error("Unable to delete visitor.");
        }

        return $this->redirect(['action' => 'dashboard']);
    }

    /* ---------------------------
        REPORTS PAGE
    ----------------------------*/
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
                "OR" => [
                    "visitor_name LIKE" => "%" . $this->request->getQuery('visitor') . "%",
                    "mobile_number LIKE" => "%" . $this->request->getQuery('visitor') . "%"
                ]
            ]);
        }

        $visitors = $query->orderDesc('visit_date')->toArray();
        $this->set(compact('visitors'));
    }

    /* ---------------------------
        SETTINGS PAGE
    ----------------------------*/
    public function settings()
    {
        if ($this->request->is('post')) {
            $this->Flash->success("Settings saved.");
            return $this->redirect(['action' => 'settings']);
        }
    }
}
