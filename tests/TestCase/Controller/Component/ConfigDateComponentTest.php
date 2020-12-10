<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ConfigDateComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ConfigDateComponent Test Case
 */
class ConfigDateComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ConfigDateComponent
     */
    protected $ConfigDateComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ConfigDateComponent = new ConfigDateComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ConfigDateComponent);

        parent::tearDown();
    }
}
