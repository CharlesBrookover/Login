<?php

declare(strict_types=1);
/**
 * PHPUnit Bootstrap
 *
 * Date: 10/23/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

defined('TEST_PATH') or define('TEST_PATH', realpath(dirname(__FILE__)));
defined('TEST_DATA') or define('TEST_DATA', json_decode(file_get_contents(TEST_PATH . '/config/data.json'), true));
defined('PROJECT_PATH') or define('PROJECT_PATH', realpath(TEST_PATH . '/..'));

$config = json_decode(file_get_contents(TEST_PATH . '/config/config.test.json'), true);

defined('DATASOURCES_CONFIG') or define('DATASOURCES_CONFIG', buildDataSources($config['datasources'] ?? []));

foreach ($config['datasources'] as $database) {
    switch ($database['driver']) {
        case 'sqlite':
            buildSqliteTestDb($database['host'] ?? null, $database['sqlFile'] ?? null);
            break;
    }
}


/**
 * Build the DB for the test system
 *
 * @param string|null $file
 * @param string|null $sqlFile
 *
 * @return void
 */
function buildSqliteTestDb(?string $file, ?string $sqlFile)
: void {
    if (isset($file)) {
        $dbFile = expandPath($file);
        if (file_exists($dbFile)) {
            unlink($dbFile);
        }
    } else {
        $dbFile = ':memory:';
    }

    // Create DB
    $sqlite = new \SQLite3($dbFile);
    // Create tables in DB
    if (isset($sqlFile)) {
        $sql       = expandPath($sqlFile);
        $createSql = file_get_contents($sql);
        $sqlite->exec($createSql);
    }
}

function expandPath(string $path)
: string {
    preg_match_all('/%(?<constant>[A-Z_]+)?%/', $path, $matches, PREG_PATTERN_ORDER);

    $newPath = '';
    foreach ($matches['constant'] as $constant) {
        $newPath = preg_replace('/%' . $constant . '%/', constant($constant), $path);
    }

    return empty($newPath) ? $path : $newPath;
}

function buildDataSources(array $databases)
: array {
    $datasources = [];
    foreach ($databases as $database) {
        $datasources[] = [
            'driver'   => expandPath($database['driver'] ?? ''),
            'host'     => expandPath($database['host'] ?? ''),
            'database' => expandPath($database['database'] ?? ''),
            'username' => expandPath($database['username'] ?? ''),
            'password' => expandPath($database['password'] ?? ''),
        ];
    }

    return $datasources;
}
