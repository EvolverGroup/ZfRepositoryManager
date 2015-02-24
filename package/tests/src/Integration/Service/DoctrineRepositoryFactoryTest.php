<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManagerTest\Integration\Service;

use Evolver\PhpUnit\AbstractModuleLoaderAwareTestCase;
use Zend\ServiceManager\ServiceManager;

/**
 * Short description for DoctrineRepositoryFactoryTest
 *
 * @package Evolver\RepositoryManagerTest\Integration\Service
 */
class DoctrineRepositoryFactoryTest extends AbstractModuleLoaderAwareTestCase
{
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
