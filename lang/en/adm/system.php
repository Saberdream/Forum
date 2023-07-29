<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'			=> 'Yes',
	'no'			=> 'No',
	'system_informations'			=> 'System information',
	'system_modules'			=> 'System and modules',
	'php_functions'			=> 'php functions',
	'name'			=> 'Name',
	'value'			=> 'Value',
	'site_configuration'			=> 'Site Setup',
	'error_logs'			=> 'Error logs',
	'styles'			=> 'styles',
);

$lang['system_modules'] = array(
	'php_version'			=> 'PHP version',
	'apache_version'			=> 'Apache version',
	'server_host'			=> 'Server host',
	'curl_support'			=> 'cURL Support',
	'gd_support'			=> 'GD Library Support',
	'mysql_support'			=> 'mysql support',
	'mysqli_support'			=> 'mysqli support',
	'pdo_support'			=> 'PDO support',
	'rewriting_support'			=> 'URL rewrite support',
);
