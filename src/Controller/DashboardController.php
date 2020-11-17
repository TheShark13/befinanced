<?php


namespace App\Controller;


use App\Repository\CreditApplicationRepository;
use ChristianFramework\Controller\AbstractController;
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
}