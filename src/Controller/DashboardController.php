<?php


namespace App\Controller;


use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CreditApplicationRepository;
use App\Repository\CreditTypeRepository;
use App\Repository\FinancialInstitutionRepository;
use App\Repository\UserRepository;
use App\Service\CreditApplicationService;
use App\Service\PdfMaker;
use ChristianFramework\Controller\AbstractController;
use ChristianFramework\HttpModule\Exception\RouteNotFoundException;
use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\Response;
use MySqlCommunicator\Database\DatabaseConnection;

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

    public function users(Request $request): Response
    {
        $usersRepo = new UserRepository();
        $users = $usersRepo->findAll();
        $creditApplicationRepo = new CreditApplicationRepository();
        $usersApplicationsMap = [];
        foreach ($users as $user) {
            $applications = $creditApplicationRepo->findApplicationsForUser($user->getId());
            $usersApplicationsMap[$user->getId()] = $applications;
        }
        return $this->runTemplate("dashboard/pages/users.php", [
            'users' => $users,
            'usersApplicationsMap' => $usersApplicationsMap
        ]);
    }

    public function userForm(Request $request): Response
    {
        $userRepo = new UserRepository();
        if ($request->get('id')) {
            $user = $userRepo->findUserById($request->get('id'));
        } else {
            $user = new User();
        }
        if ("POST" === $request->getServerParams()->get('REQUEST_METHOD')) {
            if ($request->get('password') && strlen($request->get('password'))) {
                $user->setPassword($user->hashPassword($request->get('password')));
            }
            if ($request->get('email') && strlen($request->get('email'))) {
                $user->setEmail($request->get('email'));
            }
            if ($request->get('role') && strlen($request->get('role'))) {
                $role = $userRepo->findRoleById($request->get('role'));
                $user->setRole($role);
            }
            if (!$user->getUserProfile()) {
                $user->setUserProfile(new UserProfile());
                $user->getUserProfile()->setCreated(new \DateTime());
                $user->getUserProfile()->setUpdated(new \DateTime());
            }
            if ($request->get('first_name') && strlen($request->get('first_name'))) {
                $user->getUserProfile()->setFirstName($request->get('first_name'));
            }
            if ($request->get('last_name') && strlen($request->get('last_name'))) {
                $user->getUserProfile()->setLastName($request->get('last_name'));
            }
            if ($request->get('phone') && strlen($request->get('phone'))) {
                $user->getUserProfile()->setPhoneNumber($request->get('phone'));
            }
            if ($request->get('nin') && strlen($request->get('nin'))) {
                $user->getUserProfile()->setNin($request->get('nin'));
            }
            if ($user->getId()) {
                $userRepo->update($user);
            } else {
                $userRepo->insert($user);
            }

            header("Location: /dashboard/users");
            die;
        }

        return $this->runTemplate("dashboard/pages/user_form.php", [
            'user' => $user,
            'userRoles' => $userRepo->findAllRoles()
        ]);
    }

    public function deleteUser(Request $request): Response
    {
        $usersRepo = new UserRepository();

        $user = $usersRepo->findUserById(intval($request->get('id')));
        if ($user) {
            $creditApplicationRepo = new CreditApplicationRepository();
            if (count($creditApplicationRepo->findApplicationsForUser($user->getId()))) {
                throw new \Exception("Nu putem sterge un utilizator cu aplicari inregistrate");
            }
            $usersRepo->deleteUser($user);
        } else {
            return new Response("Userul nu a fost gasit");
        }

        header("Location: /dashboard/users");
        die;
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

    public function pdfApplications(Request $request)
    {
        $creditApplicationRepo = new CreditApplicationRepository();
        $applications = $creditApplicationRepo->findApplicationsForUser($_SESSION['user']->getId());

        $sql = 'SELECT * FROM address';

        $dbConn = DatabaseConnection::getConnection();
        $stmt = $dbConn->prepare('SELECT * FROM address');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $pdf = new PdfMaker();
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage();
        $pdf->getTableDynamic($result);
        $pdf->Output();
    }
}