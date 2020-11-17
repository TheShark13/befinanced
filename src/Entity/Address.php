<?php


namespace App\Entity;


class Address
{
    protected int $id;
    protected string $streetName;
    protected string $streetNumber;
    protected string $postalCode;
    protected string $lineOne;
    protected string $city;
    protected string $county;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Address
     */
    public function setId(int $id): Address
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     * @return Address
     */
    public function setStreetName(string $streetName): Address
    {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     * @return Address
     */
    public function setStreetNumber(string $streetNumber): Address
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLineOne(): string
    {
        return $this->lineOne;
    }

    /**
     * @param string $lineOne
     * @return Address
     */
    public function setLineOne(string $lineOne): Address
    {
        $this->lineOne = $lineOne;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @param string $county
     * @return Address
     */
    public function setCounty(string $county): Address
    {
        $this->county = $county;
        return $this;
    }


}