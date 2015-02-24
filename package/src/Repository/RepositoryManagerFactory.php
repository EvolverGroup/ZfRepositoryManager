<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManager\Repository;

use Evolver\RepositoryManager\Service\DoctrineRepositoryFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Short description for RepositoryManagerFactory
 *
 * @package Evolver\RepositoryManager\Repository
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
