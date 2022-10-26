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

namespace Local\Entities;

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
     * @param string $email
     */
    public function setEmail(string $email)
    : void {
        $this->email = $email;
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
     * @param string $password
     */
    public function setPassword(string $password)
    : void {
        $this->password = $password;
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
     * @param int|string|null $created
     */
    public function setCreated(int|string|null $created)
    : void {
        $this->created = $created;
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
     * @param int|string|null $lastChanged
     */
    public function setLastChanged(int|string|null $lastChanged)
    : void {
        $this->lastChanged = $lastChanged;
    }

    /**
     * @return int|string|null
     */
    public function getLastLogin()
    : int|string|null
    {
        return $this->lastLogin;
    }

    /**
     * @param int|string|null $lastLogin
     */
    public function setLastLogin(int|string|null $lastLogin)
    : void {
        $this->lastLogin = $lastLogin;
    }


}