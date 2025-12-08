declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class VisitorNotificationLog extends Entity
{
    protected $_accessible = [
        'visit_id' => true, 'recipient_type' => true, 'recipient_email' => true,
        'recipient_mobile' => true, 'notification_type' => true, 'subject' => true,
        'message' => true, 'status' => true, 'sent_at' => true, 'visit' => true,
    ];
}