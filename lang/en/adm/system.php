<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'	=> 'Yes',
	'no'	=> 'No',
	'system_informations'	=> 'System information',
	'system_modules'	=> 'System and modules',
	'php_functions'	=> 'PHP functions',
	'name'	=> 'Name',
	'value'	=> 'Value',
	'site_configuration'	=> 'Site setup',
	'error_logs'	=> 'Error logs',
	'styles'	=> 'Styles',
	'langs'	=> 'LANGUAGES',
);

$lang['system_modules'] = array(
	'php_version'	=> 'php version',
	'apache_version'	=> 'Apache version',
	'server_host'	=> 'Server Host',
	'curl_support'	=> 'cURL support',
	'gd_support'	=> 'GD library support',
	'mysql_support'	=> 'mysql support',
	'mysqli_support'	=> 'mysqli support',
	'pdo_support'	=> 'PDO support',
	'rewriting_support'	=> 'URL rewriting support',
);
