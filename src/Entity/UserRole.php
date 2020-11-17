<?php


namespace App\Entity;

/**
 * Class UserRole
 */
class UserRole
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserRole
     */
    public function setName(string $name): UserRole
    {
        $this->name = $name;
        return $this;
    }
}