<?php
/**
 * File for the module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 */

namespace Evolver\RepositoryManagerModule;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Listener\ServiceListenerInterface;
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
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $manager->getEvent()->getParam('ServiceManager');

        /** @var ServiceListenerInterface $serviceListener */
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            'RepositoryManager',
            'repositories',
            'Evolver\RepositoryManagerModule\ModuleManager\Feature\RepositoryProviderInterface',
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
                    'RepositoryManager' => 'Evolver\RepositoryManagerModule\Repository\RepositoryManagerFactory'
                ]
            ]
        ];
    }
}
