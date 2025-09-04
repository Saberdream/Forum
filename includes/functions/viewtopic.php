<?php
function get_topic($topic) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT topic_id, topic_forumid, topic_postid, topic_userid, topic_username, topic_name, topic_slug, topic_posts, topic_posts_visible, topic_lock, topic_sticky, topic_sticky_order, topic_invisible,
	forum_name, forum_slug, forum_alerts, forum_auth_view, forum_auth_topic, forum_auth_reply, forum_auth_edit, forum_auth_edit_own, forum_auth_alert, forum_auth_lock_topic, forum_auth_stick_topic, forum_auth_delete_topic, forum_auth_delete_post, forum_auth_restore_topic, forum_auth_restore_post, forum_auth_remove_topic, forum_auth_remove_post, forum_auth_ban, forum_moderators, forum_closed, cat_name
	FROM '.$config['table_prefix'].'topics
	LEFT JOIN '.$config['table_prefix'].'forums ON '.$config['table_prefix'].'forums.forum_id = '.$config['table_prefix'].'topics.topic_forumid
	LEFT JOIN '.$config['table_prefix'].'categories ON '.$config['table_prefix'].'categories.cat_id = '.$config['table_prefix'].'topics.topic_catid
	WHERE topic_id = ?');
	$sth->execute(array($topic));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function count_rows($id, $clauses = array()) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'posts'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($id, $offset, $limit, $clauses = array(), $order = 'post_id') {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT post_id, post_userid, post_username, post_ip, post_time, post_time_edit, post_rank, post_invisible, post_text_parsed, user_rank, user_avatar
	FROM '.$config['table_prefix'].'posts
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'posts.post_userid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':id', (int) $id, PDO::PARAM_INT);
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}

function get_post($id) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT post_userid, post_ip, post_time, post_invisible, post_text
	FROM '.$config['table_prefix'].'posts
	WHERE post_id = ?');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function get_nb_subscriptions($topicid) {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('SELECT COUNT(sub_id) FROM '.$config['table_prefix'].'subscriptions WHERE sub_topicid = ? AND sub_userid = ?');
	$sth->execute(array($topicid, $user->data['user_id']));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_user_subscriptions() {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('SELECT COUNT(sub_id) FROM '.$config['table_prefix'].'subscriptions WHERE sub_userid = ?');
	$sth->execute(array($user->data['user_id']));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function insert_subscription($topicid) {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'subscriptions(sub_userid, sub_topicid) VALUES(?, ?)');
	$sth->execute(array($user->data['user_id'], $topicid));
	unset($sth);

	return true;
}