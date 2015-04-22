<?php
/**
 * File for DoctrineObjectRepositoryFactoryTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package   Evolver\RepositoryManagerModuleTest
 * @author    Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModuleTest\Integration\Service;

use Evolver\RepositoryManagerModuleTest\Util\AbstractTestCase;

/**
 * Tests for the DoctrineObjectRepositoryFactory class
 *
 * @package Evolver\RepositoryManagerModuleTest
 */
class DoctrineObjectRepositoryFactoryTest extends AbstractTestCase
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
                'DoctrineModule',
                'DoctrineORMModule',
                'Evolver\RepositoryManagerModuleTest\Integration\Service\DoctrineObjectRepositoryFactoryTest',
                'Evolver\RepositoryManagerModule'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ];
    }

    /**
     * Tests if the abstract factory is registered and working
     *
     * @return void
     */
    public function testAbstractFactoryGetsCalled()
    {
        $serviceManager = $this->getServiceManager();

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerModuleTest\Integration\Service\DoctrineObjectRepositoryFactoryTest\Repository\TestRepository',
            $serviceManager->get('RepositoryManager')->get(
                'Evolver\RepositoryManagerModuleTest\Integration\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity'
            )
        );
    }
}
