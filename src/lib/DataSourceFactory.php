<?php
/**
 * A factory class to connect to a data source
 *
 * Date: 10/15/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local;

use Local\DataSource\Sqlite;

class DataSourceFactory
{

    private ?string $driver = null;
    private \PDO    $conn;

    /**
     * @param string $driver
     */
    public function __construct(string $driver)
    {
        $this->setDriver($driver);
    }

    public function setDriver(string $name)
    : void {
        $this->driver = $name;
    }

    /**
     * @param string      $host
     * @param string|null $database
     * @param string|null $username
     * @param string|null $password
     *
     * @return \PDO
     */
    public function connect(string $host, ?string $database, ?string $username, ?string $password)
    : \PDO {
        if (empty($conn)) {
            /**
             * @todo Add other data sources
             */
            $factory = match ($this->driver) {
                'sqlite' => new Sqlite($host),
            };

            $this->conn = $factory->connect();
        }
        return $this->conn;
    }

    public function getPdo()
    : \PDO
    {
        return $this->conn;
    }
}