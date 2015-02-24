<?php
/**
 * Short description for file
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManager\ModuleManager\Feature;

/**
 * Short description for RepositoryProviderInterface
 *
 * @package Evolver\RepositoryManager
 */
interface RepositoryProviderInterface
{
    /**
     * Returns configuration for RepositoryManager
     *
     * @return array
     */
    public function getRepositoryConfig();
}
