<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ConfigMessageComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ConfigMessageComponent Test Case
 */
class ConfigMessageComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ConfigMessageComponent
     */
    protected $ConfigMessage;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ConfigMessage = new ConfigMessageComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ConfigMessage);

        parent::tearDown();
    }
}
