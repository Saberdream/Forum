<?php
function count_rows($userid) {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('SELECT COUNT(sub_id) FROM '.$config['table_prefix'].'subscriptions WHERE sub_userid = :userid');
	$sth->execute(array(':userid' => $userid));
	$count = $sth->fetchColumn();
	unset($sth);

	return $count;
}

function get_rows($userid, $offset, $limit) {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('SELECT sub_id, sub_userid, sub_topicid, topic_name, topic_slug
	FROM '.$config['table_prefix'].'subscriptions
	LEFT JOIN '.$config['table_prefix'].'topics ON '.$config['table_prefix'].'topics.topic_id = '.$config['table_prefix'].'subscriptions.sub_topicid
	WHERE sub_userid = :userid ORDER BY sub_id LIMIT :offset, :limit');
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->bindValue(':userid', (int) $userid, PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}

function delete_subscriptions($ids) {
	global $dbh, $config;

	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'subscriptions WHERE sub_id IN('.placeholders('?', count($ids)).')');
	$sth->execute($ids);
	unset($sth);

	return true;
}