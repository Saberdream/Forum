<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'	=> 'Ja',
	'no'	=> 'NEIN',
	'system_informations'	=> 'System Information',
	'system_modules'	=> 'System und Module',
	'php_functions'	=> 'PHP-Funktionen',
	'name'	=> 'Name',
	'value'	=> 'Wert',
	'site_configuration'	=> 'Site-Setup',
	'error_logs'	=> 'Fehlerprotokolle',
	'styles'	=> 'Stile',
);

$lang['system_modules'] = array(
	'php_version'	=> 'PHP-Version',
	'apache_version'	=> 'Apache-Version',
	'server_host'	=> 'Serverhost',
	'curl_support'	=> 'cURL-Unterstützung',
	'gd_support'	=> 'GD-Bibliotheksunterstützung',
	'mysql_support'	=> 'MySQL-Unterstützung',
	'mysqli_support'	=> 'MySQLi-Unterstützung',
	'pdo_support'	=> 'PDO-Unterstützung',
	'rewriting_support'	=> 'Unterstützung für das Umschreiben von URLs',
);
