<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PessoasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PessoasTable Test Case
 */
class PessoasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PessoasTable
     */
    protected $Pessoas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Pessoas',
        'app.Historicos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pessoas') ? [] : ['className' => PessoasTable::class];
        $this->Pessoas = $this->getTableLocator()->get('Pessoas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Pessoas);

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
