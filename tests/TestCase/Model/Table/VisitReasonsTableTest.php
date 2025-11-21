<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitReasonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitReasonsTable Test Case
 */
class VisitReasonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitReasonsTable
     */
    protected $VisitReasons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VisitReasons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VisitReasons') ? [] : ['className' => VisitReasonsTable::class];
        $this->VisitReasons = $this->getTableLocator()->get('VisitReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VisitReasons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VisitReasonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
