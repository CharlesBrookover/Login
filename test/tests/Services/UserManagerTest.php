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

use Local\Models\UserInfo;
use Local\Services\Container;
use Local\Services\UserManager;
use Local\Test\Build\Data;
use Local\Test\Build\Helpers;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{

    private static Container $container;

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass();

        self::$container = Helpers::createContainer();
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
        $userManager = new UserManager(self::$container);
        $newUser     = $userManager->createUser($email, $password, $data);
        $this->assertIsObject($newUser);
        $this->assertInstanceOf(UserInfo::class, $newUser);

        $this->assertEquals($email, $newUser->getEmail());
        $this->assertEquals($data['firstName'] ?? '', $newUser->getFirstName());
        $this->assertEquals($data['lastName'] ?? '', $newUser->getLastName());
        $fullName = sprintf('%s %s', $data['firstName'] ?? '', $data['lastName'] ?? '');
        $this->assertEquals($fullName, $newUser->getFullName());
        $this->assertEquals($data['city'] ?? '', $newUser->getCity());
        $this->assertEquals($data['age'] ?? '', $newUser->getAge());
        $this->assertNotEmpty($newUser->getCreated());
        $this->assertInstanceOf(\DateTimeImmutable::class, $newUser->getCreated());
    }


}
