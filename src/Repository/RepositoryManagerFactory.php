<?php
/**
 * File for RepositoryManagerFactory class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModule
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModule\Repository;

use Evolver\RepositoryManagerModule\Service\DoctrineObjectRepositoryFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for RepositoryManager class
 *
 * @package Evolver\RepositoryManagerModule
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
        $repositoryManager->addAbstractFactory(new DoctrineObjectRepositoryFactory());

        return $repositoryManager;
    }

}
