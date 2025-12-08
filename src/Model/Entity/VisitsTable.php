declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visits');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('VisitorMaster', ['foreignKey' => 'visitor_id']);
        $this->belongsTo('VisitReasons', ['foreignKey' => 'visit_reason_id']);
        $this->belongsTo('Users', ['foreignKey' => 'host_id']);
        $this->belongsTo('CreatedByUser', [
            'className' => 'Users',
            'foreignKey' => 'created_by',
        ]);
        $this->hasMany('VisitDetails', ['foreignKey' => 'visit_id', 'dependent' => true]);
        $this->hasMany('VisitorNotificationLog', ['foreignKey' => 'visit_id', 'dependent' => true]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->integer('visitor_id')->allowEmptyString('visitor_id')
            ->scalar('visit_type')->notEmptyString('visit_type')
            ->scalar('group_name')->maxLength('group_name', 150)->allowEmptyString('group_name')
            ->date('visit_date')->requirePresence('visit_date', 'create')->notEmptyDate('visit_date')
            ->time('visit_time')->requirePresence('visit_time', 'create')->notEmptyTime('visit_time')
            ->integer('visit_reason_id')->requirePresence('visit_reason_id', 'create')->notEmptyString('visit_reason_id')
            ->integer('host_id')->requirePresence('host_id', 'create')->notEmptyString('host_id')
            ->scalar('host_department')->maxLength('host_department', 100)->allowEmptyString('host_department')
            ->scalar('host_phone')->maxLength('host_phone', 10)->allowEmptyString('host_phone')
            ->scalar('note_to_host')->allowEmptyString('note_to_host')
            ->scalar('approval_status')->notEmptyString('approval_status')
            ->dateTime('check_in_time')->allowEmptyDateTime('check_in_time')
            ->dateTime('check_out_time')->allowEmptyDateTime('check_out_time')
            ->scalar('visitor_card_number')->maxLength('visitor_card_number', 50)->allowEmptyString('visitor_card_number')
            ->boolean('is_pre_registered')->notEmptyString('is_pre_registered')
            ->scalar('qr_code')->maxLength('qr_code', 255)->allowEmptyString('qr_code')
            ->integer('created_by')->requirePresence('created_by', 'create')->notEmptyString('created_by')
            ->scalar('created_role')->notEmptyString('created_role');
        return $validator;
    }

    public function buildRules($rules)
    {
        $rules->add($rules->existsIn('visitor_id', 'VisitorMaster'), ['errorField' => 'visitor_id']);
        $rules->add($rules->existsIn('visit_reason_id', 'VisitReasons'), ['errorField' => 'visit_reason_id']);
        $rules->add($rules->existsIn('host_id', 'Users'), ['errorField' => 'host_id']);
        $rules->add($rules->existsIn('created_by', 'Users'), ['errorField' => 'created_by']);
        return $rules;
    }
}