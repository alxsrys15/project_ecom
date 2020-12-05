<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivationCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivationCodesTable Test Case
 */
class ActivationCodesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivationCodesTable
     */
    public $ActivationCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivationCodes',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivationCodes') ? [] : ['className' => ActivationCodesTable::class];
        $this->ActivationCodes = TableRegistry::getTableLocator()->get('ActivationCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivationCodes);

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
