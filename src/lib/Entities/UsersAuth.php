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

class UsersAuth implements IDataEntities
{

    protected string $email;
    protected string $password;
    protected int    $created;
    protected int    $lastChanged;

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
     * @return int
     */
    public function getCreated()
    : int
    {
        return $this->created;
    }

    /**
     * @param int $created
     */
    public function setCreated(int $created)
    : void {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getLastChanged()
    : int
    {
        return $this->lastChanged;
    }

    /**
     * @param int $lastChanged
     */
    public function setLastChanged(int $lastChanged)
    : void {
        $this->lastChanged = $lastChanged;
    }


}