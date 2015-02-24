<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManager\Repository;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

/**
 * Short description for RepositoryManager
 *
 * @package Repository
 */
class RepositoryManager extends AbstractPluginManager
{
    /**
     * Whether or not to auto-add a class as an invokable class if it exists
     *
     * @var bool
     */
    protected $autoAddInvokableClass = false;

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     *
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
    }
}
