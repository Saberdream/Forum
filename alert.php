<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/alert.php';
include __DIR__.'/'.$lang_path.'alert.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] < USER)
	die($lang['alert']['error_not_connected']);

if(!isset($_GET['postid']) || !ctype_digit($_GET['postid']))
	die($lang['alert']['incorrect_post_id']);

$post = get_post($_GET['postid']);

if(!$post)
	die($lang['alert']['post_not_exists']);

if($post['post_invisible'] == 0 && $post['topic_invisible'] == 0 && $user->data['user_rank'] >= $post['forum_auth_view'] && $user->data['user_rank'] >= $post['forum_auth_alert']) {
	$count_alerts = count_alerts($_GET['postid']);

	if($count_alerts == 0 && isset($_POST['reason'])) {
		if(token::verify('alert', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/alert?postid='.$_GET['postid'])) {
			if(ctype_digit($_POST['reason'])) {
				if(count_reason($_POST['reason']) > 0) {
					if(insert_alert($_POST['reason'], $post))
						$ok = $lang['alert']['post_successful_reported'];
				}
				else
					$error = $lang['alert']['reason_not_exists'];
			}
			else
				$error = $lang['alert']['invalid_reason'];
		}
		else
			$error = $lang['alert']['invalid_form'];

		token::destroy('alert');
	}
}

$tpl->assign('post', array(
	'id' => $_GET['postid'],
	'invisible' => $post['post_invisible']
));
$tpl->assign('topic', array(
	'invisible' => $post['topic_invisible']
));
$tpl->assign('forum', array(
	'auth_view' => $post['forum_auth_view'],
	'auth_alert' => $post['forum_auth_alert']
));
if($post['post_invisible'] == 0 && $post['topic_invisible'] == 0 && $user->data['user_rank'] >= $post['forum_auth_view'] && $user->data['user_rank'] >= $post['forum_auth_alert']) {
	$tpl->assign(array(
		'nb' => $count_alerts,
		'reasons' => get_reasons()
	));
	$token = new token('alert');
	$tpl->assign('form', array(
		'token' => $token->token,
		'ok' => !empty($ok) ? $ok : '',
		'error' => !empty($error) ? $error : ''
	));
}

$tpl->assign(array(
	'lang_alert' => $lang['alert']
));

$tpl->draw('alert');