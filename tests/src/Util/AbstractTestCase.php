<?php
/**
 * This file is part of the repository-manager-module.php project.
 *
 * @copyright Copyright (c) 2015, evolver media GmbH & Co. KG <info@evolver.de>
 * @author    Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Evolver\RepositoryManagerModuleTest\Util;

use Zend\Test\Util\ModuleLoader;

/**
 * Abstract test case
 *
 * @package Evolver\RepositoryManagerModuleTest\Util
 */
abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * Get the application config
     *
     * @return array
     */
    abstract protected function getApplicationConfig();

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $moduleLoader = new ModuleLoader($this->getApplicationConfig());
        $this->serviceManager = $moduleLoader->getServiceManager();
    }

    /**
     * Get the service manager
     *
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}
