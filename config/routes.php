<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        // Home page
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        // Dashboard routes
        $builder->connect('/dashboard', ['controller' => 'Dashboard', 'action' => 'index']);
        
        // Admin routes
        $builder->connect('/admins/login', ['controller' => 'Admins', 'action' => 'login']);
        $builder->connect('/admins/signup', ['controller' => 'Admins', 'action' => 'signup']);
        $builder->connect('/admins/logout', ['controller' => 'Admins', 'action' => 'logout']);
        
        // Books routes
        $builder->connect('/books', ['controller' => 'Books', 'action' => 'index']);
        $builder->connect('/books/add', ['controller' => 'Books', 'action' => 'add']);
        $builder->connect('/books/edit/*', ['controller' => 'Books', 'action' => 'edit']);
        $builder->connect('/books/delete/*', ['controller' => 'Books', 'action' => 'delete']);

        // Allow other default routes
        $builder->fallbacks();
    });
};