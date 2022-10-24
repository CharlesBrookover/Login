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

use Local\Helper;

defined('TEST_PATH') or define('TEST_PATH', realpath(dirname(__FILE__)));
defined('TEST_DATA') or define('TEST_DATA',  json_decode(file_get_contents(TEST_PATH . '/config/data.json'), true));

$config   = json_decode(file_get_contents(TEST_PATH . '/config/config.test.json'), true);
$baseData = json_decode(file_get_contents(TEST_PATH . '/config/baseData.json'), true);


buildTestDb($baseData);

/**
 * Build the DB for the test system
 *
 * @param array $data
 *
 * @return void
 */
function buildTestDb(array $data)
: void {
    $dbFile = $data['dbFile'] ?? ':memory:';
    if (file_exists($dbFile)) {
        unlink($dbFile);
    }

    // Create DB
    $sqlite = new \SQLite3($dbFile);
    // Create tables in DB
    $createSql = file_get_contents(TEST_PATH . '/../build/database.sql');
    $sqlite->exec($createSql);

    foreach ($data['tables'] ?? [] as $table => $info) {
        $stmt = $sqlite->prepare($info['sql']);
        foreach ($info['data'] as $data) {
            foreach ($data as $key => $value) {
                if ($key === 'password') {
                    $hash = Helper::hashPassword($value);
                    $stmt->bindValue($key, $hash);
                } else {
                    $stmt->bindValue($key, $value);
                }
            }
            $stmt->execute();
        }
        $stmt->close();
    }
}

