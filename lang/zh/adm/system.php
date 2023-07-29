<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * system.php
*/
$lang['system'] = array(
	'yes'	=> '是的',
	'no'	=> '不',
	'system_informations'	=> '系统信息',
	'system_modules'	=> '系统及模块',
	'php_functions'	=> 'PHP函数',
	'name'	=> '姓名',
	'value'	=> '价值',
	'site_configuration'	=> '站点设置',
	'error_logs'	=> '错误日志',
	'styles'	=> '风格',
);

$lang['system_modules'] = array(
	'php_version'	=> 'PHP版本',
	'apache_version'	=> '阿帕奇版本',
	'server_host'	=> '服务器主机',
	'curl_support'	=> '卷曲支持',
	'gd_support'	=> 'GD 库支持',
	'mysql_support'	=> 'mysql支持',
	'mysqli_support'	=> 'mysqli 支持',
	'pdo_support'	=> 'PDO 支持',
	'rewriting_support'	=> 'URL重写支持',
);
