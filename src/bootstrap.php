<?php

declare(strict_types=1);

/**
 * Bootstrap file
 *
 * Date: 10/23/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

use Local\Services\Config;
use Local\Services\Container;

defined('PROJECT_PATH') or define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once PROJECT_PATH . '/vendor/autoload.php';

$config = new Config(realpath(PROJECT_PATH . '/config/config.json'));
if (getenv('SYS_PRODUCTION') === 'true') {
    $config->merge(PROJECT_PATH . '/config//config.prod.json');
}

$container = new Container($config);

