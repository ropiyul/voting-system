<?php

use CodeIgniter\Router\RouteCollection;
use \Myth\Auth\Config\Auth as AuthConfig;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Vote::index');
$routes->post('vote/save', 'Vote::saveVote');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('candidate', 'Candidate::index');
$routes->get('candidate/create', 'Candidate::create');
$routes->post('candidate/save', 'Candidate::save');
$routes->get('candidate/edit/(:num)', 'Candidate::edit/$1');
$routes->post('candidate/update/(:num)', 'Candidate::update/$1');
$routes->delete('candidate/delete/(:num)', 'Candidate::delete/$1');

$routes->get('voter', 'voter::index');
$routes->get('voter/create', 'voter::create');
$routes->post('voter/save', 'voter::save');
$routes->get('voter/edit/(:num)', 'voter::edit/$1');
$routes->post('voter/update/(:num)', 'voter::update/$1');
$routes->delete('voter/delete/(:num)', 'voter::delete/$1');

$routes->get('admin', 'Admin::index');
$routes->get('admin/create', 'Admin::create');
$routes->post('admin/save', 'Admin::save');
$routes->get('admin/edit/(:num)', 'Admin::edit/$1');
$routes->post('admin/update/(:num)', 'Admin::update/$1');
$routes->delete('admin/delete/(:num)', 'Admin::delete/$1');




// OVERRIDE AUTH ROUTES
$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    // Load the reserved routes from Auth.php
    $config         = config(AuthConfig::class);
    $reservedRoutes = $config->reservedRoutes;

    // Login/out
    $routes->get($reservedRoutes['login'], 'AuthController::login', ['as' => $reservedRoutes['login']]);
    $routes->post($reservedRoutes['login'], 'AuthController::attemptLogin');
    $routes->get($reservedRoutes['logout'], 'AuthController::logout');

    // Registration
    $routes->get($reservedRoutes['register'], 'AuthController::register', ['as' => $reservedRoutes['register']]);
    $routes->post($reservedRoutes['register'], 'AuthController::attemptRegister');

    // Activation
    $routes->get($reservedRoutes['activate-account'], 'AuthController::activateAccount', ['as' => $reservedRoutes['activate-account']]);
    $routes->get($reservedRoutes['resend-activate-account'], 'AuthController::resendActivateAccount', ['as' => $reservedRoutes['resend-activate-account']]);

    // Forgot/Resets
    $routes->get($reservedRoutes['forgot'], 'AuthController::forgotPassword', ['as' => $reservedRoutes['forgot']]);
    $routes->post($reservedRoutes['forgot'], 'AuthController::attemptForgot');
    $routes->get($reservedRoutes['reset-password'], 'AuthController::resetPassword', ['as' => $reservedRoutes['reset-password']]);
    $routes->post($reservedRoutes['reset-password'], 'AuthController::attemptReset');
});


