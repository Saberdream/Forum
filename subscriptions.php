<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/subscriptions.php';
include $root_path.$lang_path.'subscriptions.php';

header('Content-Type: text/html; charset=utf-8');

$limit = 25;

if($user->data['user_rank'] >= USER) {
	$nb = count_rows($user->data['user_id']);

	if($nb > 0) {
		if(isset($_POST['sup']) && !empty($_POST['sup']) && is_array($_POST['sup'])) {
			if(!token::verify('subscriptions', $config['form_expiration_time']))
				die($lang['subscriptions']['expired_form']);

			$ids = array_filter($_POST['sup'], 'is_numeric');
			$ids = array_unique($ids, SORT_NUMERIC);
			
			if(count($ids) == 0 || count($ids) > $limit)
				die($lang['subscriptions']['incorrect_ids']);

			if(count($ids) > 0) {
				if(delete_subscriptions($ids)) {
					token::destroy('subscriptions');
					
					die($lang['subscriptions']['subscriptions_deleted']);
				}

				die($lang['subscriptions']['error_occured']);
			}
		}

		$nbpages	= ceil($nb/$limit);
		$page		= (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset		= ($page-1)*$limit;
		$pagination	= pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/subscriptions?page=%d');
		$rows		= get_rows($user->data['user_id'], $offset, $limit);
		$token		= new token('subscriptions');

		$tpl->assign(array(
			'rows' => $rows,
			'token' => $token->token,
			'pagination' => $pagination,
			'offset' => $offset,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
		));
	}
	
	$tpl->assign('nb', $nb);
}

$tpl->assign(array(
	'title' => $lang['subscriptions']['subscriptions'],
	'lang_subscriptions' => $lang['subscriptions']
));

$tpl->draw('subscriptions');