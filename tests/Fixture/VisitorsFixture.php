<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitorsFixture
 */
class VisitorsFixture extends TestFixture
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
                'mobile_number' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'company_name' => 'Lorem ipsum dolor sit amet',
                'visit_reason' => 'Lorem ipsum dolor sit amet',
                'host_name' => 'Lorem ipsum dolor sit amet',
                'host_department' => 'Lorem ipsum dolor sit amet',
                'host_phone' => 'Lorem ipsum dolor sit amet',
                'photo' => 'Lorem ipsum dolor sit amet',
                'visit_date' => '2025-12-08',
                'visit_time' => '16:44:51',
                'check_in_time' => '2025-12-08 16:44:51',
                'check_out_time' => '2025-12-08 16:44:51',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2025-12-08 16:44:51',
                'visit_type' => 'Lorem ipsum dolor ',
                'group_size' => 1,
                'host_status' => 'Lorem ipsum dolor ',
                'host_approval_time' => '2025-12-08 16:44:51',
                'qr_code' => 'Lorem ipsum dolor sit amet',
                'badge_printed' => 1,
                'is_pre_registered' => 1,
                'visitor_history' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'photo_downloaded_count' => 1,
            ],
        ];
        parent::init();
    }
}
