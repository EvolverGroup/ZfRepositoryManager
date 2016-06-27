<?php
/**
 * File for DoctrineObjectRepositoryFactoryTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModuleTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModuleTest\Unit\Service;

use Doctrine\ORM\EntityManager;
use Evolver\RepositoryManagerModule\Factory\Doctrine\ObjectRepositoryAbstractFactory;
use Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Repository\TestRepository;

/**
 * Tests for the DoctrineObjectRepositoryFactory class
 *
 * @package Evolver\RepositoryManagerModuleTest
 */
class DoctrineObjectRepositoryFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectRepositoryAbstractFactory
     */
    protected $doctrineObjectRepositoryFactory;

    /**
     * Tests if abstract factory communicates that it can't handle this service name if there is no registered service
     * for this entity and the doctrine entitymanager can't create the repository either
     *
     * @return void
     */
    public function testCanCreateServiceReturnsFalseIfNoRepositoryExists()
    {
        $parentServiceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManagerModule\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            EntityManager::class,
            [],
            [],
            '',
            false
        );

        $entityManagerMock
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn(false);

        $parentServiceLocatorMock
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap([
                    ['doctrine.entitymanager.orm_default', $entityManagerMock]
                ])
            );

        $this->assertFalse(
            $this->doctrineObjectRepositoryFactory->canCreateServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity'
            )
        );
    }

    /**
     * Tests if abstract factory communicated that it can construct the repository for the requested entity from the
     * doctrine entitymanager
     *
     * @return void
     */
    public function testCanCreateServiceReturnsTrueIfRepositoryExists()
    {
        $parentServiceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManagerModule\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            EntityManager::class,
            [],
            [],
            '',
            false
        );

        $entityManagerMock
            ->expects($this->once())
            ->method('getRepository')
            ->will(
                $this->returnValueMap([
                    [
                        'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity',
                        new TestRepository()
                    ]
                ])
            );

        $parentServiceLocatorMock
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap([
                    ['doctrine.entitymanager.orm_default', $entityManagerMock]
                ])
            );

        $this->assertTrue(
            $this->doctrineObjectRepositoryFactory->canCreateServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity'
            )
        );
    }

    /**
     * Tests if the factory creates a repository via the entitymanager
     *
     * @return void
     */
    public function testCreateService()
    {
        $parentServiceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManagerModule\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            EntityManager::class,
            [],
            [],
            '',
            false
        );

        $entityManagerMock
            ->expects($this->once())
            ->method('getRepository')
            ->will(
                $this->returnValueMap([
                    [
                        'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity',
                        new TestRepository()
                    ]
                ])
            );

        $parentServiceLocatorMock
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap([
                    ['doctrine.entitymanager.orm_default', $entityManagerMock]
                ])
            );

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Repository\TestRepository',
            $this->doctrineObjectRepositoryFactory->createServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerModuleTest\Unit\Service\DoctrineObjectRepositoryFactoryTest\Entity\TestEntity'
            )
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->doctrineObjectRepositoryFactory = new ObjectRepositoryAbstractFactory();
    }
}
