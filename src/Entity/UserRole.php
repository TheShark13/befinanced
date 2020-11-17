<?php


namespace App\Entity;

/**
 * Class UserRole
 */
class UserRole
{
    /**
     * @var int
     */
    protected int $id;
    /**
     * @var string
     */
    protected string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserRole
     */
    public function setId(int $id): UserRole
    {
        $this->id = $id;
        return $this;
    }

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