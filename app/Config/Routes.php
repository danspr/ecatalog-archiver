<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboardView');

/** Auth routes */
$routes->get('/login', 'Auth::loginView');
$routes->get('/logout', 'Auth::logout');

/** Dashboard routes */
$routes->get('/dashboard', 'Home::dashboardView');

/** Report routes */
$routes->get('/report', 'Report::index');

/** Activity routes */
$routes->get('/sirup', 'Sirup::index');

/** User routes */
$routes->get('/user', 'User::index');

/** Activity routes */
$routes->get('/activity', 'Activity::index');

/**
 * API routes
 */
$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    /** Auth */
    $routes->group('auth', static function ($routes) {
        $routes->post('signin', 'Auth::signin');
        $routes->post('signout', 'Auth::signout');
        $routes->post('password', 'Auth::getPassword');
    });

     /** User */
     $routes->group('user', static function ($routes) {
        $routes->get('list', 'User::getUserList');
        $routes->get('detail', 'User::getUserDetail');
        $routes->post('update', 'User::updateUser');
        $routes->post('insert', 'User::insertUser');
        $routes->post('delete', 'User::deleteUser');
        $routes->post('change-password', 'User::changePassword');
        $routes->post('current-user', 'User::getCurrentUser');
    });

    /** Report */
    $routes->group('report', static function ($routes) {
        $routes->get('list', 'Report::getReportList');
        $routes->get('paket-list', 'Report::getNamaPaket');
        $routes->post('export', 'Report::exportToExcel');
        $routes->get('(:num)/download', 'Report::downloadFile/$1');
    });

     /** Scrapping */
     $routes->group('scrap', static function ($routes) {
        $routes->get('now', 'Scrapping::pdfScapper');
    });

     /** Dashboard */
     $routes->group('dashboard', static function ($routes) {
        $routes->get('total-records', 'Dashboard::getTotalRecords');
        $routes->get('overview/(:any)', 'Dashboard::getOverview/$1');
        $routes->get('activity', 'Dashboard::getRecentActivity/$1');
    });

    /** Activity Log */
    $routes->group('activity', static function ($routes) {
        $routes->get('list', 'ActivityLog::getActivityLog');
    });

    /** Activity Log */
    $routes->group('sirup', static function ($routes) {
        $routes->post('export', 'Sirup::exportToExcel');
        $routes->get('(:num)/download', 'Report::downloadFile/$1');
    });
});