<?php

declare(strict_types=1);
/**
 * Users Service
 *
 * Date: 10/25/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local;

use InvalidArgumentException;
use Local\Database\DataSourceFactory;
use Local\Database\Entities\UserAuth;
use Local\Models\UserInfo;

class Users
{

    public function __construct(protected DataSourceFactory $dataSourceFactory)
    {
    }

    public function login(string $email, string $password)
    : UserInfo|null {
        if (!$this->userExists($email)) {
            throw new InvalidArgumentException('User Not Exists');
        }

        $query    = 'select * from main.users_auth where email = ? limit 1';
        $results  = $this->dataSourceFactory->select(UserAuth::class, $query, ['email' => $email]);
        $userAuth = $results->offsetGet(0);

        if (password_verify($password, $userAuth->getPassword())) {
        }
    }

    protected function userExists(string $email)
    : bool {
        return $this->dataSourceFactory->recordCount('users', ['email = ?'], ['email' => $email]) > 0;
    }

    public function getUserInfo(string $email)
    : UserInfo|null {
    }

    public function logout(string $email)
    : bool {
    }

    public function updateUserInfo(string $email, array $data)
    : UserInfo|null {
    }

    public function changePassword(string $email, string $password)
    : bool {
    }

    public function createNewUser()
    : UserInfo
    {
    }
}