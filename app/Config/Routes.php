<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('candidate', 'Candidate::index');
$routes->get('candidate/create', 'Candidate::create');
$routes->post('candidate/save', 'Candidate::save');
$routes->get('candidate/edit/(:num)', 'Candidate::edit/$1');
$routes->post('candidate/update/(:num)', 'Candidate::update/$1');
$routes->delete('candidate/delete/(:num)', 'Candidate::delete/$1');
