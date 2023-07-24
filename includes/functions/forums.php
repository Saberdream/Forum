<?php
function count_rows() {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(forum_id) FROM '.$config['table_prefix'].'forums WHERE forum_auth_view <= :rank');
	$sth->execute(array(':rank' => $user->data['user_rank']));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows() {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_name, forum_slug, forum_desc, forum_icon, forum_topics_visible, forum_posts_visible, forum_last, forum_closed, cat_name, cat_order
	FROM '.$config['table_prefix'].'forums
	LEFT JOIN '.$config['table_prefix'].'categories ON '.$config['table_prefix'].'categories.cat_id = '.$config['table_prefix'].'forums.forum_catid
	WHERE forum_auth_view <= :rank
	ORDER BY '.$config['table_prefix'].'categories.cat_order, '.$config['table_prefix'].'forums.forum_order');
	$sth->execute(array(':rank' => $user->data['user_rank']));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}