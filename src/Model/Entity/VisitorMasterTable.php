declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class VisitorMaster extends Entity
{
    protected $_accessible = [
        'name' => true, 'mobile_number' => true, 'email' => true,
        'address' => true, 'company_name' => true, 'photo' => true,
        'created' => true, 'modified' => true, 'visits' => true, 'visit_details' => true,
    ];
}