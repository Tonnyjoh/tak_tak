<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'User::index');

$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::register');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

//if (session()->get('isLoggedIn')) {
$routes->get('/user/dashboard/', 'User::dash/',['filter' => 'auth']);
$routes->get('/user/edit/', 'User::getUpdate/',['filter' => 'auth']);
$routes->post('/user/update/', 'User::update/',['filter' => 'auth']);
//}

if(session()->get('role') == 'admin'){
    $routes->get('/admin/dashboard', 'Admin::getAllDash');
    $routes->get('/admin/edit/(:segment)', 'Admin::getUpdate/$1');
    $routes->post('/admin/update/(:segment)', 'Admin::update/$1');
    $routes->get('/admin/delete/(:segment)', 'Admin::delete/$1');
    $routes->get('/admin/getFormCateg', 'Admin::getFormCateg');
    $routes->post('/admin/createCateg','Admin::createCateg');

    /*
        $routes->get('/admin/allAccounts', 'Admin::getAllAccounts');
        $routes->get('/admin/getUpAccount/(:num)', 'Admin::getAccount/$1');
        $routes->post('/admin/upAccount/(:num)', 'Admin::upAccount/$1');
        $routes->get('/admin/delAccount/(:num)','Admin::delAccount/$1');*/
}
if(session()->get('isLoggedIn') && session()->get('role') == 'client'){
    $routes->get('/item/create', 'Item::getFormCreate');
    $routes->post('/item/create', 'Item::create');
    $routes->post('/item/update/', 'Item::getFormUpdate');
    $routes->post('/item/update', 'Item::update');
    $routes->get('/item/delete/(:segment)', 'Item::delete/$1');
    $routes->get('/item/listItems', 'Item::getListItems');
    $routes->post('/item/exchange', 'Item::exchange');
    $routes->post('/item/filterListItems', 'Item::getListItems');

    $routes->get('/exchange/accept/(:segment)', 'Item::acceptExchange/$1');
    $routes->get('/exchange/decline/(:segment)', 'Item::declineExchange/$1');

}
/*$routes->get('/upload/send','Upload::send');
$routes->post('/upload/store', 'Upload::store');*/
/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
