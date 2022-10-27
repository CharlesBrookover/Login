<?php

declare(strict_types=1);
/**
 * PHPUnit Bootstrap
 *
 * Date: 10/23/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */


use Local\Services\Config;
use Local\Test\Build\DbSetup;

defined('TEST_PATH') or define('TEST_PATH', realpath(dirname(__FILE__)));
defined('PROJECT_PATH') or define('PROJECT_PATH', realpath(TEST_PATH . '/..'));

defined('BUILD_CONFIG_FILE') or define('BUILD_CONFIG_FILE', TEST_PATH . '/config/build.json');
defined('DATASOURCE_DRIVER') or define('DATASOURCE_DRIVER', 'sqlite');

require_once PROJECT_PATH . '/vendor/autoload.php';

// Set up the test db before all tests are run
$dbSetup = new DbSetup(new Config(BUILD_CONFIG_FILE));
$dbSetup->buildDb();
