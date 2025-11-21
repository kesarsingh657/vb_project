<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitReasons Model
 *
 * @method \App\Model\Entity\VisitReason newEmptyEntity()
 * @method \App\Model\Entity\VisitReason newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitReason> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitReason get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VisitReason findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VisitReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitReason> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitReason|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VisitReason saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VisitReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitReason>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitReason> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitReason>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitReason>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitReason> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VisitReasonsTable extends Table
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

        $this->setTable('visit_reasons');
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
            ->integer('id')
            ->allowEmptyString('id');

        $validator
            ->scalar('reason_name')
            ->maxLength('reason_name', 20)
            ->allowEmptyString('reason_name');

        return $validator;
    }
}
