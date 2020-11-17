<?php


namespace App\Entity;


class FinancialInstitutionLegalInformations extends BaseEntity
{
    protected ?string $legalEntityIdentifier;
    protected ?string $chamberCommerceRegistrationNumber;
    protected ?string $iban;
    protected ?string $entityPrimaryBankName;

    /**
     * @return string|null
     */
    public function getLegalEntityIdentifier(): ?string
    {
        return $this->legalEntityIdentifier;
    }

    /**
     * @param string|null $legalEntityIdentifier
     * @return FinancialInstitutionLegalInformations
     */
    public function setLegalEntityIdentifier(?string $legalEntityIdentifier): FinancialInstitutionLegalInformations
    {
        $this->legalEntityIdentifier = $legalEntityIdentifier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChamberCommerceRegistrationNumber(): ?string
    {
        return $this->chamberCommerceRegistrationNumber;
    }

    /**
     * @param string|null $chamberCommerceRegistrationNumber
     * @return FinancialInstitutionLegalInformations
     */
    public function setChamberCommerceRegistrationNumber(?string $chamberCommerceRegistrationNumber): FinancialInstitutionLegalInformations
    {
        $this->chamberCommerceRegistrationNumber = $chamberCommerceRegistrationNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param string|null $iban
     * @return FinancialInstitutionLegalInformations
     */
    public function setIban(?string $iban): FinancialInstitutionLegalInformations
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntityPrimaryBankName(): ?string
    {
        return $this->entityPrimaryBankName;
    }

    /**
     * @param string|null $entityPrimaryBankName
     * @return FinancialInstitutionLegalInformations
     */
    public function setEntityPrimaryBankName(?string $entityPrimaryBankName): FinancialInstitutionLegalInformations
    {
        $this->entityPrimaryBankName = $entityPrimaryBankName;
        return $this;
    }


}