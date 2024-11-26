<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboardView');

/** Dashboard routes */
$routes->get('/dashboard', 'Home::dashboardView');
