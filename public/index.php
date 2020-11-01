<?php

use ChristianFramework\HttpModule\Request;
use ChristianFramework\Kernel\Kernel;

require dirname(__DIR__) . '/config/bootstrap.php';

$request = Request::createFromGlobals();

$kernel = new Kernel($request);
$response = $kernel->handle();
$response->send();
