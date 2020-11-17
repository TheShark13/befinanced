<?php


namespace App\Service;


use App\Entity\CreditApplication;
use App\Entity\CreditType;
use App\Entity\User;

class CreditApplicationBuilder
{
    protected CreditApplication $creditApplication;

    public function __construct()
    {
        $this->creditApplication = CreditApplicationFactory::create();
    }

    public function setCreditType(CreditType $creditType): self
    {
        $this->creditApplication->setCreditType($creditType);

        return $this;
    }

    public function setFinancialData(int $sum, int $reimbursementPeriod): self
    {
        $this->creditApplication->getCreditApplicationInformations()->setAmountMoneyRequested($sum);
        $this->creditApplication->getCreditApplicationInformations()->setRepaymentPeriodRequested($reimbursementPeriod);

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->creditApplication->getCreditApplicationInformations()->setMessage($message);

        return $this;
    }

    public function setApplicant(User $user): self
    {
        $this->creditApplication->setApplicant($user);

        return $this;
    }

    public function getCreditApplication(): CreditApplication
    {
        return $this->creditApplication;
    }
}