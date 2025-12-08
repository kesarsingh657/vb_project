<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitorHistory Model
 *
 * @property \App\Model\Table\VisitorsTable&\Cake\ORM\Association\BelongsTo $Visitors
 *
 * @method \App\Model\Entity\VisitorHistory newEmptyEntity()
 * @method \App\Model\Entity\VisitorHistory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorHistory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitorHistory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VisitorHistory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VisitorHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorHistory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitorHistory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VisitorHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorHistory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorHistory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorHistory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorHistory> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VisitorHistoryTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_history');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Visitors', [
            'foreignKey' => 'visitor_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('visitor_id')
            ->notEmptyString('visitor_id');

        $validator
            ->date('visit_date')
            ->allowEmptyDate('visit_date');

        $validator
            ->time('visit_time')
            ->allowEmptyTime('visit_time');

        $validator
            ->dateTime('check_in_time')
            ->allowEmptyDateTime('check_in_time');

        $validator
            ->dateTime('check_out_time')
            ->allowEmptyDateTime('check_out_time');

        $validator
            ->scalar('host_name')
            ->maxLength('host_name', 100)
            ->allowEmptyString('host_name');

        $validator
            ->scalar('visit_reason')
            ->maxLength('visit_reason', 50)
            ->allowEmptyString('visit_reason');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['visitor_id'], 'Visitors'), ['errorField' => 'visitor_id']);

        return $rules;
    }
}
