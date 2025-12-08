<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApprovalRequestsFixture
 */
class ApprovalRequestsFixture extends TestFixture
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
                'visitor_id' => 1,
                'host_email' => 'Lorem ipsum dolor sit amet',
                'host_phone' => 'Lorem ipsum dolor ',
                'request_sent_at' => '2025-12-08 16:43:01',
                'approved_at' => '2025-12-08 16:43:01',
                'status' => 'Lorem ipsum dolor ',
                'approval_token' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
