<?php


namespace App\Entity;

/**
 * Class UserProfile
 */
class UserProfile extends BaseEntity
{

    /**
     * @var string
     */
    protected string $firstName;

    /**
     * @var string
     */
    protected string $lastName;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserProfile
     */
    public function setFirstName(string $firstName): UserProfile
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserProfile
     */
    public function setLastName(string $lastName): UserProfile
    {
        $this->lastName = $lastName;
        return $this;
    }



}