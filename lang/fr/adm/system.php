<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system
*/
$lang['system'] = array (
	'yes'						=> 'Oui',
	'no'						=> 'Non',
	'system_informations'		=> 'Informations système',
	'system_modules'			=> 'Système et modules',
	'php_functions'				=> 'Fonctions de php',
	'name'						=> 'Nom',
	'value'						=> 'Valeur',
	
	// left menu
	'site_configuration'		=> 'Configuration du site',
	'error_logs'				=> 'Logs des erreurs',
);

/*
 * system modules
*/
$lang['system_modules'] = array(
	'php_version'				=> 'Version de php',
	'apache_version'			=> 'Version d\'Apache',
	'server_host'				=> 'Hôte du serveur',
	'curl_support'				=> 'Support de cURL',
	'gd_support'				=> 'Support de la bibliothèque GD',
	'mysql_support'				=> 'Support de mysql',
	'mysqli_support'			=> 'Support de mysqli',
	'pdo_support'				=> 'Support de PDO',
	'rewriting_support'			=> 'Support de la réécriture d\'url',
);
