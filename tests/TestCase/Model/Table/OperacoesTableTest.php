<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OperacoesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OperacoesTable Test Case
 */
class OperacoesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OperacoesTable
     */
    protected $Operacoes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Operacoes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Operacoes') ? [] : ['className' => OperacoesTable::class];
        $this->Operacoes = $this->getTableLocator()->get('Operacoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Operacoes);

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
