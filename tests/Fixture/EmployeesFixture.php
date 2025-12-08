<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 */
class EmployeesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'employee_name' => 'Lorem ipsum dolor sit amet',
                'employee_email' => 'Lorem ipsum dolor sit amet',
                'employee_phone' => 'Lorem ipsum dolor ',
                'department' => 'Lorem ipsum dolor sit amet',
                'designation' => 'Lorem ipsum dolor sit amet',
                'is_active' => 1,
                'created' => '2025-12-08 16:43:10',
                'modified' => '2025-12-08 16:43:10',
            ],
        ];
        parent::init();
    }
}
