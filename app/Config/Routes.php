<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('candidate', 'Candidate::index');
$routes->get('candidate/create', 'Candidate::create');
$routes->delete('candidate/delete/(:num)', 'Candidate::delete/$1');
