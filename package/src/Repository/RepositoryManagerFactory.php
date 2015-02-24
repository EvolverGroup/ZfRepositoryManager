<?php
/**
 * Short description for file
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManager\Repository;

use Evolver\RepositoryManager\Service\DoctrineRepositoryFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Short description for RepositoryManagerFactory
 *
 * @package Evolver\RepositoryManager
 */
class RepositoryManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return RepositoryManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $repositoryManager = new RepositoryManager();

        $repositoryManager->setServiceLocator($serviceLocator);
        $repositoryManager->addAbstractFactory(new DoctrineRepositoryFactory());

        return $repositoryManager;
    }

}
