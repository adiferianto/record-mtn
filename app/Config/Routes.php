<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// USER
$routes->get('/users/add', 'Users::add');
$routes->get('/users/edit/(:segment)', 'Users::edit/$1');
$routes->delete('/users/(:num)', 'Users::delete/$1');
$routes->get('/users/(:any)', 'Users::details/$1');

// AIR SUMUR
$routes->get('/airSumur/add', 'AirSumur::add');
$routes->get('/airSumur/edit/(:segment)', 'AirSumur::edit/$1');
$routes->delete('/airSumur/(:num)', 'AirSumur::delete/$1');
$routes->get('/airSumur/(:any)', 'AirSumur::details/$1');

// AIR PRODUKSI
$routes->get('/airProduksi/add', 'AirProduksi::add');
$routes->get('/airProduksi/edit/(:segment)', 'AirProduksi::edit/$1');
$routes->delete('/airProduksi/(:num)', 'AirProduksi::delete/$1');
$routes->get('/airProduksi/(:any)', 'AirProduksi::details/$1');

// AIR PROSES
$routes->get('/airProses/add', 'AirProses::add');
$routes->get('/airProses/edit/(:segment)', 'AirProses::edit/$1');
$routes->delete('/airProses/(:num)', 'AirProses::delete/$1');
$routes->get('/airProses/(:any)', 'AirProses::details/$1');

// AIR BOILER
$routes->get('/airBoiler/add', 'AirBoiler::add');
$routes->get('/airBoiler/edit/(:segment)', 'AirBoiler::edit/$1');
$routes->delete('/airBoiler/(:num)', 'AirBoiler::delete/$1');
$routes->get('/airBoiler/(:any)', 'AirBoiler::details/$1');

// WWTP
$routes->get('/wwtp/add', 'Wwtp::add');
$routes->get('/wwtp/edit/(:segment)', 'Wwtp::edit/$1');
$routes->delete('/wwtp/(:num)', 'Wwtp::delete/$1');
$routes->get('/wwtp/(:any)', 'Wwtp::details/$1');

// GAS
$routes->get('/gas/add', 'Gas::add');
$routes->get('/gas/edit/(:segment)', 'Gas::edit/$1');
$routes->delete('/gas/(:num)', 'Gas::delete/$1');
$routes->get('/gas/(:any)', 'Gas::details/$1');

// KWH & LISTRIK
$routes->get('/kwh/add', 'Kwh::add');
$routes->get('/kwh/edit/(:segment)', 'Kwh::edit/$1');
$routes->delete('/kwh/(:num)', 'Kwh::delete/$1');
$routes->get('/kwh/(:any)', 'Kwh::details/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
