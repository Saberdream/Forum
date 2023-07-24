<?php
function count_rows($clauses = array(), $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist
	LEFT JOIN forum_users ON '.$config['table_prefix'].'banlist.ban_userid = forum_users.user_id'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($offset, $limit, $clauses = array(), $order = 'ban_id', $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT ban_id, ban_userid, ban_ip, ban_email, ban_start, ban_end, ban_reason, user_name
	FROM '.$config['table_prefix'].'banlist
	LEFT JOIN forum_users ON '.$config['table_prefix'].'banlist.ban_userid = forum_users.user_id'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function delete_rows($ids) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_id IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}