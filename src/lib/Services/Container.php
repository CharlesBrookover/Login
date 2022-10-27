<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/26/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Services;

use Local\Database\DataSourceFactory;
use Local\Helpers;

class Container
{
    protected \PDO $pdo;

    public function __construct(protected Config $configuration) { }

    public function getPdo()
    : \PDO
    {
        if (empty($this->pdo)) {
            $dbConfig  = $this->configuration->offsetGet('databases.main');
            $factory   = new DataSourceFactory($dbConfig['driver'] ?? '');
            $this->pdo = $factory->connect(Helpers::expandPath($dbConfig['host'] ?? ''),
                                           $dbConfig['database'] ?? null,
                                           $dbConfig['username'] ?? null,
                                           $dbConfig['password'] ?? null);
        }

        return $this->pdo;
    }

}