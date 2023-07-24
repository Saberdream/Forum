<?php
function get_post($postid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT post_id, post_topicid, post_forumid, post_userid, post_rank, post_invisible, post_text, topic_invisible, forum_auth_view, forum_auth_alert
	FROM '.$config['table_prefix'].'posts
	LEFT JOIN '.$config['table_prefix'].'topics ON '.$config['table_prefix'].'topics.topic_id = '.$config['table_prefix'].'posts.post_topicid
	LEFT JOIN '.$config['table_prefix'].'forums ON '.$config['table_prefix'].'forums.forum_id = '.$config['table_prefix'].'posts.post_forumid
	WHERE post_id = ?');
	$sth->execute(array($postid));
	$post = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $post;
}

function count_alerts($postid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(alert_id) FROM '.$config['table_prefix'].'alerts WHERE alert_postid = ?');
	$sth->execute(array($postid));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function count_reason($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(reason_id) FROM '.$config['table_prefix'].'alerts_reasons WHERE reason_id = ?');
	$sth->execute(array($id));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_reason($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT reason_name FROM '.$config['table_prefix'].'alerts_reasons WHERE reason_id = ?');
	$sth->execute(array($id));
	$rows = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows['reason_name'];
}

function get_reasons() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT reason_id, reason_name, reason_desc FROM '.$config['table_prefix'].'alerts_reasons ORDER BY reason_order');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	return $rows;
}

function get_page($topicid, $postid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'posts WHERE post_topicid = ? AND post_id < ?');
	$sth->execute(array($topicid, $postid));
	$nbposts = $sth->fetchColumn();
	unset($sth);
	
	if($nbposts+1 <= $config['posts_per_page'])
		return 1;
	
	$page = ceil(($nbposts+1)/$config['posts_per_page']);
	
	return $page;
}

function insert_alert($reasonid, $post) {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'alerts(alert_postid, alert_topicid, alert_forumid, alert_userid, alert_reason, alert_time, alert_page, alert_ip, alert_rank, alert_text) VALUES('.placeholders('?', 10).')');
	$sth->execute(array($post['post_id'], $post['post_topicid'], $post['post_forumid'], $user->data['user_id'], get_reason($reasonid), time(), get_page($post['post_topicid'], $post['post_id']), $_SERVER['REMOTE_ADDR'], $user->data['user_rank'], $post['post_text']));
	unset($sth);
	
	return true;
}