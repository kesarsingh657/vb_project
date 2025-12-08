declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class VisitDetail extends Entity
{
    protected $_accessible = [
        'visit_id' => true, 'visitor_id' => true, 'name' => true,
        'mobile_number' => true, 'email' => true, 'address' => true,
        'company_name' => true, 'photo' => true, 'visit' => true, 'visitor_master' => true,
    ];
}
