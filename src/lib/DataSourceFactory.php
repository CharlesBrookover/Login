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
     * @param string      $driver
     * @param string      $host
     * @param string|null $database
     * @param string|null $username
     * @param string|null $password
     *
     * @throws \Throwable
     */
    public function __construct(string $driver, string $host, ?string $database = null, ?string $username = null, ?string $password = null)
    {
        $this->setDriver($driver);
        $this->conn = $this->connect($host, $database, $username, $password);
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
        /**
         * @todo Add other data sources
         */
        $db = match ($this->driver) {
            default => new Sqlite($host),
        };

        return $db->connect();
    }

    public function select(string $query)
    : array {
    }

    public function insert()
    : int
    {
    }

    public function execute()
    : void
    {
    }

    public function numberOfRows()
    : int
    {
    }
}