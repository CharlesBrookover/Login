<?php

declare(strict_types=1);
/**
 * User Auth Entity
 *
 * Date: 10/16/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Database\Entities;

class UserAuth implements IEntities
{

    protected string          $email;
    protected string          $password;
    protected int|string|null $created;
    protected int|string|null $lastChanged;
    protected int|string|null $lastLogin;

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
    public function getPassword()
    : string
    {
        return $this->password;
    }

    /**
     * @return int|string|null
     */
    public function getCreated()
    : int|string|null
    {
        return $this->created;
    }

    /**
     * @return int|string|null
     */
    public function getLastChanged()
    : int|string|null
    {
        return $this->lastChanged;
    }

    /**
     * @return int|string|null
     */
    public function getLastLogin()
    : int|string|null
    {
        return $this->lastLogin;
    }



}