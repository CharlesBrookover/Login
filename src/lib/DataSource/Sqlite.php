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

use Local\Entities\IDataEntities;

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

    public function select(string $table, array $where, ?IDataEntities $dataModel = null, array $dataTypes = [])
    : iterable {
        $data = [];

        $sql      = sprintf('select * from %s', $table);
        $sqlWhere = [];
        foreach ($where as $item => $value) {
            $placeholder = sprintf(':%s', $item);
            $sqlWhere[]  = $placeholder;
        }

        return $data;
    }

    public function insert(string $table, array $data, array $dataTypes = [])
    : int {
        // TODO: Implement insert() method.
    }

    public function delete(string $table, array $where, array $dataTypes = [])
    : int {
        // TODO: Implement delete() method.
    }

    public function numOfRows(string $table, array $where, array $dataTypes = [])
    : int {
        $data = $this->select($table, $where, null, $dataTypes);
        return count($data);
    }

    protected function buildWhere(array $where, array $dataTypes = [])
    {
        $return = [];

        foreach ($where as $item => $value) {
            $return[] = $item;
        }

        return $return;
    }
}