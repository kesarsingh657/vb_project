<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitorReasonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitorReasonsTable Test Case
 */
class VisitorReasonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitorReasonsTable
     */
    protected $VisitorReasons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VisitorReasons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VisitorReasons') ? [] : ['className' => VisitorReasonsTable::class];
        $this->VisitorReasons = $this->getTableLocator()->get('VisitorReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VisitorReasons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VisitorReasonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
