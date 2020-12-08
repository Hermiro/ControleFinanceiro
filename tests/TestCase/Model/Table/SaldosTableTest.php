<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaldosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaldosTable Test Case
 */
class SaldosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SaldosTable
     */
    protected $Saldos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Saldos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Saldos') ? [] : ['className' => SaldosTable::class];
        $this->Saldos = $this->getTableLocator()->get('Saldos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Saldos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
