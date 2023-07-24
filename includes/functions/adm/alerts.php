<?php
function count_rows($clauses = array(), $keywords = null, $exact = false) {
	global $dbh;
	
	$sth = $dbh->prepare('SELECT COUNT(alert_id) FROM forum_alerts
	LEFT JOIN forum_users ON forum_users.user_id = forum_alerts.alert_userid
	LEFT JOIN forum_posts ON forum_posts.post_id = forum_alerts.alert_postid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($offset, $limit, $clauses = array(), $order = 'alert_id', $keywords = null, $exact = false) {
	global $dbh;
	
	$offset = (int) $offset;
	$limit = (int) $limit;
	
	$sth = $dbh->prepare('SELECT alert_id, alert_reason, alert_time, alert_ip, alert_rank,
	user_name, post_userid, post_username
	FROM forum_alerts
	LEFT JOIN forum_users ON forum_users.user_id = forum_alerts.alert_userid
	LEFT JOIN forum_posts ON forum_posts.post_id = forum_alerts.alert_postid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindParam(':offset', $offset, PDO::PARAM_INT);
	$sth->bindParam(':limit', $limit, PDO::PARAM_INT);
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function delete_alerts($ids) {
	global $dbh;
	
	$sth = $dbh->prepare('DELETE FROM forum_alerts WHERE alert_id IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}

function close_alerts($ids) {
	global $dbh;
	
	$sth = $dbh->prepare('UPDATE forum_alerts SET alert_closed = 1 WHERE alert_id IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}