<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/smileys.php';
include $root_path.$lang_path.'smileys.php';

header('Content-Type: text/html; charset=utf-8');

$smileys = get_smileys();

$smileys = array_chunk($smileys, 4);

$tpl->assign(array(
	'lang_smileys' => $lang['smileys'],
	'smileys' => $smileys,
));

$tpl->draw('smileys');