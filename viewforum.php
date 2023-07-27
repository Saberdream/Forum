<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/viewforum.php';
include __DIR__.'/'.$lang_path.'viewforum.php';
include __DIR__.'/'.$lang_path.'bbcode.php';
include __DIR__.'/'.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forums'));

$forum = get_forum($_GET['id']);

if(!$forum)
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forums'));

if(!preg_match('#^/forum/'.$forum['forum_slug'].'/'.$forum['forum_id'].'\/[0-9]+$#', $_SERVER['REQUEST_URI']) && empty($_GET['search']))
	die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/forum/'.$forum['forum_slug'].'/'.$forum['forum_id'].'/1'));

if($user->data['user_rank'] >= $forum['forum_auth_view']) {
	$moderators = explode(';', $forum['forum_moderators']);
	$moderator = ($user->data['user_rank'] >= ADMIN || ($user->data['user_rank'] == MODERATOR && in_array(strtolower($user->data['user_name']), array_map('strtolower', $moderators)))) ? true : false;
	$title = $lang['forum']['forum'].' '.display($forum['forum_name']);
	$clauses = array('topic_forumid = :id');
	$order = 'FIELD(topic_sticky, 1, 0), topic_sticky_order, topic_last DESC';

	if(!$moderator || $user->data['user_rank'] < $forum['forum_auth_restore_topic']) {
		$clauses[] = 'topic_invisible = 0';
		$total = $forum['forum_topics_visible'];
	}
	else
		$total = $forum['forum_topics'];

	// $total = count_rows($forum['forum_id'], $clauses);

	$nb = $total;
	$url = $config['server_protocol'].$config['domain_name'].'/forum/'.$forum['forum_slug'].'/'.$forum['forum_id'].'/%d';
	$page = 1;

	// don't need to declare some search vars if the db is empty...
	if($total > 0) {
		$search_types = array(
			'topic_name' => $config['table_prefix'].'topics.topic_name',
			'username' => $config['table_prefix'].'topics.topic_username'
		);
		
		$search_options = array(
			'topic_name' => $lang['search_options']['topic_name'],
			'username' => $lang['search_options']['username']
		);

		$type = (isset($_GET['type']) && isset($search_types[$_GET['type']])) ? $_GET['type'] : key($search_types);
		$exact = (isset($_GET['exact']) && $_GET['exact'] == 1) ? true : false;
		$keywords = null;

		if(!empty($_GET['search']))
			$keywords = mb_strlen($_GET['search'], 'UTF-8') <= 100 ? $_GET['search'] : mb_substr($_GET['search'], 0, 100, 'UTF-8');

		if(!empty($keywords)) {
			$clauses[] = $search_types[$type].' LIKE :keywords';
			$nb = count_rows($forum['forum_id'], $clauses, $keywords, $exact);
			$url = $config['server_protocol'].$config['domain_name'].'/'.basename(__FILE__).'?id='.$forum['forum_id'].'&search='.display($keywords).'&type='.$type.($exact ? '&exact=1' : '').'&page=%d';
			$lang['forum']['search_no_results'] = sprintf($lang['forum']['search_no_results'], display($keywords));
		}

		$tpl->assign('search', array(
			'keywords' => $keywords,
			'type' => $type,
			'exact' =>$exact,
			'types' => $search_options
		));

		// we need this clause because if there are rows in db but no searching results these vars don't need to be set
		if($nb > 0) {
			$limit	 = (int) $config['topics_per_page'];
			$nbpages = ceil($nb/$limit);
			$page	 = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
			$offset	 = ($page-1)*$limit;

			if(empty($_GET['search']) && isset($_GET['page']) && ctype_digit($_GET['page']) && ($_GET['page'] > $nbpages || $_GET['page'] < 1))
				die(header('Location: '.sprintf($url, 1)));

			$pagination = pagination($page, $nbpages, $url, false);
			$rows = !empty($keywords) ? get_rows($forum['forum_id'], $offset, $limit, $clauses, $order, $keywords, $exact) : get_rows($forum['forum_id'], $offset, $limit, $clauses, $order);

			if(!empty($keywords)) {
				$title .= ' - '.sprintf($lang['forum']['search_results'], $keywords);
				$lang['forum']['search_nb_results'] = sprintf($lang['forum']['search_nb_results'], $nb, display($keywords));
			}

			if($page > 1)
				$title .= ' - '.$lang['forum']['page'].' '.$page;
			
			$token_mod = new token('forum_mod');

			$tpl->assign(array(
				'rows' => $rows,
				'posts_per_page' => (int) $config['posts_per_page'],
				'token' => $token_mod->token,
				'pagination' => $pagination
			));
		}
	}

	$tpl->assign(array(
		'total' => $total,
		'nb' => $nb,
		'moderator' => $moderator,
		'current_url' => sprintf($url, $page),
		'title' => $title
	));

	if($user->data['user_rank'] >= $forum['forum_auth_topic']) {
		$token_new = new token('posting_new');
		$token_preview = new token('preview');

		$tpl->assign(array(
			'lang_bbcode' => $lang['bbcode'],
			'preview_token' => $token_preview->token
		));

		$tpl->assign('form', array(
			'token' => $token_new->token,
			'captcha' => (bool) $config['captcha_newtopic']
		));
	}
}

$tpl->assign(array(
	'forum' => $forum,
	'lang_forum' => $lang['forum'],
));

$tpl->draw('viewforum');