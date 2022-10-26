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

class DbSetup
{

    public function __construct(array $config)
    {
        foreach ($config as $db => $details) {
            switch ($db) {
                case 'sqlite':
                    $this->setupSqliteDb($details['file'] ?? '', $details['sqlFile'] ?? '');
                    break;
            }
        }
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
        $sqlite = new \SQLite3($dbFile);

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

}