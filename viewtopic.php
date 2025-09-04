<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/viewtopic.php';
include __DIR__.'/'.$lang_path.'viewtopic.php';
include __DIR__.'/'.$lang_path.'bbcode.php';
include __DIR__.'/'.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forums'));

$topic = get_topic($_GET['id']);

if(!$topic)
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forums'));

if($topic['topic_invisible'] == 1 && $user->data['user_rank'] < $topic['forum_auth_restore_topic'])
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forum/'.$topic['forum_slug'].'/'.$topic['topic_forumid'].'/1'));

if(!preg_match('#^/topic/'.$topic['topic_slug'].'/'.$topic['topic_id'].'\/[0-9]+$#', $_SERVER['REQUEST_URI']) && !($user->data['user_rank'] >= ADMIN && isset($_GET['alert'])) && !($user->data['user_rank'] >= $topic['forum_auth_view'] && (isset($_GET['get-post']) || isset($_GET['subscribe']))))
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/topic/'.$topic['topic_slug'].'/'.$topic['topic_id'].'/1'));

if($user->data['user_rank'] >= $topic['forum_auth_view']) {
	$moderators = explode(';', $topic['forum_moderators']);
	$moderator = ($user->data['user_rank'] >= ADMIN || ($user->data['user_rank'] == MODERATOR && in_array(strtolower($user->data['user_name']), array_map('strtolower', $moderators)))) ? true : false;

	if(isset($_GET['get-post']) && ctype_digit($_GET['get-post'])) {
		if($topic['topic_invisible'] == 1)
			die($lang['topic']['subject_deleted']);
		
		if($user->data['user_rank'] < $topic['forum_auth_edit'] && $user->data['user_rank'] < $topic['forum_auth_edit_own'])
			die($lang['topic']['not_authorized_edit']);

		if(!token::verify('get_post', $config['form_expiration_time'], 'get'))
			die($lang['topic']['expired_token']);

		$post = get_post($_GET['get-post']);

		if($user->data['user_rank'] < $topic['forum_auth_edit'] || !$moderator) {
			if($user->data['user_id'] != $post['post_userid'])
				die($lang['topic']['not_own_message']);
			elseif($user->data['user_rank'] < $topic['forum_auth_edit_own'])
				die($lang['topic']['not_authorized_edit']);
		}

		die($post['post_text']);
	}
	elseif(isset($_GET['subscribe']) && $topic['topic_invisible'] == 0) {
		if(!token::verify('subscribe', $config['form_expiration_time'], 'get'))
			die($lang['topic']['expired_token']);

		token::destroy('subscribe');
		
		$nb_subscriptions = get_nb_subscriptions($topic['topic_id']);
		
		if($nb_subscriptions > 0)
			die($lang['topic']['already_subscribed']);

		if($config['max_subscribes'] > 0) {
			$nb_user_subscriptions = get_user_subscriptions();

			if($nb_user_subscriptions >= $config['max_subscribes'])
				die(sprintf($lang['topic']['max_subscriptions_reached'], $nb_user_subscriptions));
		}
		
		if(insert_subscription($topic['topic_id']))
			die($lang['topic']['successful_subscribed']);
	}

	$title = $topic['topic_name'].' - '.$lang['topic']['read_subject'].' '.$topic['forum_name'];
	$clauses = array('post_topicid = :id');

	if(!$moderator || $user->data['user_rank'] < $topic['forum_auth_restore_post']) {
		$clauses[] = 'post_invisible = 0';
		$nb = $topic['topic_posts_visible'];
	}
	else
		$nb = $topic['topic_posts'];

	// $nb = count_rows($topic['topic_id'], $clauses);

	$url = $config['server_protocol'].$config['domain_name'].'/topic/'.$topic['topic_slug'].'/'.$topic['topic_id'].'/%d';
	$limit	 = (int) $config['posts_per_page'];
	$nbpages = ceil($nb/$limit);
	$page	 = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
	$offset	 = ($page-1)*$limit;

	if($nb > 0) {
		if($page > $nbpages)
			die(header('Location: '.sprintf($url, $nbpages)));

		$rows = get_rows($topic['topic_id'], $offset, $limit, $clauses);
		$pagination = pagination($page, $nbpages, $url, false);

		if($page > 1)
			$title .= ' - '.$lang['topic']['page'].' '.$page;
	}

	$token_mod = new token('forum_mod');
	$token_subscribe = new token('subscribe');

	$tpl->assign(array(
		'nb' => $nb,
		'moderator' => $moderator,
		'page' => $page,
		'token' => $token_mod->token,
		'subscribe_token' => $token_subscribe->token,
		// 'current_url' => substr(sprintf($url, $page), strlen($config['server_protocol'].$config['domain_name'].'/')),
		'current_url' => sprintf($url, $page),
		'alert' => (isset($_GET['alert']) && ctype_digit($_GET['alert']) && $user->data['user_rank'] >= ADMIN) ? (int) $_GET['alert'] : 0,
		'title' => $title
	));

	if($user->data['user_rank'] >= $topic['forum_auth_reply'] && ($topic['forum_closed'] == 0 || $user->data['user_rank'] >= ADMIN)) {
		$token_reply = new token('posting_reply');
		$token_preview = new token('preview');

		$tpl->assign(array(
			'lang_bbcode' => $lang['bbcode'],
			'preview_token' => $token_preview->token
		));

		$tpl->assign('form', array(
			'token' => $token_reply->token,
			'captcha' => $config['captcha_reply']
		));
	}
	
	if($user->data['user_rank'] >= $topic['forum_auth_edit'] || $user->data['user_rank'] >= $topic['forum_auth_edit_own']) {
		$token_edit = new token('posting_edit');
		$token_get = new token('get_post');

		$tpl->assign(array(
			'edit_token' => $token_edit->token,
			'get_post_token' => $token_get->token
		));
	}

	if($nb > 0) {
		$tpl->assign(array(
			'rows' => $rows,
			'pagination' => $pagination,
			'limit' => $limit,
			'offset' => $offset,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit
		));
	}
}

$topic['topic_name'] = wordwrap($topic['topic_name'], 25, "\n", true);

$tpl->assign(array(
	'topic' => $topic,
	'lang_topic' => $lang['topic']
));

$tpl->draw('viewtopic');