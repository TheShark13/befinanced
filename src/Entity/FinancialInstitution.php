<?php


namespace App\Entity;


class FinancialInstitution extends BaseEntity
{
    public const TYPE_BANK = 0, TYPE_IFN = 1;
    public const TYPES_LABELS = [
        self::TYPE_BANK => "Banca",
        self::TYPE_IFN => "IFN"
    ];

    protected string $name;
    protected int $type;
    protected Address $address;
    protected ?FinancialInstitutionLegalInformations $financialInstitutionLegalInformations;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FinancialInstitution
     */
    public function setName(string $name): FinancialInstitution
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return FinancialInstitution
     */
    public function setType(int $type): FinancialInstitution
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return FinancialInstitution
     */
    public function setAddress(Address $address): FinancialInstitution
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return FinancialInstitutionLegalInformations|null
     */
    public function getFinancialInstitutionLegalInformations(): ?FinancialInstitutionLegalInformations
    {
        return $this->financialInstitutionLegalInformations;
    }

    /**
     * @param FinancialInstitutionLegalInformations|null $financialInstitutionLegalInformations
     * @return FinancialInstitution
     */
    public function setFinancialInstitutionLegalInformations(?FinancialInstitutionLegalInformations $financialInstitutionLegalInformations): FinancialInstitution
    {
        $this->financialInstitutionLegalInformations = $financialInstitutionLegalInformations;
        return $this;
    }


}