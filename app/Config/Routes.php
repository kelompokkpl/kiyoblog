<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Customers');
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
$routes->get('/', 'Reader::index');
$routes->add('admin','Admin::index');
$routes->add('penulis','Penulis::index');

// admin
$routes->add('admin/kategori','Kategori::index');
$routes->add('admin/kategori/save','Kategori::saveKategori');
$routes->add('admin/kategori/update/(:num)','Kategori::updateKategori/$1');
$routes->add('admin/kategori/save/(:num)','Kategori::saveKategori/$1');
$routes->add('admin/kategori/delete/(:num)','Kategori::deleteKategori/$1');
$routes->add('admin/daftar_post','Post::index');
$routes->add('admin/daftar_post/(:num)','Post::postCategory/$1');
$routes->add('admin/rekap_post','Post::rekap');
$routes->add('admin/detail_post/(:num)','Post::detailPost/$1');
$routes->add('admin/reset_penulis','ReqReset::getRequest');
$routes->add('admin/reset_penulis/send/(:num)/(:any)','ReqReset::sendEmail/$1/$2');
$routes->add('admin/edit_profile','Admin::editProfile');
$routes->add('admin/update_password','Admin::editPassword');

// penulis
$routes->add('penulis/edit_profile','Penulis::editProfile');
$routes->add('penulis/update_password','Penulis::editPassword');
$routes->add('penulis/add_post','Post::addPost');
$routes->add('penulis/my_post','Post::getPosting');
$routes->add('penulis/detail_post/(:num)','Post::detailPostPen/$1');
$routes->add('penulis/edit_post/(:num)','Post::editPost/$1');
$routes->add('post/delete/(:num)/(:any)','Post::deletePost/$1/$2');
$routes->add('penulis/forgot_password','Penulis::forgotPassword');
$routes->add('penulis/request_success','Penulis::requestSuccess');
$routes->add('penulis/ReqReset/addRequest','ReqReset::addRequest');

// reader
$routes->add('article/(:any)','Reader::viewPost/$1');
$routes->add('category/(:any)','Reader::category/$1');
$routes->add('writer/(:num)','Reader::writer/$1');
$routes->add('contact/','Reader::contact');
$routes->add('about/','Reader::about');
$routes->add('Reader/searchAjax','Reader::searchAjax');
$routes->add('new/','Reader::new');


// RESTful API
$routes->get('api/','PostRest::showAll');
$routes->get('api/recent','PostRest::showRecent');
$routes->get('api/kategori','PostRest::getKategori');
$routes->get('api/kategori/(:segment)','PostRest::showByCategory/$1');
$routes->get('api/(:segment)','PostRest::showDetail/$1');
$routes->get('api/komentar/(:segment)','PostRest::getComments/$1');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
