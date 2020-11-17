<?php


namespace App\Controller;


use App\Repository\CreditApplicationRepository;
use App\Repository\CreditTypeRepository;
use App\Repository\FinancialInstitutionRepository;
use App\Service\CreditApplicationService;
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
        $applications = $creditApplicationRepo->findApplicationsForUser($_SESSION['user']->getId());
        return $this->runTemplate("dashboard/pages/applications.php", [
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

    public function applyCredit(Request $request): Response
    {
        $creditTypesRepo = new CreditTypeRepository();
        $financialInstitutionRepo = new FinancialInstitutionRepository();

        return $this->runTemplate("dashboard/pages/credit_type.php", [
            'creditTypes' => $creditTypesRepo->findAll(),
            'financialInstitutions' => $financialInstitutionRepo->findAll()
        ]);
    }

    public function registerApplication(Request $request): Response
    {
        $creditTypesRepo = new CreditTypeRepository();
        $financialInstitutionRepo = new FinancialInstitutionRepository();

        $creditType = $creditTypesRepo->findOne(intval($request->get('credit_type')));
        if (!$creditType) {
            echo "Tip credit invalid";
            die;
        }
        if (!$request->get('sum') || !$request->get('reimbursement_period') || !$request->get('message')) {
            echo "Campuri invalide";
            die;
        }
        if (!$request->get('financial_institutions')) {
            echo "Nu ai selectat minim 1 institutie financiara";
            die;
        }
        $data = [
            'user' => $_SESSION['user'],
            'credit_type' => $creditType,
            'sum' => $request->get('sum'),
            'reimbursement_period' => $request->get('reimbursement_period'),
            'message' => $request->get('message'),
            'financial_institutions' => $request->get('financial_institutions')
        ];
        $creditApplicationService = new CreditApplicationService();
        $creditApplicationService->createNewApplication($data);

        header("Location: /dashboard/applications");
        die;
    }
}