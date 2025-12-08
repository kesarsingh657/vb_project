<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeMasters Model
 *
 * @method \App\Model\Entity\EmployeeMaster newEmptyEntity()
 * @method \App\Model\Entity\EmployeeMaster newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\EmployeeMaster> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeMaster get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\EmployeeMaster findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\EmployeeMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\EmployeeMaster> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeMaster|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\EmployeeMaster saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\EmployeeMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\EmployeeMaster>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\EmployeeMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\EmployeeMaster> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\EmployeeMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\EmployeeMaster>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\EmployeeMaster>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\EmployeeMaster> deleteManyOrFail(iterable $entities, array $options = [])
 */
class EmployeeMastersTable extends Table
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

        $this->setTable('employee_masters');
        $this->setDisplayField('emp_code');
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
            ->scalar('emp_code')
            ->maxLength('emp_code', 50)
            ->requirePresence('emp_code', 'create')
            ->notEmptyString('emp_code')
            ->add('emp_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('emp_name')
            ->maxLength('emp_name', 100)
            ->requirePresence('emp_name', 'create')
            ->notEmptyString('emp_name');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->allowEmptyString('mobile_number');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('role')
            ->allowEmptyString('role');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

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
        $rules->add($rules->isUnique(['emp_code']), ['errorField' => 'emp_code']);

        return $rules;
    }
}
