<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EBooksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EBooksTable Test Case
 */
class EBooksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EBooksTable
     */
    public $EBooks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EBooks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EBooks') ? [] : ['className' => EBooksTable::class];
        $this->EBooks = TableRegistry::getTableLocator()->get('EBooks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EBooks);

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
