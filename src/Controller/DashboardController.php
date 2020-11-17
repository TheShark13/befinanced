<?php


namespace App\Controller;


use App\Repository\CreditApplicationRepository;
use App\Repository\FinancialInstitutionRepository;
use ChristianFramework\Controller\AbstractController;
use ChristianFramework\HttpModule\Exception\RouteNotFoundException;
use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\Response;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AbstractController
{
    public function index(Request $request): Response
    {
        return $this->runTemplate("dashboard/pages/dashboard.php");
    }

    public function applications(Request $request): Response
    {
        $creditApplicationRepo = new CreditApplicationRepository();
        $applications = $creditApplicationRepo->findApplicationsForUser(1);
        return $this->runTemplate("dashboard/pages/dashboard.php", [
            'applications' => $applications
        ]);
    }

    public function showApplication(Request $request): Response
    {
        $creditApplicationRepo = new CreditApplicationRepository();

        if (!$request->get('id')) {
            throw new RouteNotFoundException();
        }

        $application = $creditApplicationRepo->findOneApplication($request->get('id'));
        if (!$application) {
            throw new RouteNotFoundException();
        }

        $financialInstitutionRepo = new FinancialInstitutionRepository();
        $financialInstitutions = $financialInstitutionRepo->findFinancialInstitutionsForApplication($application->getId());

        return $this->runTemplate("dashboard/pages/application.php", [
            'application' => $application,
            'financialInstitutions' => $financialInstitutions
        ]);
    }
}