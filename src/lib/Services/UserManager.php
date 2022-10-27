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

use Local\Database\Entities\User;
use Local\Database\Entities\UserAuth;

class UserManager
{

    public function createUser(string $email, string $password, array $data = [])
    : UserAuth {
        $newUserAuth = new UserAuth();
        $newUserAuth->setEmail($email);
        $newUserAuth->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $newUser = new User();
        $newUser->setEmail($email);
        foreach ($data as $item => $value) {
            $setter = sprintf('set%s', ucfirst($item));
            if (method_exists($newUser, $setter)) {
                $newUser->$setter($value);
            }
        }

        return $newUserAuth;
    }
}