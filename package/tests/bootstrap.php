<?php
/**
 * Bootstrapping for PHPUnit-Tests
 *
 * @copyright Copyright (c) 2014, evolver media GmbH & Co. KG (http://evolver.de)
 */

/**
 * Report all errors
 */
error_reporting(-1);

/**
 * Set up default timezone for this application
 */
date_default_timezone_set('Europe/Berlin');

/**
 * Files will be created as -rw-rw-r--
 * Directories will be creates as drwxrwxr-x
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
