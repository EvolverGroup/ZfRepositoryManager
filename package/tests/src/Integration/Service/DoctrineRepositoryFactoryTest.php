<?php
/**
 * File for DoctrineRepositoryFactoryTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\Service;

use Evolver\PhpUnit\AbstractModuleLoaderAwareTestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * Tests for the DoctrineRepositoryFactory class
 *
 * @package Evolver\RepositoryManagerTest
 */
class DoctrineRepositoryFactoryTest extends AbstractModuleLoaderAwareTestCase
{
    /**
     * Tests if the abstract factory is registered and working
     *
     * @return void
     */
    public function testAbstractFactoryGetsCalled()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $this->getModuleLoader()->getServiceManager();

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerTest\Integration\Service\DoctrineRepositoryFactoryTest\Repository\TestRepository',
            $serviceManager->get('RepositoryManager')->get(
                'Evolver\RepositoryManagerTest\Integration\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity'
            )
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
                'Evolver\RepositoryManagerTest\Integration\Service\DoctrineRepositoryFactoryTest',
                'Evolver\RepositoryManager'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ]);
    }
}
