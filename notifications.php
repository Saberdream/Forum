<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/notifications.php';
include __DIR__.'/'.$lang_path.'notifications.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	$nb = count_rows();

	if($nb > 0) {
		if(isset($_GET['update_notifications'])) {
			if(!token::verify('update_notifs', $config['form_expiration_time'], 'get'))
				die($lang['notifications']['token_expired']);

			if($_GET['update_notifications'] != 1 AND $_GET['update_notifications'] != 0)
				die($lang['notifications']['error']);

			update_notifications($_GET['update_notifications']);
			
			token::destroy('update_notifs');

			die(($_GET['update_notifications'] == 1) ? $lang['notifications']['notifications_marked_read'] : $lang['notifications']['notifications_resetted']);
		}

		$limit		= 25;
		$nbpages	= ceil($nb/$limit);
		$page		= (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset		= ($page-1)*$limit;
		$pagination	= pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/notifications?page=%d');
		$rows		= get_rows($offset, $limit);
	
		$token = new token('update_notifs');

		$tpl->assign(array(
			'rows' => $rows,
			'pagination' => $pagination,
			'offset' => $offset,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
			'token' => $token->token
		));
	}
	
	$tpl->assign('nb', $nb);
}

$tpl->assign(array(
	'title' => $lang['notifications']['notifications'],
	'lang_notifications' => $lang['notifications']
));

$tpl->draw('notifications');