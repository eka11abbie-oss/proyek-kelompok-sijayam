<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================
// 1. GERBANG UTAMA (AUTENTIKASI)
// ==========================================
// Halaman pertama kali dibuka adalah Login
$routes->get('/', 'Auth::index'); 
$routes->post('/login/process', 'Auth::process'); 
$routes->get('/logout', 'Auth::logout'); 

// ==========================================
// 2. JALUR PELANGGAN (CUSTOMER)
// ==========================================
// Pendaftaran akun baru untuk pelanggan
$routes->get('/customer/register', 'CustomerAuth::register');
$routes->post('/customer/register/process', 'CustomerAuth::processRegister');

// Halaman Menu (Hanya bisa diakses setelah login sebagai Customer)
$routes->get('/menu', 'Home::index');

// Alur Belanja & Pelacakan
$routes->get('/checkout', 'Checkout::index');
$routes->post('/checkout/process', 'Checkout::process');
$routes->get('/customer/orders', 'Customer::orders');

// ==========================================
// 3. JALUR ADMIN (DASHBOARD)
// ==========================================
// Kelola Data Menu Makanan (CRUD)
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/create', 'Dashboard::create');
$routes->post('/dashboard/store', 'Dashboard::store');
$routes->get('/dashboard/edit/(:num)', 'Dashboard::edit/$1');
$routes->post('/dashboard/update/(:num)', 'Dashboard::update/$1');
$routes->get('/dashboard/delete/(:num)', 'Dashboard::delete/$1');

// Kelola Status Pesanan Masuk
$routes->get('/dashboard/orders', 'Dashboard::orders');
$routes->post('/dashboard/orders/update/(:num)', 'Dashboard::updateOrderStatus/$1');