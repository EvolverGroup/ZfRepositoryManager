<?php
/**
 * File for ModuleTest class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */

namespace Evolver\RepositoryManagerTest\Integration;

use Evolver\PhpUnit\AbstractModuleLoaderAwareTestCase;

/**
 * Tests for the module class
 *
 * @package Evolver\RepositoryManager
 */
class ModuleTest extends AbstractModuleLoaderAwareTestCase
{
    /**
     * Test if the module can be loaded
     *
     * @return void
     */
    public function testModuleIsLoadable()
    {
        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $this->getModuleLoader()->getModuleManager();

        $this->assertNotNull(
            $moduleManager->getModule('Evolver\RepositoryManager'),
            'Module could not be initialized'
        );
        $this->assertInstanceOf(
            'Evolver\RepositoryManager\Module',
            $moduleManager->getModule('Evolver\RepositoryManager')
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setApplicationConfig([
            'modules' => [
                'Evolver\RepositoryManager'
            ],
            'module_listener_options' => [
                'check_dependencies' => true
            ]
        ]);
    }
}
