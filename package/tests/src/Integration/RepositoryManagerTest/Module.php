<?php
/**
 * File for module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Module class for UnitTest
 *
 * @package Evolver\RepositoryManagerTest
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
                    'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity\TestEntity' => 'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository'
                ]
            ]
        ];
    }
}
 