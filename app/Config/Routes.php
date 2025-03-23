<?php

use App\Controllers\Admin;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('teater/getMitraSosmed/(:num)', 'Admin::getMitraSosmed/$1');
$routes->post('teater-sosmed/add', 'Admin::addSosmed');

$routes->post('Admin/approveMitra/(:num)', 'Admin::approveMitra/$1');
$routes->post('Admin/rejectMitra', 'Admin::rejectMitra');

$routes->get('Audiens/homepage', 'Audiens::homepage');

$routes->match(['GET', 'POST'], 'Audiens/registration', 'Audiens::register'); // untuk method register yang menangani form
$routes->match(['GET', 'POST'], 'MitraTeater/registration', 'MitraTeater::register');
$routes->get('Audiens/confirmation', 'Audiens::confirmation');

$routes->match(['GET', 'POST'], 'User/login', 'Login::login');
$routes->get('User/logout', 'Login::logout');

$routes->post('MitraTeater/cekStatus', 'MitraTeater::cekStatus');
$routes->get('MitraTeater/cekStatus', 'MitraTeater::cekStatus');
$routes->get('MitraTeater/cekStatusView', 'MitraTeater::cekStatusView');

$routes->get('Audiens/listPenampilan', 'Audiens::listPenampilan');
$routes->get('Audiens/listAudisi', 'Audiens::ListAudisi');

$routes->get('Audiens/homepageAudiens', 'Audiens::homepageAfterLogin');
$routes->get('Audiens/penampilanAudiens', 'Audiens::penampilanAfterLogin');
$routes->get('Audiens/detailPenampilan', 'Audiens::DetailPenampilan');
$routes->get('Audiens/audisiAudiens', 'Audiens::audisiAfterLogin');
$routes->get('Audiens/detailAudisiAktor', 'Audiens::DetailAudisiAktor');
$routes->get('Audiens/detailAudisiStaff', 'Audiens::DetailAudisiStaff');

$routes->get('Mitra/homepage', 'MitraTeater::homepageAfterLogin');

$routes->get('Admin/homepage', 'Admin::homepageAfterLogin');
$routes->get('Admin/listPenampilan', 'Admin::penampilan');
$routes->post('Admin/saveShow', 'Admin::saveShow');

$routes->get('teater/getApprovedMitra', 'Admin::getApprovedMitra');

$routes->get('Admin/listAudisi', 'Admin::audisi');
$routes->post('Admin/saveAuditionAktor', 'Admin::saveAuditionAktor');
$routes->post('Admin/saveAuditionStaff', 'Admin::saveAuditionStaff');
$routes->get('Admin/approveMitra', 'Admin::approveMitraList');

$routes->post('Admin/saveAuditionAdmin', 'Admin::saveAuditionAdmin');
$routes->post('Admin/updateAuditionAdmin/(:num)', 'Admin::updateAuditionAdmin/$1');
$routes->get('Admin/getTeaterData', 'Admin::getTeaterData');
$routes->delete('Admin/deleteSchedule', 'Admin::deleteSchedule');
$routes->delete('Admin/deleteWeb', 'Admin::deleteWeb');

$routes->get('Admin/profile', 'Admin::profile');
$routes->get('Admin/aboutUs', 'Admin::aboutUs');
$routes->get('Mitra/profile', 'MitraTeater::profile');
$routes->get('Audiens/profile', 'Audiens::profile');

