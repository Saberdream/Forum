<?php
function count_rows() {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(notif_id) FROM '.$config['table_prefix'].'notifications WHERE notif_userid = :userid');
	$sth->execute(array(':userid' => $user->data['user_id']));
	$count = $sth->fetchColumn();
	unset($sth);
	
	return $count;
}

function get_rows($offset, $limit) {
	global $dbh, $user, $config;
	
	$sth = $dbh->prepare('SELECT notif_id, notif_name, notif_desc, notif_url, notif_time, notif_viewed
	FROM '.$config['table_prefix'].'notifications
	WHERE notif_userid = :userid
	ORDER BY FIELD(notif_viewed, 0, 1), notif_time DESC
	LIMIT :offset, :limit');
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->bindValue(':userid', (int) $user->data['user_id'], PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function update_notifications($read) {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'notifications SET notif_viewed = :read WHERE notif_userid = :userid');
	$sth->bindValue(':read', (int) $read, PDO::PARAM_INT);
	$sth->bindValue(':userid', (int) $user->data['user_id'], PDO::PARAM_INT);
	$sth->execute();
	unset($sth);

	return true;
}