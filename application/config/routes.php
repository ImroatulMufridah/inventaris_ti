<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Define routes for each controller
$route['user'] = 'user/index';
$route['barang'] = 'barang/index';
$route['laporan'] = 'laporan/index';
$route['kirim_email'] = 'kirim_email/index';
