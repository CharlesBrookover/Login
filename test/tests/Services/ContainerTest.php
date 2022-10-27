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

namespace Local\Test\Services;

use Local\Services\Config;
use Local\Services\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{

    private static Container $container;
    private static string    $testConfigFile = TEST_PATH . '/data/config.json';

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        self::$container = new Container(new Config(self::$testConfigFile));
    }

    public function testGetPdo()
    {
        $pdo = self::$container->getPdo();
        $this->assertIsObject($pdo);
        $this->assertInstanceOf(\PDO::class, $pdo);
    }
}
