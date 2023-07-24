<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/alerts.php';
include $root_path.$lang_path.'adm/alerts.php';

header('Content-Type: text/html; charset=utf-8');

$modes = array('new', 'closed');
$mode = (isset($_GET['mode']) && in_array($_GET['mode'], $modes)) ? $_GET['mode'] : 'new';

$limit = 25;
$clauses = array(($mode == 'new' ? 'alert_closed = 0' : 'alert_closed = 1'));
$order = ($mode == 'new') ? 'alert_rank DESC, alert_id ASC' : 'alert_id';
$total = count_rows($clauses);
$nb = $total;
$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?mode='.$mode.'&page=%d';
$page = 1;

if($total > 0) {
	if(!empty($_POST['sup']) && is_array($_POST['sup']) && isset($_POST['action'])) {
		if(!token::verify('adm_alerts', $config['form_expiration_time']))
			die($lang['alerts']['incorrect_token']);
		
		$ids = array_filter($_POST['sup'], 'is_numeric');
		$ids = array_unique($ids, SORT_NUMERIC);
		
		if(count($ids) == 0 || count($ids) > $limit)
			die($lang['alerts']['incorrect_ids']);
		
		switch($_POST['action']) {
			case 'close' :
				close_alerts($ids);
				break;
			
			case 'delete' :
				delete_alerts($ids);
		}
		
		token::destroy('adm_alerts');
		
		die($lang['alerts']['action_success']);
	}

	$search_types = array(
		'id' => $config['table_prefix'].'alerts.alert_id',
		'username' => $config['table_prefix'].'posts.post_username',
		'ip' => $config['table_prefix'].'alerts.alert_ip',
		'reason' => $config['table_prefix'].'alerts.alert_reason'
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
		$url = $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?mode='.$mode.'&search='.display($keywords).'&type='.$type.($exact ? '&exact=1' : '').'&page=%d';
		$lang['alerts']['search_no_result'] = sprintf($lang['alerts']['search_no_result'], display($keywords));
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
		$lang['alerts']['search_results'] = sprintf($lang['alerts']['search_results'], $nb, display($keywords));
		$token = new token('adm_alerts');

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
	'title' => $lang['alerts']['manage_alerts'],
	'total' => $total,
	'nb' => $nb,
	'mode' => $mode,
	'lang_alerts' => $lang['alerts']
));

$tpl->draw('alerts');