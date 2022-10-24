<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/24/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Db;

use Local\DataSourceFactory;
use PHPUnit\Framework\TestCase;

class DataSourceFactoryTest extends TestCase
{

    /**
     * @dataProvider datasourceConfig
     *
     */
    public function testConnect(string $driver, string $host, ?string $database, ?string $username, ?string $password)
    : void {
        $dsFactory = new DataSourceFactory($driver, $host, $database, $username, $password);

        $this->assertIsObject($dsFactory);
        $this->assertInstanceOf(DataSourceFactory::class, $dsFactory);
    }

    public function datasourceConfig()
    : array
    {
        if ($pos = strrpos(get_class(), '\\')) {
            $className = substr(get_class(), $pos + 1);
        } else {
            $className = get_class();
        }
        return TEST_DATA[$className]['datasources'] ?? [];
    }
}
