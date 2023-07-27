<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/forums.php';
include __DIR__.'/'.$lang_path.'forums.php';

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