<?php
/**
 * File for DoctrineObjectRepositoryFactory class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModule
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModule\Factory\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\Placeholder\Container;

/**
 * Factory to proxy the repository creation to the doctrine entitymanagers's repositoryfactory
 *
 * @package Evolver\RepositoryManagerModule
 */
class ObjectRepositoryAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return $this->getRepository($container, $requestedName) instanceof ObjectRepository;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $container = $serviceLocator instanceof ServiceLocatorAwareInterface ? $serviceLocator->getServiceLocator() : $serviceLocator;
        return $this->canCreate($container, $requestedName);
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
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $container = $serviceLocator instanceof ServiceLocatorAwareInterface ? $serviceLocator->getServiceLocator() : $serviceLocator;
        return $this($container, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return null|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getRepository($container, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param string $repositoryName
     * @return object
     */
    private function getRepository(ContainerInterface $container, $repositoryName)
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return $entityManager->getRepository($repositoryName);
    }
}
