<?php
/**
 * File for DoctrineObjectRepositoryFactory class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModule
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModule\Service;

use Doctrine\Common\Persistence\ObjectRepository;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory to proxy the repository creation to the doctrine entitymanagers's repositoryfactory
 *
 * @package Evolver\RepositoryManagerModule
 */
class DoctrineObjectRepositoryFactory implements AbstractFactoryInterface
{
    /**
     * Get/create a doctrine repository from the entitymanager
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param string $repositoryName
     *
     * @return object|null
     */
    private function getRepository(ServiceLocatorInterface $serviceLocator, $repositoryName)
    {
        $entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
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
        return $this->getRepository($serviceLocator, $requestedName) instanceof ObjectRepository;
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
        return $this->getRepository($serviceLocator, $requestedName);
    }
}
