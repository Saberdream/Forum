<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'	=> 'Sí',
	'no'	=> 'No',
	'system_informations'	=> 'Información del sistema',
	'system_modules'	=> 'Sistema y módulos',
	'php_functions'	=> 'funciones php',
	'name'	=> 'apellido',
	'value'	=> 'Valor',
	'site_configuration'	=> 'Configuración del sitio',
	'error_logs'	=> 'Registros de errores',
	'styles'	=> 'estilos',
);

$lang['system_modules'] = array(
	'php_version'	=> 'versión PHP',
	'apache_version'	=> 'versión apache',
	'server_host'	=> 'anfitrión del servidor',
	'curl_support'	=> 'Soporte cURL',
	'gd_support'	=> 'Soporte de la biblioteca GD',
	'mysql_support'	=> 'soporte mysql',
	'mysqli_support'	=> 'soporte mysqli',
	'pdo_support'	=> 'soporte de DOP',
	'rewriting_support'	=> 'Soporte de reescritura de URL',
);
