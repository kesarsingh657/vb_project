<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visitor Entity
 *
 * @property int $id
 * @property string|null $visitor_name
 * @property string|null $mobile_number
 * @property string|null $email
 * @property string|null $address
 * @property string|null $company_name
 * @property string|null $visit_reason
 * @property string|null $host_name
 * @property string|null $host_department
 * @property string|null $host_phone
 * @property string|null $photo
 * @property \Cake\I18n\Date|null $visit_date
 * @property \Cake\I18n\Time|null $visit_time
 * @property \Cake\I18n\DateTime|null $check_in_time
 * @property \Cake\I18n\DateTime|null $check_out_time
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created_at
 * @property string|null $visit_type
 * @property int|null $group_size
 * @property string|null $host_status
 * @property \Cake\I18n\DateTime|null $host_approval_time
 * @property string|null $qr_code
 * @property bool|null $badge_printed
 * @property bool|null $is_pre_registered
 * @property int|null $photo_downloaded_count
 *
 * @property \App\Model\Entity\VisitorHistory[] $visitor_history
 * @property \App\Model\Entity\ApprovalRequest[] $approval_requests
 */
class Visitor extends Entity
{
    
    protected array $_accessible = [
        'visitor_name' => true,
        'mobile_number' => true,
        'email' => true,
        'address' => true,
        'company_name' => true,
        'visit_reason' => true,
        'host_name' => true,
        'host_department' => true,
        'host_phone' => true,
        'photo' => true,
        'visit_date' => true,
        'visit_time' => true,
        'check_in_time' => true,
        'check_out_time' => true,
        'status' => true,
        'created_at' => true,
        'visit_type' => true,
        'group_size' => true,
        'host_status' => true,
        'host_approval_time' => true,
        'qr_code' => true,
        'badge_printed' => true,
        'is_pre_registered' => true,
        'visitor_history' => true,
        'photo_downloaded_count' => true,
        'approval_requests' => true,
    ];
}
