<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['base_url'] = 'http://localhost/inventaris_ti-main';
$config['index_page'] = 'index.php';
$config['encryption_key'] = 'your_encryption_key_here';
$config['sess_save_path'] = sys_get_temp_dir();
$config['csrf_protection'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['composer_autoload'] = FALSE;
