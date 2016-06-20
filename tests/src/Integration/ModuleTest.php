<?php
/**
 * File for ModuleTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package   Evolver\RepositoryManagerModuleTest
 * @author    Michael Kühn <michael.kuehn@evolver.de>
 */

namespace Evolver\RepositoryManagerModuleTest\Integration;

use Evolver\RepositoryManagerModuleTest\Util\AbstractTestCase;

/**
 * Tests for the module class
 *
 * @package Evolver\RepositoryManagerModule
 */
class ModuleTest extends AbstractTestCase
{
    /**
     * Get the application config
     *
     * @return array
     */
    protected function getApplicationConfig()
    {
        return [
            'modules' => [
                'Evolver\RepositoryManagerModule'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ];
    }

    /**
     * Test if the module can be loaded
     *
     * @return void
     */
    public function testModuleIsLoadable()
    {
        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $this->getServiceManager()->get('ModuleManager');

        $this->assertNotNull(
            $moduleManager->getModule('Evolver\RepositoryManagerModule'),
            'Module could not be initialized'
        );
        $this->assertInstanceOf(
            'Evolver\RepositoryManagerModule\Module',
            $moduleManager->getModule('Evolver\RepositoryManagerModule')
        );
    }


}
