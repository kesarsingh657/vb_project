declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorNotificationLogTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('visitor_notification_log');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Visits', ['foreignKey' => 'visit_id', 'joinType' => 'INNER']);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')->allowEmptyString('id', null, 'create')
            ->integer('visit_id')->requirePresence('visit_id', 'create')->notEmptyString('visit_id')
            ->scalar('recipient_type')->notEmptyString('recipient_type')
            ->email('recipient_email')->allowEmptyString('recipient_email')
            ->scalar('recipient_mobile')->maxLength('recipient_mobile', 10)->allowEmptyString('recipient_mobile')
            ->scalar('notification_type')->notEmptyString('notification_type')
            ->scalar('subject')->maxLength('subject', 255)->allowEmptyString('subject')
            ->scalar('message')->allowEmptyString('message')
            ->scalar('status')->notEmptyString('status');
        return $validator;
    }

    public function buildRules($rules)
    {
        $rules->add($rules->existsIn('visit_id', 'Visits'), ['errorField' => 'visit_id']);
        return $rules;
    }
}
