<?php
function get_forum($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_catid, forum_name, forum_desc, forum_icon, forum_rules, forum_alerts, forum_auth_view, forum_auth_topic, forum_auth_reply, forum_auth_edit, forum_auth_alert, forum_auth_lock_topic, forum_auth_stick_topic, forum_auth_delete_topic, forum_auth_delete_post, forum_auth_restore_topic, forum_auth_restore_post, forum_auth_ban, forum_moderators, forum_closed, cat_name
	FROM '.$config['table_prefix'].'forums
	LEFT JOIN '.$config['table_prefix'].'categories ON '.$config['table_prefix'].'categories.cat_id = '.$config['table_prefix'].'forums.forum_catid
	WHERE forum_id = ? LIMIT 1');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function get_cats() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT cat_id, cat_name FROM '.$config['table_prefix'].'categories ORDER BY cat_name');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function count_cat($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(cat_id) FROM '.$config['table_prefix'].'categories WHERE cat_id = ?');
	$sth->execute(array($id));
	$count = $sth->fetchColumn();
	unset($sth);
	
	return $count;
}

function update_forum($forumid, $values) {
	global $dbh, $config;

	$marks = vsprintf(placeholders('%s = ?', count($values)), array_keys($values));
	$values[] = $forumid;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET '.$marks.' WHERE forum_id = ?');
	$sth->execute(array_values($values));
	unset($sth);
	
	return true;
}