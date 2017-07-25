<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormValuesTable Test Case
 */
class FormValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormValuesTable
     */
    public $FormValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.form_values',
        'app.patients',
        'app.users',
        'app.forms',
        'app.elements',
        'app.forms_elements',
        'app.form_elements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormValues') ? [] : ['className' => 'App\Model\Table\FormValuesTable'];
        $this->FormValues = TableRegistry::get('FormValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormValues);

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
