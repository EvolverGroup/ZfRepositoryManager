<?php
/**
 * File for the module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 */

namespace Evolver\RepositoryManagerModule;

use Evolver\RepositoryManagerModule\ModuleManager\Feature\RepositoryProviderInterface;
use Evolver\RepositoryManagerModule\Repository\RepositoryManager;
use Evolver\RepositoryManagerModule\Repository\RepositoryManagerFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Listener\ServiceListenerInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Module class
 *
 * @package Evolver\RepositoryManagerModule
 */
class Module implements InitProviderInterface, ConfigProviderInterface
{
    /**
     * @inheritdoc
     */
    public function init(ModuleManagerInterface $manager)
    {
        if (!$manager instanceof ModuleManager) {
            return;
        }

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $manager->getEvent()->getParam('ServiceManager');

        /** @var ServiceListenerInterface $serviceListener */
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            'RepositoryManager',
            'repositories',
            RepositoryProviderInterface::class,
            'getRepositoryConfig'
        );
    }

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'service_manager' => [
                'factories' => [
                    RepositoryManager::class => RepositoryManagerFactory::class,
                ],
                'aliases' => [
                    'RepositoryManager' => RepositoryManager::class,
                    'repositorymanager' => RepositoryManager::class,
                ]
            ],
        ];
    }
}
