<?php
/**
 * File for RepositoryProviderInterface interface
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModule
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModule\ModuleManager\Feature;

/**
 * Interface to configure the RepositoryManager in the module class
 *
 * @package Evolver\RepositoryManagerModule
 */
interface RepositoryProviderInterface
{
    /**
     * Returns configuration for RepositoryManager
     *
     * @return array servicemanager configuration
     */
    public function getRepositoryConfig();
}
