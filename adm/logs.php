<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/logs.php';
include dirname(__DIR__).'/'.$lang_path.'adm/logs.php';

header('Content-Type: text/html; charset=utf-8');

$root_dir = dirname(__DIR__).'/logs/';
$limit = 25;
$logs = get_logs();
$nb = count($logs);
$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?page=%d';
$page = 1;

if($nb > 0) {
	if(!empty($_POST['sup']) && is_array($_POST['sup']) && isset($_POST['action']) && $_POST['action'] == 'delete') {
		if(!token::verify('adm_logs', $config['form_expiration_time']))
			die($lang['logs']['incorrect_token']);

		$ids = array_filter($_POST['sup'], 'is_numeric');
		$ids = array_unique($ids, SORT_NUMERIC);

		if(count($ids) == 0 || count($ids) > $limit)
			die($lang['logs']['incorrect_ids']);

		$files = array();
		
		foreach($ids as $value) {
			if(isset($logs[$value]))
				$files[] = $root_dir.$logs[$value]['file_name'];
		}
		
		unset($value);
		
		if(count($files) == 0)
			die($lang['logs']['files_not_exists']);
		
		if(!delete_logs($files))
			die($lang['logs']['files_not_deleted']);
		
		die($lang['logs']['action_success']);
	}

	$nbpages = ceil($nb/$limit);
	$page = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
	$offset	= ($page-1)*$limit;
	$pagination = pagination($page, $nbpages, $url);
	$rows = array_slice($logs, $offset, $limit);

	foreach($rows as $key => $value) {
		$rows[$key]['file_time'] = filemtime($root_dir.$value['file_name']);
		$rows[$key]['file_size'] = filesize($root_dir.$value['file_name']);
		$rows[$key]['file_text'] = file_get_contents($root_dir.$value['file_name']);
	}

	unset($key, $value);

	$token = new token('adm_logs');

	$tpl->assign(array(
		'rows' => $rows,
		'pagination' => $pagination,
		'offset' => $offset,
		'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
		'token' => $token->token
	));
}

$tpl->assign(array(
	'title' => $lang['logs']['site_errors'],
	'nb' => $nb,
	'lang_logs' => $lang['logs']
));

$tpl->draw('logs');