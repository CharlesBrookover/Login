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

namespace Local\Test\Services;

use Local\Entities\UserAuth;
use Local\Services\UserManager;
use Local\Test\Build\Config;
use Local\Test\Build\Data;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{

    private static Config $config;
    private static array  $datasource;

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        self::$config     = new Config(CONFIG_FILE);
        self::$datasource = self::$config->getConfig('datasources')[DATASOURCE_DRIVER] ?? [];
    }

    public function userDataProvider()
    : array
    {
        $testData = new Data(self::class);
        return $testData->getTestData('users');
    }

    /**
     * @dataProvider userDataProvider
     */
    public function testCreateUser(string $email, string $password, array $data = [])
    {
        $userManager = new UserManager();
        $newUser     = $userManager->createUser($email, $password, $data);
        $this->assertIsObject($newUser);
        $this->assertInstanceOf(UserAuth::class, $newUser);
    }


}
