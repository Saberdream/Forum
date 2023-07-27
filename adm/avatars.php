<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/avatars.php';
include dirname(__DIR__).'/'.$lang_path.'adm/avatars.php';

header('Content-Type: text/html; charset=utf-8');

$limit = 25;
$upload_dir = 'gallery/avatars/';
$clauses = array();
$order = 'file_id';
$total = count_rows($clauses);
$nb = $total;
$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?page=%d';
$page = 1;

if($total > 0) {
	if(!empty($_POST['sup']) && is_array($_POST['sup'])) {
		if(!token::verify('adm_avatars', $config['form_expiration_time']))
			die($lang['avatars']['incorrect_token']);

		$ids = array_filter($_POST['sup'], 'is_numeric');
		$ids = array_unique($ids, SORT_NUMERIC);

		if(count($ids) == 0 || count($ids) > $limit)
			die($lang['avatars']['incorrect_ids']);

		if(delete_avatars($ids, dirname(__DIR__).'/'.$upload_dir)) {
			token::destroy('adm_avatars');

			die($lang['avatars']['action_success']);
		}

		die($lang['avatars']['error_occurred']);
	}

	$search_types = array(
		'username' => $config['table_prefix'].'users.user_name'
	);

	$search_options = array();

	foreach($search_types as $key => $value)
		$search_options[$key] = isset($lang['search_options'][$key]) ? $lang['search_options'][$key] : $key;

	unset($key, $value);

	$type = (isset($_GET['type']) && isset($search_types[$_GET['type']])) ? $_GET['type'] : key($search_types);
	$exact = (isset($_GET['exact']) && $_GET['exact'] == 1) ? true : false;
	$keywords = null;

	if(!empty($_GET['search']))
		$keywords = mb_strlen($_GET['search'], 'UTF-8') <= 100 ? $_GET['search'] : mb_substr($_GET['search'], 0, 100, 'UTF-8');

	if(!empty($keywords)) {
		$clauses[] = $search_types[$type].' LIKE :keywords';
		$nb = count_rows($clauses, $keywords, $exact);
		$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?search='.display($keywords).'&type='.$type.($exact ? '&exact=1' : '').'&page=%d';
		$lang['avatars']['search_no_result'] = sprintf($lang['avatars']['search_no_result'], display($keywords));
	}

	$tpl->assign('search', array(
		'keywords' => $keywords,
		'type' => $type,
		'exact' => $exact,
		'types' => $search_options
	));

	if($nb > 0) {
		$nbpages = ceil($nb/$limit);
		$page	 = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset	 = ($page-1)*$limit;
		$pagination = pagination($page, $nbpages, $url);
		$rows = !empty($keywords) ? get_rows($offset, $limit, $clauses, $order, $keywords, $exact) : get_rows($offset, $limit, $clauses, $order);
		$lang['avatars']['search_results'] = sprintf($lang['avatars']['search_results'], $nb, display($keywords));
		$token = new token('adm_avatars');

		$tpl->assign(array(
			'rows' => $rows,
			'pagination' => $pagination,
			'offset' => $offset,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
			'token' => $token->token
		));
	}
}

$tpl->assign(array(
	'title' => $lang['avatars']['manage_avatars'],
	'total' => $total,
	'nb' => $nb,
	'upload_dir' => $upload_dir,
	'lang_avatars' => $lang['avatars']
));

$tpl->draw('avatars');