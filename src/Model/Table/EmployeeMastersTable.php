<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmployeeMastersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setTable('employee_master');
        $this->setDisplayField('employee_name');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_date' => 'new',
                    'modified_date' => 'always'
                ]
            ]
        ]);
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmptyString('employee_name')
            ->notEmptyString('department')
            ->notEmptyString('phone_number')
            ->notEmptyString('email');
            
        return $validator;
    }
}