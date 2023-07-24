<?php
function count_rows($clauses = array()) {
	global $config, $dbh;

	$sth = $dbh->prepare('SELECT COUNT(connected_sessionid) FROM '.$config['table_prefix'].'connected'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	$sth->execute();
	$count = $sth->fetchColumn();
	unset($sth);

	return $count;
}

function get_rows($offset, $limit, $clauses = array(), $order = 'connected_time') {
	global $config, $dbh;

	$sth = $dbh->prepare('SELECT connected_sessionid, connected_userid, connected_ip, connected_browser, connected_robot, connected_time, connected_last, user_name, user_rank, user_avatar, user_sex
	FROM '.$config['table_prefix'].'connected
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'connected.connected_userid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}