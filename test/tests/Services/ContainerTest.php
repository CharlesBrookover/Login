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

use Local\Services\Container;
use Local\Test\Build\Helpers;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{

    private static Container $container;

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        self::$container = Helpers::createContainer();
    }

    public function testGetPdo()
    {
        $pdo = self::$container->getPdo();
        $this->assertIsObject($pdo);
        $this->assertInstanceOf(\PDO::class, $pdo);
    }
}
