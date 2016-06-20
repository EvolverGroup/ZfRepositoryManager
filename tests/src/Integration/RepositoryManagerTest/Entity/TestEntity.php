<?php
/**
 * File for TestEntity class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 * @package Evolver\RepositoryManagerModuleTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Entity for Unit-Test
 *
 * @package Evolver\RepositoryManagerModuleTest
 * @ORM\Entity(repositoryClass="Evolver\RepositoryManagerModuleTest\Integration\RepositoryManagerTest\Repository\TestRepository")
 */
class TestEntity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;
}
