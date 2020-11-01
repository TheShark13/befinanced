<?php


namespace App\Controller;


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
}