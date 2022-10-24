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

use Local\Entities\IDataEntities;

interface IDataSource
{
    public function __construct(string $host, ?string $database, ?string $username, ?string $password);

    public function connect()
    : \PDO;

    public function select(string $table, array $where, ?IDataEntities $dataModel = null, array $dataTypes = [])
    : iterable;

    public function insert(string $table, array $data, array $dataTypes = [])
    : int;

    public function delete(string $table, array $where, array $dataTypes = [])
    : int;

    public function numOfRows(string $table, array $where, array $dataTypes = [])
    : int;
}