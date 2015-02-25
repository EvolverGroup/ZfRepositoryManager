<?php
/**
 * File for TestRepository class
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 * @package Evolver\RepositoryManagerTest
 * @author Michael Kühn <michael.kuehn@evolver.de>
 */
namespace Evolver\RepositoryManagerTest\Integration\Service\DoctrineObjectRepositoryFactoryTest\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping AS ORM;

/**
 * Repository class for UnitTest
 *
 * @package Evolver\RepositoryManagerTest
 * @ORM\Repository
 */
class TestRepository extends EntityRepository
{

}
