<?php
/**
 * File for TestEntity class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Entity for Unit-Test
 *
 * @package Evolver\RepositoryManagerTest
 * @ORM\Entity(repositoryClass="Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository")
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
 