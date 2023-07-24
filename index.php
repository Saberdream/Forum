<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.$lang_path.'index.php';

header('Content-Type: text/html; charset=utf-8');

$lang['index']['welcome_message'] = sprintf($lang['index']['welcome_message'], display($config['site_name']), $user->data['user_rank'] > GUEST ? $user->data['user_name'] : $lang['index']['visitor']);

$tpl->assign(array(
	'title' => $lang['menu_top']['home'],
	'lang_index' => $lang['index']
));

$tpl->draw('index');