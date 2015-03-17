<?php
/**
 * File for module class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package   Evolver\RepositoryManagerTest
 * @author    Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\Service\DoctrineObjectRepositoryFactoryTest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Module class for UnitTest
 *
 * @package Integration\Service\DoctrineObjectRepositoryFactoryTest
 */
class Module implements ConfigProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'doctrine' => [
                'connection' => [
                    'orm_default' => [
                        'params' => [
                            'serverVersion' => '5.1'
                        ]
                    ]
                ],
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
                            'Evolver\RepositoryManagerTest\Integration\Service\DoctrineObjectRepositoryFactoryTest' => 'phpunit_annotation_driver'
                        ]
                    ]
                ]
            ]
        ];
    }
}