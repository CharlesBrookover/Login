<?php

declare(strict_types=1);
/**
 * User Entity
 *
 * Date: 10/16/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Database\Entities;

class User implements IEntities
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
     * @return string
     */
    public function getFirstName()
    : string
    {
        return $this->firstName;
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
     * @return string
     */
    public function getCity()
    : string
    {
        return $this->city;
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
     * @return int|string|null
     */
    public function getInserted()
    : int|string|null
    {
        return $this->inserted;
    }

    /**
     * @return int|string|null
     */
    public function getUpdated()
    : int|string|null
    {
        return $this->updated;
    }

}