<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'	=> 'نعم',
	'no'	=> 'لا',
	'system_informations'	=> 'معلومات النظام',
	'system_modules'	=> 'النظام والوحدات النمطية',
	'php_functions'	=> 'وظائف php',
	'name'	=> 'اسم',
	'value'	=> 'قيمة',
	'site_configuration'	=> 'إعداد الموقع',
	'error_logs'	=> 'سجلات الخطأ',
	'styles'	=> 'الأنماط',
);

$lang['system_modules'] = array(
	'php_version'	=> 'نسخة PHP',
	'apache_version'	=> 'نسخة أباتشي',
	'server_host'	=> 'الخادم المضيف',
	'curl_support'	=> 'دعم cURL',
	'gd_support'	=> 'دعم مكتبة GD',
	'mysql_support'	=> 'دعم MySQL',
	'mysqli_support'	=> 'دعم mysqli',
	'pdo_support'	=> 'دعم PDO',
	'rewriting_support'	=> 'دعم إعادة كتابة URL',
);
