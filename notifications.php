<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/notifications.php';
include $root_path.$lang_path.'notifications.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	$nb = count_rows();

	if($nb > 0) {
		if(isset($_GET['reset'])) {
			if(!token::verify('reset_notifs', $config['form_expiration_time'], 'get'))
				die($lang['notifications']['token_expired']);

			reset_notifications();
			
			token::destroy('reset_notifs');

			die(header('Location: ./notifications'));
		}

		$limit		= 25;
		$nbpages	= ceil($nb/$limit);
		$page		= (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset		= ($page-1)*$limit;
		$pagination	= pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/notifications?page=%d');
		$rows		= get_rows($offset, $limit);
	
		$token = new token('reset_notifs');

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