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

namespace Local\Test\Database;

use Local\Database\DataSourceFactory;
use Local\Services\Config;
use Local\Test\Build\DbSetup;
use PDO;
use PHPUnit\Framework\TestCase;

class DataSourceFactoryTest extends TestCase
{

    public function datasourceConfig()
    : array
    {
        $dbSetup = new DbSetup(new Config(CONFIG_FILE));
        return $dbSetup->getDatasource() ?? [];
    }

    /**
     * @dataProvider datasourceConfig
     *
     */
    public function testConnect(string $driver, string $host, ?string $database, ?string $username, ?string $password)
    : void {
        $dsFactory = new DataSourceFactory($driver);
        $this->assertIsObject($dsFactory);
        $this->assertInstanceOf(DataSourceFactory::class, $dsFactory);

        $pdo = $dsFactory->connect($host, $database, $username, $password);

        $this->assertIsObject($pdo);
        $this->assertInstanceOf(PDO::class, $pdo);
    }

}
