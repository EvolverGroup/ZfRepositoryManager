<?php
/**
 * Short description for file
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package     RepositoryManager
 * @author      Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Short description for TestEntity
 *
 * @package Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Entity
 * @ORM\Entity(repositoryClass="Evolver\RepositoryManagerTest\Integration\RepositoryManagerTest\Repository\TestRepository")
 */
class TestEntity
{
    /**
     * @var
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;
}
 