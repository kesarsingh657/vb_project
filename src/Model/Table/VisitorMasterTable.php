<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorMasterTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('visitor_master');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_on' => 'new',
                    'updated_on' => 'always'
                ]
            ]
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence('visitor_mobile', 'create')
            ->notEmptyString('visitor_mobile', 'Mobile is required')
            ->add('visitor_mobile', 'length', [
                'rule' => ['lengthBetween', 10, 10],
                'message' => 'Mobile must be 10 digits'
            ])
            ->add('visitor_mobile', 'numeric', [
                'rule' => 'numeric',
                'message' => 'Mobile must be numeric'
            ]);

        $validator
            ->requirePresence('visitor_name', 'create')
            ->notEmptyString('visitor_name', 'Visitor name is required')
            ->add('visitor_name', 'alpha', [
                'rule' => function ($value, $context) {
                    return preg_match('/^[A-Za-z\s]+$/', $value);
                },
                'message' => 'Name may only contain letters and spaces'
            ])
            ->maxLength('visitor_name', 100);

        $validator
            ->allowEmptyString('visitor_email')
            ->add('visitor_email', 'format', [
                'rule' => ['email'],
                'message' => 'Enter a valid email address',
                'on' => function ($context) {
                    return !empty($context['data']['visitor_email']);
                }
            ]);

        $validator
            ->allowEmptyString('visitor_address')
            ->add('visitor_address', 'validChars', [
                'rule' => function ($value) {
                    return preg_match('/^[A-Za-z0-9\s\-\(\)\/,\.]{0,250}$/', $value);
                },
                'message' => 'Address contains invalid characters'
            ]);

        $validator
            ->requirePresence('visit_reason')
            ->notEmptyString('visit_reason', 'Visit reason is required');

        $validator
            ->requirePresence('host_name')
            ->notEmptyString('host_name', 'Host name is required')
            ->add('host_name', 'alpha', [
                'rule' => function ($value, $context) {
                    return preg_match('/^[A-Za-z\s0-9\-]+$/', $value);
                },
                'message' => 'Host name invalid'
            ]);

        $validator
            ->requirePresence('host_mobile')
            ->notEmptyString('host_mobile', 'Host mobile is required')
            ->add('host_mobile', 'length', [
                'rule' => ['lengthBetween', 10, 10],
                'message' => 'Host mobile must be 10 digits'
            ])
            ->add('host_mobile', 'numeric');

        return $validator;
    }
}
