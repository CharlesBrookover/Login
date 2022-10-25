<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 10/16/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Entities;

class User implements IDataEntities
{
    protected string          $email;
    protected string          $firstName;
    protected string          $lastName;
    protected string          $city;
    protected int             $age;
    protected string|int|null $inserted;
    protected string|int|null $updated;

    /**
     * @return string
     */
    public function getEmail()
    : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    : void {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName()
    : string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    : void {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    : string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    : void {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getCity()
    : string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    : void {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getAge()
    : int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    : void {
        $this->age = $age;
    }

    /**
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getInserted()
    : \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->inserted);
    }

    /**
     * @param string|int|null $inserted
     *
     */
    public function setInserted(string|int|null $inserted)
    : void {
        $this->inserted = $inserted;
    }

    /**
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getUpdated()
    : \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->updated);
    }

    /**
     * @param string|int|null $updated
     *
     */
    public function setUpdated(string|int|null $updated)
    : void {
        $this->updated = $updated;
    }

}