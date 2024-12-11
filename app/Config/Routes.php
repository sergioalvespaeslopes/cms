<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function() {
    return redirect()->to('/login');
});

$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/register', 'Auth::register', ['as' => 'register']);
    $routes->post('/register', 'Auth::registerProcess');
    $routes->get('/login', 'Auth::login', ['as' => 'login']);
    $routes->post('/login', 'Auth::loginProcess');
    $routes->get('/logout', 'Auth::logout', ['as' => 'logout']);
    
    $routes->group('dashboard', ['filter' => 'auth'], function($routes) {
        $routes->get('', 'Dashboard::index', ['as' => 'dashboard']);
    });
    
    $routes->group('clients', ['filter' => 'auth'], function($routes) {
        $routes->get('', 'Clients::index', ['as' => 'clients']);
        $routes->get('create', 'Clients::create', ['as' => 'create_client']);
        $routes->post('', 'Clients::store');
        $routes->get('edit/(:num)', 'Clients::edit/$1', ['as' => 'edit_client']);
        $routes->post('update/(:num)', 'Clients::update/$1');
        $routes->get('delete/(:num)', 'Clients::delete/$1', ['as' => 'delete_client']);
    });
});
