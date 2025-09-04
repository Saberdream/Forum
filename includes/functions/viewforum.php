<?php
function get_forum($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_name, forum_slug, forum_topics, forum_topics_visible, forum_rules, forum_alerts, forum_auth_view, forum_auth_topic, forum_auth_reply, forum_auth_alert, forum_auth_lock_topic, forum_auth_stick_topic, forum_auth_delete_topic, forum_auth_delete_post, forum_auth_restore_topic, forum_auth_restore_post, forum_auth_remove_topic, forum_auth_remove_post, forum_auth_ban, forum_moderators, forum_closed, cat_name
	FROM '.$config['table_prefix'].'forums
	LEFT JOIN '.$config['table_prefix'].'categories ON '.$config['table_prefix'].'categories.cat_id = '.$config['table_prefix'].'forums.forum_catid
	WHERE forum_id = ? LIMIT 1');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function count_rows($id, $clauses = array(), $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(topic_id) FROM '.$config['table_prefix'].'topics'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	$sth->bindValue(':id', (int) $id, PDO::PARAM_INT);
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($id, $offset, $limit, $clauses = array(), $order = 'FIELD(topic_sticky, 1, 0), topic_sticky_order, topic_last DESC', $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT topic_id, topic_userid, topic_username, topic_name, topic_slug, topic_last, topic_posts, topic_posts_visible, topic_lock, topic_sticky, topic_rank, topic_invisible, user_rank
	FROM '.$config['table_prefix'].'topics
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'topics.topic_userid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':id', (int) $id, PDO::PARAM_INT);
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}