<?php


namespace App\Entity;


class CreditType
{
    protected int $id;
    protected string $name;
    protected string $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CreditType
     */
    public function setId(int $id): CreditType
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
     * @return CreditType
     */
    public function setName(string $name): CreditType
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CreditType
     */
    public function setDescription(string $description): CreditType
    {
        $this->description = $description;
        return $this;
    }


}