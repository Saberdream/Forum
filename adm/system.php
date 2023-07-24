<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.$lang_path.'adm/system.php';

$system_modules = array(
	'php_version' => phpversion(),
	'apache_version' => apache_get_version(),
	'server_host' => $_SERVER['HTTP_HOST'],
	'curl_support' => extension_loaded('curl') ? $lang['system']['yes'] : $lang['system']['no'],
	'gd_support' => extension_loaded('gd') ? $lang['system']['yes'] : $lang['system']['no'],
	'mysql_support' => extension_loaded('mysql') ? $lang['system']['yes'] : $lang['system']['no'],
	'mysqli_support' => extension_loaded('mysqli') ? $lang['system']['yes'] : $lang['system']['no'],
	'pdo_support' => extension_loaded('pdo_mysql') ? $lang['system']['yes'] : $lang['system']['no'],
	'rewriting_support' => in_array('mod_rewrite', apache_get_modules()) ? $lang['system']['yes'] : $lang['system']['no'],
);

foreach($lang['system_modules'] as $key => $value) {
	$system_modules[$value] = $system_modules[$key];
	unset($system_modules[$key]);
}

unset($key, $value);

$functions = array(
	'allow_url_fopen' => ini_get('allow_url_fopen'),
	'file_uploads' => ini_get('file_uploads'),
	'max_file_uploads' => ini_get('max_file_uploads'),
	'post_max_size' => ini_get('post_max_size'),
	'max_execution_time' => ini_get('max_execution_time'),
	'max_file_uploads' => ini_get('max_file_uploads'),
	'memory_limit' => ini_get('memory_limit'),
	'upload_max_filesize' => ini_get('upload_max_filesize'),
	'max_input_time' => ini_get('max_input_time'),
);

ksort($functions);

$tpl->assign(array(
	'title' => $lang['system']['system_informations'],
	'system_modules' => $system_modules,
	'functions' => $functions,
	'lang_system' => $lang['system']
));

$tpl->draw('system');