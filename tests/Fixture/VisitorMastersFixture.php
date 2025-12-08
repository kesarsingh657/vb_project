<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitorMastersFixture
 */
class VisitorMastersFixture extends TestFixture
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
                'visitor_name' => 'Lorem ipsum dolor sit amet',
                'mobile_number' => 'Lorem ipsum d',
                'email' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'company_name' => 'Lorem ipsum dolor sit amet',
                'photo' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2025-12-08 16:43:19',
                'updated_at' => '2025-12-08 16:43:19',
            ],
        ];
        parent::init();
    }
}
