<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsumersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsumersTable Test Case
 */
class ConsumersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsumersTable
     */
    public $Consumers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.consumers',
        'app.patients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Consumers') ? [] : ['className' => 'App\Model\Table\ConsumersTable'];
        $this->Consumers = TableRegistry::get('Consumers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Consumers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
