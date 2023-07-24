<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/pm.php';
include $root_path.$lang_path.'pm.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	$limit = 25;
	$clauses = array('participant_userid = :userid');
	$order = 'pm_last DESC';
	$total = count_rows($user->data['user_id'], $clauses);
	$nb = $total;
	$url = $config['server_protocol'].$config['domain_name'].'/pm?page=%d';
	$page = 1;

	if($total > 0) {
		if(!empty($_POST['sup']) && is_array($_POST['sup']) && isset($_POST['action'])) {
			if(!token::verify('pm', $config['form_expiration_time']))
				die($lang['pm']['incorrect_token']);

			$ids = array_filter($_POST['sup'], 'is_numeric');
			$ids = array_unique($ids, SORT_NUMERIC);

			if(count($ids) == 0 || count($ids) > $limit)
				die($lang['pm']['incorrect_ids']);

			switch($_POST['action']) {
				case 'mark_read':
					update_read($user->data['user_id'], $ids, 1);
					
					break;
				
				case 'mark_unread':
					update_read($user->data['user_id'], $ids, 0);
					
					break;
				
				case 'delete' :
					delete_pm($user->data['user_id'], $user->data['user_name'], $ids);
			}

			token::destroy('pm');
			
			die($lang['pm']['action_success']);
		}

		$search_types = array(
			'title' => $config['table_prefix'].'pm.pm_name',
			'author' => $config['table_prefix'].'pm.pm_username'
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
			$nb = count_rows($user->data['user_id'], $clauses, $keywords, $exact);
			$url = $config['server_protocol'].$config['domain_name'].'/pm?search='.display($keywords).'&type='.$type.($exact ? '&exact=1' : '').'&page=%d';
			$lang['pm']['search_no_result'] = sprintf($lang['pm']['search_no_result'], display($keywords));
		}

		$tpl->assign('search', array(
			'keywords' => $keywords,
			'type' => $type,
			'exact' => $exact,
			'types' => $search_options
		));

		if($nb > 0) {
			$nbpages = ceil($nb/$limit);
			$page = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
			$offset	= ($page-1)*$limit;
			$pagination = pagination($page, $nbpages, $url);
			$rows = !empty($keywords) ? get_rows($user->data['user_id'], $offset, $limit, $clauses, $order, $keywords, $exact) : get_rows($user->data['user_id'], $offset, $limit, $clauses, $order);
			$lang['pm']['search_results'] = sprintf($lang['pm']['search_results'], $nb, display($keywords));
			$token = new token('pm');

			$tpl->assign(array(
				'rows' => $rows,
				'pagination' => $pagination,
				'offset' => $offset,
				'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
				'posts_per_page' => 15,
				'token' => $token->token
			));
		}
	}
	
	$tpl->assign(array(
		'total' => $total,
		'nb' => $nb,
	));
}

$tpl->assign(array(
	'title' => $lang['menu_top']['private_messages'],
	'lang_pm' => $lang['pm']
));

$tpl->draw('pm');