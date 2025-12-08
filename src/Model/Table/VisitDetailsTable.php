declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitDetailsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visit_details');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Visits', ['foreignKey' => 'visit_id', 'joinType' => 'INNER']);
        $this->belongsTo('VisitorMaster', ['foreignKey' => 'visitor_id']);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->integer('visit_id')->requirePresence('visit_id', 'create')->notEmptyString('visit_id')
            ->integer('visitor_id')->allowEmptyString('visitor_id')
            ->scalar('name')->maxLength('name', 100)->requirePresence('name', 'create')->notEmptyString('name')
            ->scalar('mobile_number')->maxLength('mobile_number', 10)->requirePresence('mobile_number', 'create')->notEmptyString('mobile_number')
            ->email('email')->allowEmptyString('email')
            ->scalar('address')->maxLength('address', 250)->allowEmptyString('address')
            ->scalar('company_name')->maxLength('company_name', 150)->allowEmptyString('company_name')
            ->scalar('photo')->maxLength('photo', 255)->allowEmptyFile('photo');
        return $validator;
    }

    public function buildRules($rules)
    {
        $rules->add($rules->existsIn('visit_id', 'Visits'), ['errorField' => 'visit_id']);
        $rules->add($rules->existsIn('visitor_id', 'VisitorMaster'), ['errorField' => 'visitor_id']);
        return $rules;
    }
}