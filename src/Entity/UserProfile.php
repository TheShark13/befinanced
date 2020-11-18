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
     * @var string
     */
    protected string $phoneNumber;

    /**
     * @var string
     */
    protected string $nin;

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

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return UserProfile
     */
    public function setPhoneNumber(string $phoneNumber): UserProfile
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getNin(): string
    {
        return $this->nin;
    }

    /**
     * @param string $nin
     * @return UserProfile
     */
    public function setNin(string $nin): UserProfile
    {
        $this->nin = $nin;
        return $this;
    }


}