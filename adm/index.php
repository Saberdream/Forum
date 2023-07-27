<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/'.$lang_path.'adm/index.php';

header('Content-Type: text/html; charset=utf-8');

$lang['index']['welcome_message'] = sprintf($lang['index']['welcome_message'], $user->data['user_name']);

$tpl->assign(array(
	'title' => $lang['index']['panel_index'],
	'lang_index' => $lang['index']
));

$tpl->draw('index');