<?php
/**
 * Bootstrapping for PHPUnit-Tests
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG <info@evolver.de>
 */

/**
 * Files will be created as -rw-rw-r--
 * Directories will be created as drwxrwxr-x
 */
umask(0002);

/**
 * Make everything relative to the application root
 */
chdir(dirname(dirname(__DIR__)));

/**
 * Initialize autoloader
 */
require 'vendor/autoload.php';
