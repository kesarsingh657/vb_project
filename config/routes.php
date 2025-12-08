<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {

    $routes->setRouteClass(DashedRoute::class);

    // Default homepage → login
    $routes->connect('/', [
        'controller' => 'Users',
        'action' => 'login'
    ]);

    // Admin dashboard
    $routes->connect('/admin', [
        'controller' => 'Admin',
        'action' => 'dashboard'
    ]);
    $routes->connect('/admin/dashboard', [
        'controller' => 'Admin',
        'action' => 'dashboard'
    ]);

    // Security dashboard
    $routes->connect('/security', [
        'controller' => 'Security',
        'action' => 'dashboard'
    ]);
    $routes->connect('/security/dashboard', [
        'controller' => 'Security',
        'action' => 'dashboard'
    ]);

    // Employee dashboard
    $routes->connect('/employee', [
        'controller' => 'Employee',
        'action' => 'dashboard'
    ]);
    $routes->connect('/employee/dashboard', [
        'controller' => 'Employee',
        'action' => 'dashboard'
    ]);

    // Fallback routes
    $routes->fallbacks(DashedRoute::class);
};
