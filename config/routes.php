<?php

use App\Controller\DashboardController;
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
    ],
    [
        'path' => '/test',
        'controller' => HomeController::class,
        'method' => "GET",
        'function' => "test"
    ],
    [
        'path' => '/dashboard',
        'controller' => DashboardController::class,
        'method' => "GET",
        'function' => "index"
    ],
    [
        'path' => '/dashboard/applications',
        'controller' => DashboardController::class,
        'method' => "GET",
        'function' => "applications"
    ],
    [
        'path' => '/dashboard/applications/show',
        'controller' => DashboardController::class,
        'method' => "GET",
        'function' => "showApplication"
    ]
];