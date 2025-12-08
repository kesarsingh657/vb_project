<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Employee> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Employee> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('employee_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('employee_name')
            ->maxLength('employee_name', 100)
            ->requirePresence('employee_name', 'create')
            ->notEmptyString('employee_name');

        $validator
            ->scalar('employee_email')
            ->maxLength('employee_email', 100)
            ->requirePresence('employee_email', 'create')
            ->notEmptyString('employee_email')
            ->add('employee_email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('employee_phone')
            ->maxLength('employee_phone', 20)
            ->allowEmptyString('employee_phone');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 100)
            ->allowEmptyString('designation');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

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
        $rules->add($rules->isUnique(['employee_email']), ['errorField' => 'employee_email']);

        return $rules;
    }
}
