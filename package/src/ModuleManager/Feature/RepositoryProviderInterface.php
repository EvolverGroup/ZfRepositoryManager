<?php
/**
 * File for RepositoryProviderInterface interface
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManager
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManager\ModuleManager\Feature;

/**
 * Interface to configure the RepositoryManager in the module class
 *
 * @package Evolver\RepositoryManager
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
