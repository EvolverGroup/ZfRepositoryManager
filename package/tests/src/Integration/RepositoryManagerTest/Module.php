<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Short description for Module
 *
 * @package Evolver\RepositoryManagerTest\Integration\ModuleTest
 */
class Module implements ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return [
            'repositories' => [
                'invokables' => [
                    'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity\TestEntity' => 'Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository'
                ]
            ],
            'doctrine' => [
                'driver' => [
                    'phpunit_annotation_driver' => [
                        'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                        'cache' => 'array',
                        'paths' => [
                            __DIR__ . '/Entity/'
                        ],
                    ],
                    'orm_default' => [
                        'drivers' => [
                            'Evolver\RepositoryManagerTest\Integration\Service\DoctrineRepositoryFactoryTest' => 'phpunit_annotation_driver'
                        ]
                    ]
                ]
            ]
        ];
    }
}
 