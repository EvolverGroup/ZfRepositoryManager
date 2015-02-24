<?php
/**
 * File for the module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 */

namespace Evolver\RepositoryManager;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Listener\ServiceListenerInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Module class
 *
 * @package Evolver\Zf2ModuleSkeleton
 */
class Module implements InitProviderInterface, ConfigProviderInterface
{
    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $manager
     *
     * @return void
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
            'Evolver\RepositoryManager\ModuleManager\Feature\RepositoryProviderInterface',
            'getRepositories'
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
                    'RepositoryManager' => 'Evolver\RepositoryManager\Repository\RepositoryManagerFactory'
                ]
            ]
        ];
    }
}
