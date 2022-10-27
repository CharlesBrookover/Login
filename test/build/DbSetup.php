<?php

declare(strict_types=1);
/**
 * Setup the test databases
 *
 * Date: 10/26/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Build;

use Local\Services\Config;
use SQLite3;

class DbSetup
{

    protected array $datasources = [];

    public function __construct(private readonly Config $config)
    {
        $datasources = $this->config->offsetGet('datasources');
        foreach ($datasources as $datasource => $details) {
            $this->datasources[$datasource] = $this->buildDatasource($datasource, $details);
        }
    }

    public function buildDb(array $datasources)
    : void {
        foreach ($datasources as $datasource => $details) {
            switch ($datasource) {
                case 'sqlite':
                    $this->setupSqliteDb($details['file'] ?? '', $details['sqlFile'] ?? '');
                    break;
            }
        }
    }

    public function getDatasource(?string $type = null)
    : array {
        return empty($type) ? $this->datasources : ($this->datasources[$type] ?? []);
    }

    protected function setupSqliteDb(string $file, string $sqlFile)
    : void {
        if (empty($file)) {
            $dbFile = ':memory:';
        } else {
            $dbFile = $this->expandPath($file);
            if (file_exists($dbFile)) {
                unlink($dbFile);
            }
        }

        // Create DB
        $sqlite = new SQLite3($dbFile);

        // Create tables in DB
        if (!empty($sqlFile)) {
            $sql       = $this->expandPath($sqlFile);
            $createSql = file_get_contents($sql);
            $sqlite->exec($createSql);
        }
    }

    protected function expandPath(string $path)
    : string {
        preg_match_all('/%(?<constant>[A-Z_]+)?%/', $path, $matches, PREG_PATTERN_ORDER);

        $newPath = '';
        foreach ($matches['constant'] as $constant) {
            $newPath = preg_replace('/%' . $constant . '%/', constant($constant), $path);
        }

        return empty($newPath) ? $path : $newPath;
    }

    protected function buildDatasource(string $driver, array $config = [])
    : array {
        return [
            'driver'   => $driver,
            'host'     => $driver === 'sqlite' ? $this->expandPath($config['file'] ?? '') : $config['host'] ?? '',
            'database' => $config['database'] ?? null,
            'username' => $config['username'] ?? null,
            'password' => $config['password'] ?? null,
        ];
    }
}