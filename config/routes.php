<?php

use App\Controller\AuthController;
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
    ],
    [
        'path' => '/login',
        'controller' => AuthController::class,
        'method' => ["GET", "POST"],
        'function' => "login"
    ],
    [
        'path' => '/logout',
        'controller' => AuthController::class,
        'method' => ["GET"],
        'function' => "logout"
    ],
    [
        'path' => '/dashboard/apply-credit',
        'controller' => DashboardController::class,
        'method' => ["GET"],
        'function' => "applyCredit"
    ],
    [
        'path' => '/dashboard/register-application',
        'controller' => DashboardController::class,
        'method' => ["POST"],
        'function' => "registerApplication"
    ],
    [
        'path' => '/dashboard/users',
        'controller' => DashboardController::class,
        'method' => ["GET"],
        'function' => "users"
    ],
    [
        'path' => '/dashboard/users/delete',
        'controller' => DashboardController::class,
        'method' => ["GET"],
        'function' => "deleteUser"
    ],
    [
        'path' => '/dashboard/users/form',
        'controller' => DashboardController::class,
        'method' => ["GET", "POST"],
        'function' => "userForm"
    ],
];