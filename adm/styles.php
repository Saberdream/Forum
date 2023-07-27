<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/styles.php';
include dirname(__DIR__).'/'.$lang_path.'adm/styles.php';

header('Content-Type: text/html; charset=utf-8');

$root_dir = dirname(__DIR__).'/styles/';

if(!file_exists($root_dir.'styles.cfg'))
	file_put_contents($root_dir.'styles.cfg', null);

if(!empty($_GET['action'])) {
	if(!token::verify('adm_styles', $config['form_expiration_time'], 'get'))
		die($lang['styles']['incorrect_token']);
	
	switch($_GET['action']) {
		case 'delete-cache':
			if(!array_map('unlink', glob(RainTPL::$root_dir . RainTPL::$cache_dir . "*.rtpl.php")))
				die($lang['styles']['files_not_deleted']);
			
			break;
		
		case 'refresh-styles':
			$styles_dir = get_styles();
			$data = array();

			foreach($styles_dir as $key => $value) {
				$data[] = '['.$key.']';
				
				foreach($value as $key2 => $value2)
					$data[] = $key2.' = '.$value2;
				
				unset($key2, $value2);
			}
			
			unset($key, $value);
			
			if(!file_put_contents($root_dir.'styles.cfg', implode("\n", $data)))
				die($lang['styles']['styles_not_updated']);
			
			break;
	}
	
	die($lang['styles']['action_success']);
}

$styles = parse_ini_file($root_dir.'styles.cfg', true);
$nb = count($styles);

if($nb > 0) {
	$tpl->assign(array(
		'rows' => $styles,
	));
}

$token = new token('adm_styles');
$cache_size = getFolderSize(RainTPL::$root_dir . RainTPL::$cache_dir);

$tpl->assign(array(
	'title' => $lang['styles']['site_styles'],
	'nb' => $nb,
	'lang_styles' => $lang['styles'],
	'token' => $token->token,
	'cache_size' => $cache_size
));

$tpl->draw('styles');