<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tentang', 'Home::tentang');
$routes->get('login', 'Home::login');
$routes->get('support-protocol', 'Home::support');
$routes->get('recovery-protocol', 'Home::recovery');
$routes->get('documentation-protocol', 'Home::documentation');
$routes->get('katalog', 'Home::katalog');
$routes->get('map', 'Home::map'); 
$routes->get('db-check', 'DbCheck::index');

// API Routes
$routes->get('api/geojson', 'Api::geojson');
$routes->get('api/categories', 'Api::categories');
$routes->get('api/reviews/(:num)', 'Api::get_reviews/$1');
$routes->post('api/submit-review', 'Api::submit_review');
$routes->post('ai/chat', 'Api::ai_chat');
$routes->get('geojson/kota-sukabumi', 'Api::kotaSukabumi');
$routes->get('audio/jarjit', 'Assets::jarjit');

// Auth Routes
$routes->post('login/auth', 'Home::auth'); 
$routes->get('logout', 'Home::logout');

// Admin Routes (Pastikan mengarah ke Home controller sesuai isi file Home.php Anda)
$routes->get('admin', 'Home::admin_dashboard');
$routes->post('admin/save', 'Home::admin_save');
$routes->get('admin/delete/(:num)', 'Home::admin_delete/$1');
