<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/forums.php';
include $root_path.$lang_path.'forums.php';

header('Content-Type: text/html; charset=utf-8');

$nb = count_rows();

$tpl->assign(array(
	'title' => $lang['forums']['forums_list'],
	'nb' => $nb,
	'lang_forums' => $lang['forums']
));

if($nb > 0)
	$tpl->assign(array(
		'rows' => get_rows(),
	));

$tpl->draw('forums');