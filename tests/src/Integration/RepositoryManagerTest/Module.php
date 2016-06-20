<?php
/**
 * File for module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModuleTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Module class for UnitTest
 *
 * @package Evolver\RepositoryManagerModuleTest
 */
class Module implements ConfigProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'repositories' => [
                'invokables' => [
                    'Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Entity\TestEntity' => 'Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Repository\TestRepository'
                ]
            ]
        ];
    }
}
