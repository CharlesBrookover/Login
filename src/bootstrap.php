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

defined('SRC_PATH') or define('SRC_PATH', realpath(dirname(__FILE__)));
defined('LIBRARY_PATH') or define('LIBRARY_PATH', realpath(SRC_PATH . '/../vendor'));
defined('DB_PATH') or define('DB_PATH', realpath(SRC_PATH . '/../resources'));
defined('CONFIG_PATH') or define('CONFIG_PATH', realpath(SRC_PATH . '/../config'));

require_once LIBRARY_PATH . '/autoload.php';

$config = new Config(realpath(CONFIG_PATH . '/config.json'));
if (getenv('SYS_PRODUCTION') === 'true') {
    $config->merge(CONFIG_PATH . '/config.prod.json');
}

$container = new \Local\Services\Container($config);

