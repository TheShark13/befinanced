<?php


namespace App\Service;


use App\Entity\CreditApplication;
use App\Repository\CreditApplicationRepository;

class CreditApplicationService
{
    protected CreditApplicationRepository $creditApplicationRepository;

    public function __construct()
    {
        $this->creditApplicationRepository = new CreditApplicationRepository();
    }

    public function createNewApplication(array $data): CreditApplication
    {
        $creditApplication = (new CreditApplicationBuilder())
            ->setCreditType($data['credit_type'])
            ->setFinancialData($data['sum'], $data['reimbursement_period'])
            ->setMessage($data['message'])
            ->setApplicant($data['user'])
            ->getCreditApplication();

        return $this->creditApplicationRepository->persist($creditApplication, $data['financial_institutions']);
    }
}