<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/27/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Test\Services;

use Local\Services\Config;
use Local\Test\Build\Data;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    private static array $testData = [];
    private Config       $config;

    private string $mergeKey    = 'merge';
    private string $firstKey    = 'first';
    private string $firstDotKey = 'first.a.bb';
    private string $badDotKey   = 'xxx.xxx.xxx.xxx';
    private string $badFile     = 'BadFile.json';

    private string $mergedTestKey = 'second.a';
    private int    $mergedValue   = 100;
    private int    $origValue     = 1;

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        $data           = new Data(self::class);
        self::$testData = $data->getTestData();
    }

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->config = new Config(TEST_PATH . '/' . self::$testData['data'] ?? '');
    }

    public function testConstructException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Config($this->badFile);
    }

    public function testOffsetGet()
    {
        $this->assertNotEmpty($this->config->offsetGet($this->firstKey));
        $this->assertNotEmpty($this->config->offsetGet($this->firstDotKey));

        $this->assertEmpty($this->config->offsetGet(''));
        $this->assertEmpty($this->config->offsetGet($this->badDotKey));

        $this->assertEquals($this->origValue, $this->config->offsetGet($this->mergedTestKey));
    }

    public function testOffsetExists()
    {
        $exists = $this->config->offsetExists($this->firstKey);
        $this->assertIsBool($exists);
        $this->assertTrue($exists);

        $exists = $this->config->offsetExists($this->firstDotKey);
        $this->assertIsBool($exists);
        $this->assertTrue($exists);

        $notExists = $this->config->offsetExists('');
        $this->assertIsBool($notExists);
        $this->assertFalse($notExists);

        $notExists = $this->config->offsetExists($this->badDotKey);
        $this->assertIsBool($notExists);
        $this->assertFalse($notExists);
    }

    public function testMerge()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->merge($this->badFile);

        $this->assertEquals($this->origValue, $this->config->offsetGet($this->mergedTestKey));

        $this->assertTrue($this->config->merge(TEST_PATH . '/' . self::$testData['merge'] ?? ''));
        $this->assertTrue($this->config->offsetExists($this->mergeKey));

        $this->assertEquals($this->mergedValue, $this->config->offsetGet($this->mergedTestKey));
    }

    public function testOffsetSet()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->config->offsetSet('badKey', null);
    }

    public function testOffsetUnset()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->config->offsetUnSet('badKey');
    }

}
