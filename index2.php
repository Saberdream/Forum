<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.$lang_path.'index.php';

header('Content-Type: text/html; charset=utf-8');

// $user->session_create(1, false, true);

$root_domain = substr($config['domain_name'], 0, ((strpos($config['domain_name'], '/') !== false) ? strpos($config['domain_name'], '/') : strlen($config['domain_name'])));

$tpl->assign(array(
	'title' => $lang['menu_top']['home'],
	'lang_index' => $lang['index']
));

$ids = array(46, 47, 48, 49, 50);

$values = array(0, 46);

// $values = array_merge($values, $ids);

$values = $values+$ids;

// print_r($values);

// print '<p>'.sizeof($values).'</p>';

$tpl->assign('debug', array(
	'data_sessionid' => wordwrap($user->data['sessionid'], 32, ' ', true),
	'max_login_attempts' => $config['max_login_attempts'],
	'remote_addr' => $_SERVER['REMOTE_ADDR'],
	'session_time' => $user->data['time'],
	'session_last' => $user->data['last'],
	'is_valid_referer' => (strpos(parse_url('https://forum.prog.fr', PHP_URL_HOST), $root_domain) !== false) ? 'true':'false',
	'previous_page' => previous_page(),
	'timezone' => date_default_timezone_get(),
));

$tpl->draw('index2');