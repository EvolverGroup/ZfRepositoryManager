<?php
/**
 * Short description for file
 *
 * @copyright   evolver media
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 * @version     SVN: $Id$
 */
namespace Evolver\RepositoryManagerTest\Integration\Service\DoctrineRepositoryFactoryTest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Short description for Module
 *
 * @package Integration\Service\DoctrineRepositoryFactoryTest
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
