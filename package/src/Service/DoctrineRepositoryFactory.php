<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManager\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Short description for DoctrineRepositoryFactory
 *
 * @package Service
 */
class DoctrineRepositoryFactory implements AbstractFactoryInterface
{
    protected function getRepository($repositoryName, ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository($repositoryName);
    }
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param                         $name
     * @param                         $requestedName
     *
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return is_object($this->getRepository($requestedName, $serviceLocator));
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param                         $name
     * @param                         $requestedName
     *
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this->getRepository($requestedName, $serviceLocator);
    }

}
 