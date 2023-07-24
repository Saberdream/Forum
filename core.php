<?php
require __DIR__.'/includes/constants.php';
require __DIR__.'/config.php';
require __DIR__.'/includes/functions.php';
require __DIR__.'/includes/functions_adm.php';
require __DIR__.'/includes/autoload.php';

$config = read_config_file();
$config['table_prefix'] = !empty($config['table_prefix']) ? $config['table_prefix'] : '';
$config['server_protocol'] = !empty($config['server_protocol']) ? $config['server_protocol'] : 'http://';

set_exception_handler('exception_handler');
spl_autoload_register('autoload');

// server load check
if($config['load_limit'] > 0) {
	$load = get_server_load();

	if($load > $config['load_limit'])
		die('The site is temporarily unavailable, please retry your request later.');
}

$db = Db::getInstance();
$dbh = $db->getConnection();

if($dbh == null)
	die('Error while trying to establish connection to the database, please contact the administrator for more information.');

session::$table_prefix = $config['table_prefix'];
session::set_dbh($dbh);
$session = new session();
$session->start_session('sid', (empty($_SERVER['HTTPS']) || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'off')) ? false : true);

user::set_settings(array(
	'session_gc_probability' => (int) $config['session_gc_probability'],
	'session_expiration_time' => (int) $config['session_expiration_time'],
	'max_autologin_time' => (int) $config['max_autologin_time'],
	'sessions_per_ip' => (int) $config['sessions_per_ip'],
	'cookies_expiration_time' => (int) $config['cookies_expiration_time'],
	'cookies_name' => $config['cookies_name'],
	'table_prefix' => $config['table_prefix']
));

if(!isset($in_admin))
	$in_admin = false;

user::set_dbh($dbh);

$user = new user();

$lang_path = !empty($user->data['user_lang']) ? 'lang/'.$user->data['user_lang'].'/' : 'lang/fr/';
$style = ($user->data['user_style'] != null && $config['user_style'] == true) ? $user->data['user_style'] : $config['default_style'];

if(!$in_admin)
	$style_config = parse_ini_file(__DIR__.'/styles/'.$style.'/style.cfg');

if(!empty($user->data['user_timezone']))
	date_default_timezone_set($user->data['user_timezone']);
elseif(!empty($config['default_timezone']))
	date_default_timezone_set($config['default_timezone']);

if(($user->data['user_rank'] < ADMIN || !$user->data['admin']) && $in_admin)
	die(header('Location: ../login?mode=admin'));

include __DIR__.'/'.$lang_path.($in_admin ? 'adm/' : '').'header.php';
include __DIR__.'/'.$lang_path.($in_admin ? 'adm/' : '').'footer.php';

$lang['footer']['developped_by'] = sprintf($lang['footer']['developped_by'], 'Saberdream');
$lang['footer']['contact'] = sprintf($lang['footer']['contact'], $config['site_mail']);

RainTPL::configure(array(
	'base_url' => $config['server_protocol'].$config['domain_name'].'/',
	'tpl_dir' => $in_admin ? 'adm/style/' : 'styles/'.$style.'/',
	// 'parent_tpl_dir' => $in_admin ? 'adm/style/' : 'styles/'.$style.'/',
	'cache_dir' => 'cache/tpl/',
	'root_dir' => __DIR__.'/',
	'path_replace_list' => array('a', 'img', 'link', 'script', 'input', 'form')
));

$tpl = new RainTPL;

$session_time_left = ($user->data['autologin'] == 1) ? round((($config['max_autologin_time']+60)-(time()-$user->data['time']))/60) : round((($config['session_expiration_time']+60)-(time()-$user->data['time']))/60);
$lang['menu_top']['session_time_left'] = sprintf($lang['menu_top']['session_time_left'], $session_time_left);

$tpl->assign(array(
	'domain_name' => $config['domain_name'],
	'site_name' => $config['site_name'],
	'site_description' => $config['site_description'],
	'site_lang' => !empty($user->data['user_lang']) ? $user->data['user_lang'] : $config['default_lang'],
	'lang_menu_top' => $lang['menu_top'],
	'lang_footer' => $lang['footer'],
	'user' => $user->data,
	'nb_alerts' => $in_admin ? get_alerts() : null,
	'nb_notifications' => ($user->data['user_rank'] >= USER && !$in_admin) ? get_notifications() : null,
	'activate_pm' => $config['activate_pm']
));
