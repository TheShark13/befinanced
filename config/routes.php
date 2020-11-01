<?php

use App\Controller\HomeController;

$routes = [
    [
        'path' => '/',
        'controller' => HomeController::class,
        'method' => "GET",
        'function' => "home"
    ],
    [
        'path' => '/how-works',
        'controller' => HomeController::class,
        'method' => "GET",
        'function' => "howWorks"
    ]
];