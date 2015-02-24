<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManager\ModuleManager\Feature;

/**
 * Short description for RepositoryProviderInterface
 *
 * @package ModuleManager\Feature
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
