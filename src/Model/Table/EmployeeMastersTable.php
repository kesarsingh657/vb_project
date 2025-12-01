<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitors');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('visitor_name', 'Visitor name is required')
            ->notEmptyString('mobile_number', 'Mobile number is required')
            ->minLength('mobile_number', 10, 'Mobile number must be 10 digits')
            ->maxLength('mobile_number', 10, 'Mobile number must be 10 digits')
            ->email('email', false, 'Invalid email address')
            ->notEmptyString('visit_reason', 'Visit reason is required');

        return $validator;
    }

    // Find visitor by mobile or email
    public function findExistingVisitor($mobile, $email = null)
    {
        $query = $this->find()
            ->where(['mobile_number' => $mobile]);
        
        if ($email) {
            $query->orWhere(['email' => $email]);
        }
        
        return $query->first();
    }

    // Check in visitor
    public function checkIn($visitorId)
    {
        $visitor = $this->get($visitorId);
        $visitor->check_in_time = date('Y-m-d H:i:s');
        return $this->save($visitor);
    }

    // Check out visitor
    public function checkOut($visitorId)
    {
        $visitor = $this->get($visitorId);
        $visitor->check_out_time = date('Y-m-d H:i:s');
        return $this->save($visitor);
    }

    // Generate QR code
    public function generateQRCode($visitorId)
    {
        $token = bin2hex(random_bytes(16));
        $visitor = $this->get($visitorId);
        $visitor->qr_code = $token;
        $this->save($visitor);
        return $token;
    }
}