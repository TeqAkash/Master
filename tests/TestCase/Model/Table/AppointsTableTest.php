<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppointsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppointsTable Test Case
 */
class AppointsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppointsTable
     */
    protected $Appoints;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Appoints',
        'app.Patients',
        'app.Doctors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Appoints') ? [] : ['className' => AppointsTable::class];
        $this->Appoints = $this->getTableLocator()->get('Appoints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Appoints);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AppointsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AppointsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
