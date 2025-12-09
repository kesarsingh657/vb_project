<?php
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass('DashedRoute');

    $routes->scope('/', function (RouteBuilder $builder) {
        // Home page
        $builder->connect('/', ['controller' => 'Users', 'action' => 'login']);
        
        // Users
        $builder->connect('/users/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/users/logout', ['controller' => 'Users', 'action' => 'logout']);
        
        // Admin
        $builder->connect('/admin/dashboard', ['controller' => 'Admin', 'action' => 'dashboard']);
        
        // Security
        $builder->connect('/security/dashboard', ['controller' => 'Security', 'action' => 'dashboard']);
        
        // Employee
        $builder->connect('/employee/dashboard', ['controller' => 'Employee', 'action' => 'dashboard']);
        
        // Fallback routes
        $builder->fallbacks();
    });
};