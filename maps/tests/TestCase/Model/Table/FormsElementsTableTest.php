<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormsElementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormsElementsTable Test Case
 */
class FormsElementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormsElementsTable
     */
    public $FormsElements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.forms_elements',
        'app.forms',
        'app.elements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormsElements') ? [] : ['className' => 'App\Model\Table\FormsElementsTable'];
        $this->FormsElements = TableRegistry::get('FormsElements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormsElements);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
