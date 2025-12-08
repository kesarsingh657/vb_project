<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitorHistoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitorHistoryTable Test Case
 */
class VisitorHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitorHistoryTable
     */
    protected $VisitorHistory;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VisitorHistory',
        'app.Visitors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VisitorHistory') ? [] : ['className' => VisitorHistoryTable::class];
        $this->VisitorHistory = $this->getTableLocator()->get('VisitorHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VisitorHistory);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VisitorHistoryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\VisitorHistoryTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
