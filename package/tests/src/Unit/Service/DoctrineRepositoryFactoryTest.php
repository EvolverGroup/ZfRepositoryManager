<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManagerTest\Unit\Service;

use Evolver\RepositoryManager\Service\DoctrineRepositoryFactory;
use Evolver\RepositoryManagerTest\Unit\Service\DoctrineRepositoryFactoryTest\Entity\TestEntity;

/**
 * Short description for DoctrineRepositoryFactoryTest
 *
 * @package Evolver\RepositoryManagerTest\Unit\Service
 */
class DoctrineRepositoryFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DoctrineRepositoryFactory
     */
    protected $doctrineRepositoryFactory;

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

    protected function setUp()
    {
        $this->doctrineRepositoryFactory = new DoctrineRepositoryFactory();
    }
}
