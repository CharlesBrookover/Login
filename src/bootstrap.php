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

defined('SRC_PATH') or define('SRC_PATH', realpath(dirname(__FILE__)));
defined('LIBRARY_PATH') or define('LIBRARY_PATH', SRC_PATH. '/../vendor');
defined('DB_PATH') or define('DB_PATH', SRC_PATH . '/../resources');

$config = json_decode(SRC_PATH . '/../config/config.json', true);
/*
 * if (PROD) {
 *  $prodConfig = json_decode(SRC_PATH . '/../config/config.prod.json', true);
 *  $config = array_merge_recursive( $config, $prodConfig);
 * }
 */

require_once LIBRARY_PATH . '/autoload.php';

