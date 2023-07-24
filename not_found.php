<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.$lang_path.'not_found.php';

header('Content-Type: text/html; charset=utf-8');

$tpl->assign(array(
	'title' => $lang['not_found']['404_error'],
	'lang_not_found' => $lang['not_found']
));

$tpl->draw('not_found');