<?php


namespace App\Controller;


use App\Repository\UserRepository;
use ChristianFramework\Controller\AbstractController;
use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    public function home(Request $request): Response
    {
        return $this->runTemplate("public/pages/homepage.phtml", [
            'name' => "Cristi"
        ]);
    }

    public function howWorks(Request $request): Response
    {
        return $this->runTemplate("public/pages/how-works.php", [
            'name' => "Cristi"
        ]);
    }

    public function test(Request $request): Response
    {
        $dbRepo = new UserRepository();

        dump($dbRepo->findOneById(1));
        exit;
    }
}