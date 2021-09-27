<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Siswa');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Siswa::index');
$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');
$routes->post('/store_register', 'Auth::store_register');
$routes->post('/store_login', 'Auth::store_login');
  $routes->get('/logout', 'Auth::logout');

$routes->group('admin', function($routes) {
  $routes->get('/', 'Admin::index', ['filter' => 'login']);
  $routes->post('cari_siswa', 'Admin::cari_siswa', ['filter' => 'login']);
  $routes->get('mapel', 'Admin::mapel', ['filter' => 'login']);
  $routes->get('tipe_ujian', 'Admin::tipe_ujian', ['filter' => 'login']);
  $routes->get('data_kelas', 'Admin::data_kelas', ['filter' => 'login']);
  $routes->get('data_sekolah', 'Admin::data_sekolah', ['filter' => 'login']);
  $routes->get('detail_siswa', 'Admin::detail_siswa', ['filter' => 'login']);
  $routes->get('create_kelas', 'Admin::create_kelas', ['filter' => 'login']);
  $routes->post('store_kelas', 'Admin::store_kelas', ['filter' => 'login']);
  $routes->get('edit_kelas', 'Admin::edit_kelas', ['filter' => 'login']);
  $routes->post('update_kelas', 'Admin::update_kelas', ['filter' => 'login']);
  $routes->post('hapus_kelas', 'Admin::hapus_kelas', ['filter' => 'login']);
  $routes->get('tambah_mapel', 'Admin::tambah_mapel', ['filter' => 'login']);
  $routes->post('store_mapel', 'Admin::store_mapel', ['filter' => 'login']);
  $routes->get('edit_mapel', 'Admin::edit_mapel', ['filter' => 'login']);
  $routes->post('update_mapel', 'Admin::update_mapel', ['filter' => 'login']);
  $routes->post('hapus_mapel', 'Admin::hapus_mapel', ['filter' => 'login']);
  $routes->post('update_sekolah', 'Admin::update_sekolah', ['filter' => 'login']);
  $routes->get('tambah_tipe_ujian', 'Admin::tambah_tipe_ujian', ['filter' => 'login']);
  $routes->post('store_tipe_ujian', 'Admin::store_tipe_ujian', ['filter' => 'login']);
  $routes->get('edit_tipe_ujian', 'Admin::edit_tipe_ujian', ['filter' => 'login']);
  $routes->post('update_tipe_ujian', 'Admin::update_tipe_ujian', ['filter' => 'login']);
  $routes->post('hapus_tipe_ujian', 'Admin::hapus_tipe_ujian', ['filter' => 'login']);
  $routes->get('tambah_siswa', 'Admin::tambah_siswa', ['filter' => 'login']);
  $routes->post('store_siswa', 'Admin::store_siswa', ['filter' => 'login']);
  $routes->get('edit_siswa', 'Admin::edit_siswa', ['filter' => 'login']);
  $routes->post('update_siswa', 'Admin::update_siswa', ['filter' => 'login']);
  $routes->post('hapus_siswa', 'Admin::hapus_siswa', ['filter' => 'login']);
  $routes->get('tambah_raport', 'Admin::tambah_raport', ['filter' => 'login']);
  $routes->post('store_raport', 'Admin::store_raport', ['filter' => 'login']);
  $routes->post('hapus_raport', 'Admin::hapus_raport', ['filter' => 'login']);

});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
