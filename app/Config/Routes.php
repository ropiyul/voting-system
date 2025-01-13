<?php

use CodeIgniter\Router\RouteCollection;
use \Myth\Auth\Config\Auth as AuthConfig;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Vote::index', ['filter' => 'role:voter']);
$routes->post('vote/save', 'Vote::saveVote', ['filter' => 'role:admin,voter']);

$routes->get('dashboard', 'Home::dashboard', ['filter' => 'role:admin,voter']);
$routes->get('report', 'Report::index', ['filter' => 'role:admin,voter']);
$routes->get('dashboard/getStatisticsByGrade/(:any)', 'Home::getStatisticsByGrade/$1');

$routes->get('candidate', 'Candidate::index', ['filter' => 'role:admin']);
$routes->get('candidate/create', 'Candidate::create', ['filter' => 'role:admin']);
$routes->post('candidate/save', 'Candidate::save', ['filter' => 'role:admin']);
$routes->post('candidate/upload', 'Candidate::upload', ['filter' => 'role:admin']);
$routes->post('candidate/upload_temp', 'Candidate::upload_temp', ['filter' => 'role:admin']);
$routes->delete('candidate/remove_temp', 'Candidate::remove_temp', ['filter' => 'role:admin']);
$routes->post('candidate/remove_temp1', 'Candidate::remove_temp1', ['filter' => 'role:admin']);
$routes->get('candidate/get_uploaded_image/(:num)', 'Candidate::get_uploaded_image/$1', ['filter' => 'role:admin']);
$routes->get('candidate/edit/(:num)', 'Candidate::edit/$1', ['filter' => 'role:admin']);
$routes->post('candidate/update/(:num)', 'Candidate::update/$1', ['filter' => 'role:admin']);
$routes->delete('candidate/delete/(:num)', 'Candidate::delete/$1', ['filter' => 'role:admin']);

$routes->get('voter', 'voter::index', ['filter' => 'role:admin']);
$routes->get('voter/create', 'voter::create', ['filter' => 'role:admin']);
$routes->post('voter/save', 'voter::save', ['filter' => 'role:admin']);
$routes->get('voter/edit/(:num)', 'voter::edit/$1', ['filter' => 'role:admin']);
$routes->post('voter/update/(:num)', 'voter::update/$1', ['filter' => 'role:admin']);
$routes->delete('voter/delete/(:num)', 'voter::delete/$1', ['filter' => 'role:admin']);

$routes->get('admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('admin/create', 'Admin::create', ['filter' => 'role:admin']);
$routes->post('admin/save', 'Admin::save', ['filter' => 'role:admin']);
$routes->get('admin/edit/(:num)', 'Admin::edit/$1', ['filter' => 'role:admin']);
$routes->post('admin/update/(:num)', 'Admin::update/$1', ['filter' => 'role:admin']);
$routes->delete('admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role:admin']);

$routes->get('period', 'Period::index', ['filter' => 'role:admin']);
$routes->get('period/create', 'Period::create', ['filter' => 'role:admin']);
$routes->post('period/save', 'Period::save', ['filter' => 'role:admin']);
$routes->get('period/edit/(:num)', 'Period::edit/$1', ['filter' => 'role:admin']);
$routes->post('period/update/(:num)', 'Period::update/$1', ['filter' => 'role:admin']);
$routes->delete('period/delete/(:num)', 'Period::delete/$1', ['filter' => 'role:admin']);

$routes->get('grade', 'Grade::index', ['filter' => 'role:admin']);
$routes->get('grade/create', 'Grade::create', ['filter' => 'role:admin']);
$routes->post('grade/save', 'Grade::save', ['filter' => 'role:admin']);
$routes->get('grade/edit/(:num)', 'Grade::edit/$1', ['filter' => 'role:admin']);
$routes->post('grade/update/(:num)', 'Grade::update/$1', ['filter' => 'role:admin']);
$routes->delete('grade/delete/(:num)', 'Grade::delete/$1', ['filter' => 'role:admin']);

$routes->get('program', 'Program::index', ['filter' => 'role:admin']);
$routes->get('program/create', 'Program::create', ['filter' => 'role:admin']);
$routes->post('program/save', 'Program::save', ['filter' => 'role:admin']);
$routes->get('program/edit/(:num)', 'Program::edit/$1', ['filter' => 'role:admin']);
$routes->post('program/update/(:num)', 'Program::update/$1', ['filter' => 'role:admin']);
$routes->delete('program/delete/(:num)', 'Program::delete/$1', ['filter' => 'role:admin']);




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


