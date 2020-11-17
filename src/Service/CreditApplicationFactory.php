<?php


namespace App\Service;


use App\Entity\CreditApplication;
use App\Entity\CreditApplicationInformations;
use App\Entity\CreditType;

class CreditApplicationFactory
{
    public static function create(): CreditApplication
    {
        $creditApplication = new CreditApplication();
        $creditApplication->setCreditApplicationInformations(new CreditApplicationInformations());
        $creditApplication->getCreditApplicationInformations()->setCreated(new \DateTime());
        $creditApplication->getCreditApplicationInformations()->setUpdated(new \DateTime());
        $creditApplication->setStatus(CreditApplication::STATUS_IN_WAITING);
        $creditApplication->setCreated(new \DateTime());
        $creditApplication->setUpdated(new \DateTime());

        return $creditApplication;
    }
}