<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitorMasters Model
 *
 * @method \App\Model\Entity\VisitorMaster newEmptyEntity()
 * @method \App\Model\Entity\VisitorMaster newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorMaster> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitorMaster get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VisitorMaster findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VisitorMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VisitorMaster> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitorMaster|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VisitorMaster saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorMaster>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorMaster> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorMaster>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VisitorMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VisitorMaster> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VisitorMastersTable extends Table
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

        $this->setTable('visitor_masters');
        $this->setDisplayField('visitor_name');
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
            ->scalar('visitor_name')
            ->maxLength('visitor_name', 100)
            ->requirePresence('visitor_name', 'create')
            ->notEmptyString('visitor_name');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->requirePresence('mobile_number', 'create')
            ->notEmptyString('mobile_number');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('address')
            ->maxLength('address', 250)
            ->allowEmptyString('address');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 100)
            ->allowEmptyString('company_name');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->allowEmptyString('photo');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
