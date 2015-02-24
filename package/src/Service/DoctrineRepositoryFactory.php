<?php
/**
 * File for DoctrineRepositoryFactory class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManager
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManager\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory to proxy the repository creation to the doctrine entitymanagers's repositoryfactory
 *
 * @package Evolver\RepositoryManager
 */
class DoctrineRepositoryFactory implements AbstractFactoryInterface
{
    /**
     * Get/create a doctrine repository from the entitymanager
     *
     * @param string $repositoryName
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Object|null
     */
    protected function getRepository($repositoryName, ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository($repositoryName);
    }
    /**
     * Determine if the EntityManager knows the repository for this entity
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
     * Get the entity from the EntityManager
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
 