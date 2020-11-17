<?php


namespace App\Entity;


class CreditApplication extends BaseEntity
{
    public const STATUS_IN_WAITING = 0, STATUS_APPROVED = 1, STATUS_DECLINED = 2;
    public const STATUSES_LABELS = [
        self::STATUS_IN_WAITING => "In asteptare",
        self::STATUS_APPROVED => "Aprobat",
        self::STATUS_DECLINED => "Refuzat"
    ];

    protected User $applicant;
    protected int $status;
    protected CreditType $creditType;
    protected CreditApplicationInformations $creditApplicationInformations;

    /**
     * @return User
     */
    public function getApplicant(): User
    {
        return $this->applicant;
    }

    /**
     * @param User $applicant
     * @return CreditApplication
     */
    public function setApplicant(User $applicant): CreditApplication
    {
        $this->applicant = $applicant;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return CreditApplication
     */
    public function setStatus(int $status): CreditApplication
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return CreditType
     */
    public function getCreditType(): CreditType
    {
        return $this->creditType;
    }

    /**
     * @param CreditType $creditType
     * @return CreditApplication
     */
    public function setCreditType(CreditType $creditType): CreditApplication
    {
        $this->creditType = $creditType;
        return $this;
    }

    /**
     * @return CreditApplicationInformations
     */
    public function getCreditApplicationInformations(): CreditApplicationInformations
    {
        return $this->creditApplicationInformations;
    }

    /**
     * @param CreditApplicationInformations $creditApplicationInformations
     * @return CreditApplication
     */
    public function setCreditApplicationInformations(CreditApplicationInformations $creditApplicationInformations): CreditApplication
    {
        $this->creditApplicationInformations = $creditApplicationInformations;
        return $this;
    }


}