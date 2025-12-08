<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitorMastersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitorMastersTable Test Case
 */
class VisitorMastersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitorMastersTable
     */
    protected $VisitorMasters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VisitorMasters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VisitorMasters') ? [] : ['className' => VisitorMastersTable::class];
        $this->VisitorMasters = $this->getTableLocator()->get('VisitorMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VisitorMasters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VisitorMastersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
