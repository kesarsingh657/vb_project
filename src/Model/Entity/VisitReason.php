declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class VisitReason extends Entity
{
    protected $_accessible = [
        'reason_name' => true, 'is_active' => true, 'created' => true, 'visits' => true,
    ];
}