<?php

use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
$routes->get('create', 'UserController::create');
$routes->match(['get', 'post'], 'sign', 'UserController::signupuser');
// Admin routes
$routes->group("admin/", ["filter" => "auth"], function ($routes) {
    $routes->get("superuser", "Admin::index");
    $routes->get('createuser', 'Admin::createuser');
    $routes->match(['get', 'post'], 'adminuser', 'Admin::signuser');
    $routes->get('adminuseredit/(:num)', 'Admin::modifyuser/$1');
    $routes->post('updateuser', 'Admin::updateuser');
    $routes->get('delete/(:num)', 'Admin::deleteuser/$1');
});
// Editor routes
$routes->group("user/", ["filter" => "auth"], function ($routes) {
    $routes->get("user", "Edituser::index");
    $routes->get("editoruser", "Edituser::index");
    $routes->get('createuser', 'Edituser::createuser');
    $routes->match(['get', 'post'], 'addeditoruser', 'Edituser::adduser');
    $routes->get('editoruseredit/(:num)', 'Edituser::modifyuser/$1');
    $routes->post('editorupdateuser', 'Edituser::updateuser');
    $routes->get('editoruserdelete/(:num)', 'Edituser::deleteuser/$1');
});

$routes->group('otheruser', ['filter' => 'auth'], function ($routes) {
    $routes->get('display', 'Otheruser::index');
    $routes->get('adduser', 'Otheruser::adduser');
});
$routes->get('logout', 'UserController::logout');
