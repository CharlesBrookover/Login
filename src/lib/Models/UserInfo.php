<?php

declare(strict_types=1);
/**
 * User's Info Model
 *
 * Date: 10/26/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Local\Models;

class UserInfo
{

    protected string              $email;
    protected ?string             $firstName              = '';
    protected ?string             $lastName               = '';
    protected ?string             $fullName;
    protected ?string             $city;
    protected ?int                $age;
    protected ?\DateTimeImmutable $created;
    protected ?\DateTimeImmutable $lastLogin;
    protected bool                $loggedIn               = false;
    protected bool                $passwordChangeRequired = false;

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
     *
     * @return UserInfo
     */
    public function setEmail(string $email)
    : UserInfo {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    : ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     *
     * @return UserInfo
     */
    public function setFirstName(?string $firstName)
    : UserInfo {
        $this->firstName = $firstName;
        $this->setFullName(sprintf('%s %s', $firstName, $this->getLastName()));
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName()
    : ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     *
     * @return UserInfo
     */
    public function setLastName(?string $lastName)
    : UserInfo {
        $this->lastName = $lastName;
        $this->setFullName(sprintf('%s %s', $this->getFirstName(), $lastName));
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullName()
    : ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     *
     * @return UserInfo
     */
    public function setFullName(?string $fullName)
    : UserInfo {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity()
    : ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return UserInfo
     */
    public function setCity(?string $city)
    : UserInfo {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge()
    : ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     *
     * @return UserInfo
     */
    public function setAge(?int $age)
    : UserInfo {
        $this->age = $age;
        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreated()
    : ?\DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @param \DateTimeImmutable|null $created
     *
     * @return UserInfo
     */
    public function setCreated(?\DateTimeImmutable $created)
    : UserInfo {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getLastLogin()
    : ?\DateTimeImmutable
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTimeImmutable|null $lastLogin
     *
     * @return UserInfo
     */
    public function setLastLogin(?\DateTimeImmutable $lastLogin)
    : UserInfo {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    : bool
    {
        return $this->loggedIn;
    }

    /**
     * @param bool $loggedIn
     *
     * @return UserInfo
     */
    public function setLoggedIn(bool $loggedIn)
    : UserInfo {
        $this->loggedIn = $loggedIn;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPasswordChangeRequired()
    : bool
    {
        return $this->passwordChangeRequired;
    }

    /**
     * @param bool $passwordChangeRequired
     *
     * @return UserInfo
     */
    public function setPasswordChangeRequired(bool $passwordChangeRequired)
    : UserInfo {
        $this->passwordChangeRequired = $passwordChangeRequired;
        return $this;
    }


}