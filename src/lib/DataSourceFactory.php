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

    public function select(string $entity, string $query, array $data = [], array $dataTypes = [])
    : \ArrayIterator {
        $stmt = $this->conn->prepare($query);
        $this->bindValues($stmt, $data, $dataTypes);

        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_CLASS, $entity);
        return new \ArrayIterator($return);
    }

    public function insert(string $query, array $data = [], array $dataTypes = [])
    : int {
        $stmt = $this->conn->prepare($query);
        $this->bindValues($stmt, $data, $dataTypes);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $query, array $data = [], array $dataTypes = [])
    : int {
        $stmt = $this->conn->prepare($query);
        $this->bindValues($stmt, $data, $dataTypes);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function recordCount(string $table, array $where = [], array $data = [], array $dataTypes = [])
    : int {
        $query = sprintf('select * from %s', $table);
        if (!empty($where)) {
            $query .= sprintf(' where %s', join(' AND ', $where));
        }

        $results = $this->select(\stdClass::class, $query, $data, $dataTypes);
        return $results->count();
    }

    public function getLastInsertId()
    : string
    {
        return $this->conn->lastInsertId();
    }

    protected function bindValues(\PDOStatement &$statement, array $data, array $dataTypes = [])
    : void {
        foreach ($data as $name => $value) {
            $placeHolder = is_int($name) ? $name + 1 : $name;
            if (isset($dataTypes[$name])) {
                $statement->bindValue($placeHolder, $value, $dataTypes[$name]);
            } else {
                $statement->bindValue($placeHolder, $value);
            }
        }
    }
}