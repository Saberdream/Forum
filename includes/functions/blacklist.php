<?php
function count_rows() {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(bl_id) FROM '.$config['table_prefix'].'pm_blacklist WHERE bl_userid = :userid');
	$sth->execute(array(':userid' => $user->data['user_id']));
	$count = $sth->fetchColumn();
	unset($sth);
	
	return $count;
}

function get_rows($offset, $limit) {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT bl_id, bl_userid, bl_blacklisted_userid, bl_time, user_name
	FROM '.$config['table_prefix'].'pm_blacklist
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'pm_blacklist.bl_blacklisted_userid
	WHERE bl_userid = :userid
	ORDER BY bl_id
	LIMIT :offset, :limit');
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->bindValue(':userid', (int) $user->data['user_id'], PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function delete_users($ids) {
	global $dbh, $config;

	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm_blacklist WHERE bl_id IN('.placeholders('?', count($ids)).')');
	$sth->execute($ids);
	unset($sth);

	return true;
}

function insert_users($users = array()) {
	global $dbh, $config, $user;
	
	$time = time();
	$values = array();
	
	foreach($users as $id => $username)
		$values = array_merge($values, array($user->data['user_id'], $id, $time));
	
	unset($id, $username);
	
	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_blacklist (bl_userid, bl_blacklisted_userid, bl_time) VALUES '.placeholders_multi('?', count($values), 3));
	$sth->execute($values);
	unset($sth);

	return true;
}

function get_user($username) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT user_id, user_rank FROM '.$config['table_prefix'].'users WHERE user_name = ?');
	$sth->execute(array($username));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function get_nb_ban($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	$sth->execute(array($id, time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_nb_bl($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(bl_id) FROM '.$config['table_prefix'].'pm_blacklist WHERE bl_userid = ? AND bl_blacklisted_userid = ?');
	$sth->execute(array($user->data['user_id'], $id));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}