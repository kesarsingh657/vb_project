<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitorReasons Model
 *
 * @method \App\Model\Entity\VisitorReason newEmptyEntity()
 * @method \App\Model\Entity\VisitorReason newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorReason> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitorReason get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VisitorReason findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VisitorReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorReason> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitorReason|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VisitorReason saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorReason>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorReason> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorReason>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorReason> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VisitorReasonsTable extends Table
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

        $this->setTable('visitor_reasons');
        $this->setDisplayField('visit_reason');
        $this->setPrimaryKey('id');
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
            ->scalar('visit_reason')
            ->maxLength('visit_reason', 100)
            ->requirePresence('visit_reason', 'create')
            ->notEmptyString('visit_reason');

        $validator
            ->dateTime('created_on')
            ->allowEmptyDateTime('created_on');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 50)
            ->allowEmptyString('created_by');

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

        return $validator;
    }
}
