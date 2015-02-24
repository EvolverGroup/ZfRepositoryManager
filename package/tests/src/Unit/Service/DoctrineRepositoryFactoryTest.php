<?php
/**
 * File for DoctrineRepositoryFactoryTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Unit\Service;

use Evolver\RepositoryManager\Service\DoctrineRepositoryFactory;
use Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity;

/**
 * Tests for the DoctrineRepositoryFactory class
 *
 * @package Evolver\RepositoryManagerTest
 */
class DoctrineRepositoryFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DoctrineRepositoryFactory
     */
    protected $doctrineRepositoryFactory;

    /**
     * Tests if abstract factory communicates that it can't handle this service name if there is no registered service
     * for this entity and the doctrine entitymanager can't create the repositoy either
     *
     * @return void
     */
    public function testCanCreateServiceReturnsFalseIfNoRepositoryExists()
    {
        $parentServiceLocatorMock = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManager\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            'Doctrine\ORM\EntityManager',
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
                    ['Doctrine\ORM\EntityManager', $entityManagerMock]
                ])
            );

        $this->assertFalse(
            $this->doctrineRepositoryFactory->canCreateServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity'
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

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManager\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            'Doctrine\ORM\EntityManager',
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
                        'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity',
                        new TestEntity()
                    ]
                ])
            );

        $parentServiceLocatorMock
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap([
                    ['Doctrine\ORM\EntityManager', $entityManagerMock]
                ])
            );

        $this->assertTrue(
            $this->doctrineRepositoryFactory->canCreateServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity'
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

        $serviceLocatorMock = $this->getMock('Evolver\RepositoryManager\Repository\RepositoryManager');

        $serviceLocatorMock
            ->expects($this->any())
            ->method('getServiceLocator')
            ->willReturn($parentServiceLocatorMock);

        $entityManagerMock = $this->getMock(
            'Doctrine\ORM\EntityManager',
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
                        'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity',
                        new TestEntity()
                    ]
                ])
            );

        $parentServiceLocatorMock
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnValueMap([
                    ['Doctrine\ORM\EntityManager', $entityManagerMock]
                ])
            );

        $this->assertInstanceOf(
            'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity',
            $this->doctrineRepositoryFactory->createServiceWithName(
                $serviceLocatorMock,
                '',
                'Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity'
            )
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->doctrineRepositoryFactory = new DoctrineRepositoryFactory();
    }
}
