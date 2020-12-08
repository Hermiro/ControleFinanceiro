<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\GetDadosComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\GetDadosComponent Test Case
 */
class GetDadosComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\GetDadosComponent
     */
    protected $GetDados;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->GetDados = new GetDadosComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->GetDados);

        parent::tearDown();
    }
}
