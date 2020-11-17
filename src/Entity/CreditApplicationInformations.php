<?php


namespace App\Entity;


class CreditApplicationInformations extends BaseEntity
{
    protected int $amountMoneyRequested;
    protected int $repaymentPeriodRequested;
    protected string $message;

    /**
     * @return int
     */
    public function getAmountMoneyRequested(): int
    {
        return $this->amountMoneyRequested;
    }

    /**
     * @param int $amountMoneyRequested
     * @return CreditApplicationInformations
     */
    public function setAmountMoneyRequested(int $amountMoneyRequested): CreditApplicationInformations
    {
        $this->amountMoneyRequested = $amountMoneyRequested;
        return $this;
    }

    /**
     * @return int
     */
    public function getRepaymentPeriodRequested(): int
    {
        return $this->repaymentPeriodRequested;
    }

    /**
     * @param int $repaymentPeriodRequested
     * @return CreditApplicationInformations
     */
    public function setRepaymentPeriodRequested(int $repaymentPeriodRequested): CreditApplicationInformations
    {
        $this->repaymentPeriodRequested = $repaymentPeriodRequested;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return CreditApplicationInformations
     */
    public function setMessage(string $message): CreditApplicationInformations
    {
        $this->message = $message;
        return $this;
    }


}