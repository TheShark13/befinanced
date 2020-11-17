<?php


namespace App\Controller;


use App\Repository\UserRepository;
use App\Service\AuthService;
use ChristianFramework\Controller\AbstractController;
use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\Response;

/**
 * Class AuthController
 * @package App\Controller
 */
class AuthController extends AbstractController
{
    public function login(Request $request): Response
    {
        if ("POST" === $request->getServerParams()->get('REQUEST_METHOD')) {
            $errors = [];
            if (!$request->get('email') || !$request->get('password')) {
                $errors = [
                    'email' => "Email necompletat",
                    'password' => "Parola necompletata"
                ];
            } else {
                $authService = new AuthService();
                try {
                    $authService->login($request->get('email'), $request->get('password'));
                } catch (\Exception $e) {
                    $errors['general'] = $e->getMessage();
                }
            }

            if (!empty($errors)) {
                return $this->runTemplate("dashboard/pages/auth.php", ['errors' => $errors]);
            } else {
                header("Location: /dashboard");
                die();
            }
        }
        return $this->runTemplate("dashboard/pages/auth.php");
    }

    public function logout(Request $request) {
        unset($_SESSION["user"]);
        header("Location: /");
    }
}