<?php


namespace App\Entity;


use DateTime;

abstract class BaseEntity
{
    protected int $id;

    protected ?DateTime $created;

    protected ?DateTime $updated;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BaseEntity
     */
    public function setId(int $id): BaseEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreated(): ?DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime|null $created
     * @return BaseEntity
     */
    public function setCreated(?DateTime $created): BaseEntity
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdated(): ?DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime|null $updated
     * @return BaseEntity
     */
    public function setUpdated(?DateTime $updated): BaseEntity
    {
        $this->updated = $updated;
        return $this;
    }
}