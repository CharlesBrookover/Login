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
use Local\Models\UserInfo;

class UserManager
{
    public function __construct(protected Container $container) { }

    public function createUser(string $email, string $password, array $data = [])
    : UserInfo {
        try {
            if ($this->insertUserAuthRecord($email, $password) === false) {
                throw new \RuntimeException('No User Auth Record Inserted');
            }
            if ($this->insertUserRecord($email, $data) === false) {
                throw new \RuntimeException('No User Record Inserted');
            }

            $user     = $this->selectUserRecord($email);
            $userAuth = $this->selectUserAuthRecord($email);
            $userInfo = new UserInfo();
            $userInfo->setEmail($user->getEmail())
                     ->setFirstName($user->getFirstName())
                     ->setLastName($user->getLastName())
                     ->setCity($user->getCity())
                     ->setAge($user->getAge())
                     ->setCreated(new \DateTimeImmutable($userAuth->getCreated()));

            return $userInfo;
        } catch (\PDOException $exception) {
            printf("PDO Exception: %s\n", $exception->getTraceAsString());
            throw new \Exception('Failed to create new user', 100, $exception);
        }
    }

    protected function insertUserAuthRecord(string $email, string $password)
    : bool {
        $query = 'insert into main.users_auth (email, password) values (:email, :password)';
        $pdo   = $this->container->getPdo();
        $stmt  = $pdo->prepare($query);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('password', password_hash($password, PASSWORD_DEFAULT));

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    protected function insertUserRecord(string $email, array $details = [])
    : bool {
        $query = 'insert into main.users (email, firstName, lastName, city, age) values (:email, :firstName, :lastName, :city, :age)';
        $pdo   = $this->container->getPdo();
        $stmt  = $pdo->prepare($query);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('firstName', $details['firstName'] ?? null);
        $stmt->bindValue('lastName', $details['lastName'] ?? null);
        $stmt->bindValue('city', $details['city'] ?? null);
        $stmt->bindValue('age', $details['age'] ?? null, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    protected function selectUserRecord(string $email)
    : User {
        $query = 'select * from main.users where email = :email limit 1';
        $pdo   = $this->container->getPdo();
        $stmt  = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        return $stmt->fetchObject(User::class);
    }

    protected function selectUserAuthRecord(string $email)
    : UserAuth {
        $query = 'select * from main.users_auth where email = :email limit 1';
        $pdo   = $this->container->getPdo();
        $stmt  = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        return $stmt->fetchObject(UserAuth::class);
    }

    public function getUserInfo($email)
    : ?UserInfo {
        $query = 'select u.*, ua.lastChanged, ua.lastLogin from main.users u inner join main.users_auth ua on u.email = ua.email where u.email = :email limit 1';
        $pdo   = $this->container->getPdo();
        $stmt  = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
    }
}