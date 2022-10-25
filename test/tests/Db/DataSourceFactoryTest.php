<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/24/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Db;

use Local\DataSourceFactory;
use PHPUnit\Framework\TestCase;

class DataSourceFactoryTest extends TestCase
{

    private array        $testData = [];
    private static array $rowIds;

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        self::$rowIds = ['this' => []];
    }

    private function getTestData()
    : array
    {
        if (empty($this->testData)) {
            if ($pos = strrpos(get_class(), '\\')) {
                $className = substr(get_class(), $pos + 1);
            } else {
                $className = get_class();
            }

            $this->testData = TEST_DATA[$className] ?? [];
        }

        return $this->testData;
    }

    public function datasourceConfig()
    : array
    {
        return DATASOURCES_CONFIG ?? [];
    }

    public function getSelectData()
    : array
    {
        $testData = $this->getTestData();
        return $testData['select'] ?? [];
    }

    public function getInsertData()
    : array
    {
        $testData = $this->getTestData();
        return $testData['insert'] ?? [];
    }

    public function getDeleteData()
    : array
    {
        $testData = $this->getTestData();
        return $testData['delete'] ?? [];
    }

    private function changeDataTypesToConstants(array $array)
    : array {
        return array_map(fn($v) => constant($v), $array);
    }

    /**
     * @dataProvider datasourceConfig
     *
     */
    public function testConnect(string $driver, string $host, ?string $database, ?string $username, ?string $password)
    : void {
        $dsFactory = new DataSourceFactory($driver, $host, $database, $username, $password);

        $this->assertIsObject($dsFactory);
        $this->assertInstanceOf(DataSourceFactory::class, $dsFactory);
    }

    /**
     * @depends testInsert
     *
     * @return void
     * @throws \Throwable
     */
    public function testSelect()
    : void
    {
        $selectData  = $this->getSelectData();
        $datasources = $this->datasourceConfig();
        foreach ($datasources as $datasource) {
            $dsFactory = new DataSourceFactory($datasource['driver'], $datasource['host'], $datasource['database'],
                                               $datasource['username'], $datasource['password']);

            foreach ($selectData as $select) {
                $return = $dsFactory->select($select['entity'], $select['query']);

                $this->assertIsIterable($return);
                foreach ($return as $record) {
                    $this->assertInstanceOf($select['entity'], $record);
                }

                $count = $dsFactory->recordCount($select['table']);
                $this->assertGreaterThanOrEqual(count(self::$rowIds[$select['table']]), $count);
            }
        }
    }

    public function testInsert()
    : void
    {
        $insertData  = $this->getInsertData();
        $datasources = $this->datasourceConfig();
        foreach ($datasources as $datasource) {
            $factory = new DataSourceFactory($datasource['driver'], $datasource['host'], $datasource['database'],
                                             $datasource['username'], $datasource['password']);

            foreach ($insertData as $insert) {
                $rows = $factory->insert($insert['query'],
                                         $insert['data'],
                                         $this->changeDataTypesToConstants($insert['dataTypes'] ?? []));

                $this->assertSame(1, $rows);

                if (!isset(self::$rowIds[$insert['table']])) {
                    self::$rowIds[$insert['table']] = [];
                }

                self::$rowIds[$insert['table']][] = $factory->getLastInsertId();
            }
        }
    }

    /**
     * @depends testSelect
     *
     * @return void
     * @throws \Throwable
     */
    public function testDelete()
    : void
    {
        $deleteData  = $this->getDeleteData();
        $datasources = $this->datasourceConfig();
        foreach ($datasources as $datasource) {
            $factory = new DataSourceFactory($datasource['driver'], $datasource['host'], $datasource['database'],
                                             $datasource['username'], $datasource['password']);

            foreach ($deleteData as $delete) {
                foreach (self::$rowIds[$delete['table']] ?? [] as $rowId) {
                    $rows = $factory->delete($delete['query'],
                                             [$rowId],
                                             $this->changeDataTypesToConstants($delete['dataTypes'] ?? []));
                    $this->assertGreaterThanOrEqual(1, $rows);
                }
            }
        }
    }
}
