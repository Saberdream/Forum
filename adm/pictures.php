<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/pictures.php';
include $root_path.$lang_path.'adm/pictures.php';

header('Content-Type: text/html; charset=utf-8');

$limit = 25;
$upload_dir = 'gallery/uploads/';
$clauses = array();
$order = 'file_id';
$total = count_rows($clauses);
$nb = $total;
$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?page=%d';
$page = 1;

if($total > 0) {
	if(!empty($_POST['sup']) && is_array($_POST['sup'])) {
		if(!token::verify('adm_pictures', $config['form_expiration_time']))
			die($lang['pictures']['incorrect_token']);
		
		$ids = array_filter($_POST['sup'], 'is_numeric');
		$ids = array_unique($ids, SORT_NUMERIC);
		
		if(count($ids) == 0 || count($ids) > $limit)
			die($lang['pictures']['incorrect_ids']);

		if(delete_pictures($ids, $root_path.$upload_dir)) {
			token::destroy('adm_pictures');

			die($lang['pictures']['action_success']);
		}

		die($lang['pictures']['error_occurred']);
	}

	$search_types = array(
		'username' => $config['table_prefix'].'users.user_name',
		'name' => $config['table_prefix'].'pictures.file_name'
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
		$lang['pictures']['search_no_result'] = sprintf($lang['pictures']['search_no_result'], display($keywords));
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
		$lang['pictures']['search_results'] = sprintf($lang['pictures']['search_results'], $nb, display($keywords));
		$token = new token('adm_pictures');

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
	'title' => $lang['pictures']['manage_pictures'],
	'total' => $total,
	'nb' => $nb,
	'upload_dir' => $upload_dir,
	'lang_pictures' => $lang['pictures']
));

$tpl->draw('pictures');