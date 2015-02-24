<?php
/**
 * Short description for file
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration;

use Evolver\PhpUnit\AbstractModuleLoaderAwareTestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * Short description for RepositoryManagerTest
 *
 * @package Evolver\RepositoryManagerTest\Integration
 */
class RepositoryManagerTest extends AbstractModuleLoaderAwareTestCase
{
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

    public function testCanRetrieveRepositoryFromManager()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $this->getModuleLoader()->getServiceManager();

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository',
            $serviceManager->get('RepositoryManager')->get('Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity\TestEntity')
        );
    }
}
 