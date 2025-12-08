declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitReasonsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visit_reasons');
        $this->setDisplayField('reason_name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasMany('Visits', ['foreignKey' => 'visit_reason_id']);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->scalar('reason_name')->maxLength('reason_name', 100)->requirePresence('reason_name', 'create')->notEmptyString('reason_name')
            ->boolean('is_active')->notEmptyString('is_active');
        return $validator;
    }
}