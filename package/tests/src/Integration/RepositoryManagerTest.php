<?php
/**
 * File for RepositoryManagerTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration;

use Evolver\PhpUnit\AbstractModuleLoaderAwareTestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * Test for the RepositoryManager class
 *
 * @package Evolver\RepositoryManagerTest
 */
class RepositoryManagerTest extends AbstractModuleLoaderAwareTestCase
{
    /**
     * Tests if a module's registered repository is used
     *
     * @return void
     */
    public function testCanRetrieveRepositoryFromManager()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $this->getModuleLoader()->getServiceManager();

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository',
            $serviceManager->get('RepositoryManager')->get('Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity\TestEntity')
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setApplicationConfig([
            'modules' => [
                'DoctrineModule',
                'DoctrineORMModule',
                'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest',
                'Evolver\RepositoryManager'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ]);
    }
}
