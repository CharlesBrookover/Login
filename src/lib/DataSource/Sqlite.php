<?php
/**
 * Data Source class to connect to a Sqlite database
 *
 * Date: 10/15/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\DataSource;

class Sqlite implements IDataSource
{
    public function __construct(protected string $host, protected ?string $database = null, protected ?string $username = null, protected ?string $password = null)
    {
    }

    public function connect()
    : \PDO
    {
        $dsn = sprintf('sqlite:%s', $this->host);
        $pdo = new \PDO($dsn);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

}