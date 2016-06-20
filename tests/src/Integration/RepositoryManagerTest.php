<?php
/**
 * File for RepositoryManagerTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package   Evolver\RepositoryManagerModuleTest
 * @author    Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModuleTest\Integration;

use Evolver\RepositoryManagerModuleTest\Util\AbstractTestCase;

/**
 * Test for the RepositoryManager class
 *
 * @package Evolver\RepositoryManagerModuleTest
 */
class RepositoryManagerTest extends AbstractTestCase
{
    /**
     * Get the application config
     *
     * @return array
     */
    protected function getApplicationConfig()
    {
        return [
            'modules' => [
                'Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest',
                'Evolver\RepositoryManagerModule'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ];
    }

    /**
     * Tests if a module's registered repository is used
     *
     * @return void
     */
    public function testCanRetrieveRepositoryFromManager()
    {
        $serviceManager = $this->getServiceManager();

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Repository\TestRepository',
            $serviceManager->get('RepositoryManager')->get('Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Entity\TestEntity')
        );
    }
}
