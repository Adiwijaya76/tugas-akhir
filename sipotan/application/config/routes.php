<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Login';
$route['404_override'] = 'Pagesystem';
$route['translate_uri_dashes'] = FALSE;

// Route Api
$route['api/v1/login'] = 'api/Login';
$route['api/v1/profil'] = 'api/Profil';

$route['api/v1/monitoring'] = 'api/Monitoring';
$route['api/v1/monitoring/tambah'] = 'api/Monitoring/tambah';
$route['api/v1/monitoring/detail'] = 'api/Monitoring/detail';
$route['api/v1/monitoring/update'] = 'api/Monitoring/update';
$route['api/v1/monitoring/delete'] = 'api/Monitoring/delete';

// lahan
$route['api/v1/lahan/list'] = 'api/Lahan/list';

// polatanam
$route['api/v1/polatanam/list'] = 'api/PolaTanam/list';

// unsurhara
$route['api/v1/unsurhara/list'] = 'api/UnsurHara/list';

//petani
$route['api/v1/getpropinsi'] = 'api/Petani/getpropinsi';
$route['api/v1/getkabupaten/(:any)'] = 'api/Petani/getkabupaten';
$route['api/v1/getkecamatan/(:any)'] = 'api/Petani/getkecamatan';
$route['api/v1/getdesa/(:any)'] = 'api/Petani/getdesa';
$route['api/v1/cari/(:any)'] = 'api/Petani/cari';

//crud
$route['api/v1/petani2'] = 'api/Petani2';








