declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        
        $this->hasMany('Visits', ['foreignKey' => 'host_id']);
        $this->hasMany('CreatedVisits', [
            'className' => 'Visits',
            'foreignKey' => 'created_by',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->scalar('username')->maxLength('username', 100)->requirePresence('username', 'create')->notEmptyString('username')
            ->scalar('password')->maxLength('password', 255)->requirePresence('password', 'create')->notEmptyString('password')
            ->email('email')->requirePresence('email', 'create')->notEmptyString('email')
            ->scalar('role')->notEmptyString('role')
            ->scalar('employee_code')->maxLength('employee_code', 50)->allowEmptyString('employee_code')
            ->scalar('department')->maxLength('department', 100)->allowEmptyString('department')
            ->scalar('phone_number')->maxLength('phone_number', 10)->allowEmptyString('phone_number')
            ->boolean('is_active')->notEmptyString('is_active');
        return $validator;
    }

    public function buildRules($rules)
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        return $rules;
    }
}