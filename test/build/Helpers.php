<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/27/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Build;

use Local\Services\Config;
use Local\Services\Container;

class Helpers
{
    protected static string $baseConfigFile = TEST_PATH . '/config/config.test.json';

    public static function createContainer(?string $configFile = null)
    : Container {
        return new Container(new Config($configFile ?? self::$baseConfigFile));
    }
}