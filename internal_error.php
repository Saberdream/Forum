<?php
include __DIR__.'/core.php';
include __DIR__.'/'.$lang_path.'internal_error.php';

header('Content-Type: text/html; charset=utf-8');

$tpl->assign(array(
	'title' => $lang['internal_error']['internal_error'],
	'lang_internal_error' => $lang['internal_error']
));

$tpl->draw('internal_error');