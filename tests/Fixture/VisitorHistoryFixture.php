<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitorHistoryFixture
 */
class VisitorHistoryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'visitor_history';
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
                'visitor_id' => 1,
                'visit_date' => '2025-12-08',
                'visit_time' => '16:43:18',
                'check_in_time' => '2025-12-08 16:43:18',
                'check_out_time' => '2025-12-08 16:43:18',
                'host_name' => 'Lorem ipsum dolor sit amet',
                'visit_reason' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor ',
                'created' => '2025-12-08 16:43:18',
            ],
        ];
        parent::init();
    }
}
