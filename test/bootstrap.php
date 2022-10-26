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


use Local\Test\Build\DbSetup;

defined('TEST_PATH') or define('TEST_PATH', realpath(dirname(__FILE__)));
defined('PROJECT_PATH') or define('PROJECT_PATH', realpath(TEST_PATH . '/..'));

require_once PROJECT_PATH . '/vendor/autoload.php';

$config  = json_decode(file_get_contents(TEST_PATH . '/config/config.test.json'), true);
$dbSetup = new DbSetup($config['datasources'] ?? []);

