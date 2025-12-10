<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    // Use dashed URLs (example: /add-single)
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        /* -----------------------------------------
         * DEFAULT ROUTE → Login Page
         * ----------------------------------------- */
        $builder->connect('/', ['controller' => 'Users', 'action' => 'login']);

        /* -----------------------------------------
         * VISITOR ROUTES
         * ----------------------------------------- */
        $builder->connect('/visitors', ['controller' => 'Visitors', 'action' => 'index']);

        // Add Single Visitor
        $builder->connect('/visitors/add-single', ['controller' => 'Visitors', 'action' => 'addSingle']);

        // Add Group Visitor
        $builder->connect('/visitors/add-group', ['controller' => 'Visitors', 'action' => 'addGroup']);

        // View Visitor Details
        $builder->connect('/visitors/view/:id', 
            ['controller' => 'Visitors', 'action' => 'view']
        )->setPass(['id']);

        // Check-in
        $builder->connect('/visitors/check-in/:id', 
            ['controller' => 'Visitors', 'action' => 'checkIn']
        )->setPass(['id']);

        // Check-out
        $builder->connect('/visitors/check-out/:id', 
            ['controller' => 'Visitors', 'action' => 'checkOut']
        )->setPass(['id']);

        // Assign Batch
        $builder->connect('/visitors/assign-batch', 
            ['controller' => 'Visitors', 'action' => 'assignBatch']
        );

        /* -----------------------------------------
         * DASHBOARD ROUTE
         * ----------------------------------------- */
        $builder->connect('/dashboard/admin', 
            ['controller' => 'Dashboard', 'action' => 'admin']
        );

        /* -----------------------------------------
         * INVITE ROUTE
         * ----------------------------------------- */
        $builder->connect('/invite', 
            ['controller' => 'Visitors', 'action' => 'invite']
        );

        /* -----------------------------------------
         * FALLBACK ROUTES (auto controller/action)
         * ----------------------------------------- */
        $builder->fallbacks();
    });
};
