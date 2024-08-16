<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/langs.php';
include dirname(__DIR__).'/includes/languages.php';
include dirname(__DIR__).'/'.$lang_path.'adm/langs.php';

header('Content-Type: text/html; charset=utf-8');

$root_dir = dirname(__DIR__).'/lang/';

if(!file_exists($root_dir.'langs.dat'))
	if(!create_langs())
		die($lang['langs']['langs_not_created']);

if(!empty($_GET['action'])) {
	if(!token::verify('adm_langs', $config['form_expiration_time'], 'get'))
		die($lang['langs']['incorrect_token']);
	
	switch($_GET['action']) {
		case 'refresh-langs':
			if(!create_langs())
				die($lang['langs']['langs_not_updated']);
			
			break;
	}
	
	die($lang['langs']['action_success']);
}

$nb = count($accepted_langs);

if($nb > 0) {
	$langs = array();

	foreach($accepted_langs as $value)
		$langs[$value] = isset($languages[$value]) ? $languages[$value] : $value;

	unset( $value);
	
	$tpl->assign(array(
		'rows' => $langs,
	));
}

$token = new token('adm_langs');

$tpl->assign(array(
	'title' => $lang['langs']['site_langs'],
	'nb' => $nb,
	'lang_langs' => $lang['langs'],
	'token' => $token->token,
));

$tpl->draw('langs');