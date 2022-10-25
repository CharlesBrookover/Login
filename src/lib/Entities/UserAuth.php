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

class UserAuth implements IDataEntities
{

    protected string          $email;
    protected string          $password;
    protected int|string|null $created;
    protected int|string|null $lastChanged;

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
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getCreated()
    : \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->created);
    }

    /**
     * @param int|string|null $created
     */
    public function setCreated(int|string|null $created)
    : void {
        $this->created = $created;
    }

    /**
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getLastChanged()
    : \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->lastChanged);
    }

    /**
     * @param int|string|null $lastChanged
     */
    public function setLastChanged(int|string|null $lastChanged)
    : void {
        $this->lastChanged = $lastChanged;
    }


}