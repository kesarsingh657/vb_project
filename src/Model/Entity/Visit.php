declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Visit extends Entity
{
    protected $_accessible = [
        'visitor_id' => true, 'visit_type' => true, 'group_name' => true,
        'visit_date' => true, 'visit_time' => true, 'visit_reason_id' => true,
        'host_id' => true, 'host_department' => true, 'host_phone' => true,
        'note_to_host' => true, 'approval_status' => true, 'check_in_time' => true,
        'check_out_time' => true, 'visitor_card_number' => true, 'is_pre_registered' => true,
        'qr_code' => true, 'created_by' => true, 'created_role' => true,
        'created' => true, 'modified' => true, 'visitor_master' => true,
        'visit_reason' => true, 'user' => true, 'created_by_user' => true,
        'visit_details' => true, 'visitor_notification_log' => true,
    ];
}