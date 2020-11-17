<?php

use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\RunnableResponse;
use ChristianFramework\Kernel\Kernel;

require dirname(__DIR__) . '/config/bootstrap.php';

session_start();
if (!isset($_SESSION['user']) && stripos($_SERVER['REQUEST_URI'], 'dashboard')) {
    header('Location: /login');
    die();
}

$request = Request::createFromGlobals();

$kernel = new Kernel($request);
$response = $kernel->handle();
try {
    $response->send();
} catch (\ChristianFramework\HttpModule\Exception\NotFoundException $exception) {
    (new RunnableResponse("error_pages/404.php"))->send();
}
