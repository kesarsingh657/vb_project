declare(strict_types=1);
namespace App\Model\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [
        'username' => true, 'password' => true, 'email' => true, 'role' => true,
        'employee_code' => true, 'department' => true, 'phone_number' => true,
        'is_active' => true, 'created' => true, 'modified' => true,
        'visits' => true, 'created_visits' => true,
    ];
    protected $_hidden = ['password'];

    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }
}