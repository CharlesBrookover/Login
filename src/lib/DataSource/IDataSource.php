<?php
/**
 * Interface for all Data Sources that will be use to connect
 *
 * Date: 10/15/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\DataSource;

interface IDataSource
{
    public function __construct(string $host, ?string $database, ?string $username, ?string $password);

    public function connect()
    : \PDO;

}