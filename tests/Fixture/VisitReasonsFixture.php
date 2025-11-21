<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitReasonsFixture
 */
class VisitReasonsFixture extends TestFixture
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
                'reason_name' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
