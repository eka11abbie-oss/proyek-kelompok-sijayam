<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

// Jika Anda ingin route lain (misal: /menu)
$routes->get('menu', 'Menu::index');
$routes->get('cart', 'Cart::index');
$routes->get('cart/add/(:num)', 'Cart::add/$1');
$routes->get('admin', 'Admin::index');
$routes->post('admin/save', 'Admin::save');