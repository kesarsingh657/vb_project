<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApprovalRequests Model
 *
 * @property \App\Model\Table\VisitorsTable&\Cake\ORM\Association\BelongsTo $Visitors
 *
 * @method \App\Model\Entity\ApprovalRequest newEmptyEntity()
 * @method \App\Model\Entity\ApprovalRequest newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ApprovalRequest> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApprovalRequest get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ApprovalRequest findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ApprovalRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ApprovalRequest> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApprovalRequest|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ApprovalRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ApprovalRequest>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ApprovalRequest>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ApprovalRequest>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ApprovalRequest> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ApprovalRequest>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ApprovalRequest>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ApprovalRequest>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ApprovalRequest> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ApprovalRequestsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('approval_requests');
        $this->setDisplayField('host_email');
        $this->setPrimaryKey('id');

        $this->belongsTo('Visitors', [
            'foreignKey' => 'visitor_id',
            'joinType' => 'INNER',
        ]);
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('visitor_id')
            ->notEmptyString('visitor_id');

        $validator
            ->scalar('host_email')
            ->maxLength('host_email', 100)
            ->requirePresence('host_email', 'create')
            ->notEmptyString('host_email');

        $validator
            ->scalar('host_phone')
            ->maxLength('host_phone', 20)
            ->allowEmptyString('host_phone');

        $validator
            ->dateTime('request_sent_at')
            ->allowEmptyDateTime('request_sent_at');

        $validator
            ->dateTime('approved_at')
            ->allowEmptyDateTime('approved_at');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

        $validator
            ->scalar('approval_token')
            ->maxLength('approval_token', 100)
            ->allowEmptyString('approval_token');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['visitor_id'], 'Visitors'), ['errorField' => 'visitor_id']);

        return $rules;
    }
}
