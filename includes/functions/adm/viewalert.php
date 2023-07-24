<?php
function get_alert($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT alert_id, alert_postid, alert_topicid, alert_forumid, alert_userid, alert_reason, alert_closed, alert_time, alert_page, alert_ip, alert_rank, alert_text,
	user_name, user_avatar, post_userid, post_username, post_time, post_time_edit, post_ip, post_rank,
	topic_postid, topic_name, forum_name
	FROM '.$config['table_prefix'].'alerts
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'alerts.alert_userid
	LEFT JOIN '.$config['table_prefix'].'posts ON '.$config['table_prefix'].'posts.post_id = '.$config['table_prefix'].'alerts.alert_postid
	LEFT JOIN '.$config['table_prefix'].'topics ON '.$config['table_prefix'].'topics.topic_id = '.$config['table_prefix'].'alerts.alert_topicid
	LEFT JOIN '.$config['table_prefix'].'forums ON '.$config['table_prefix'].'forums.forum_id = '.$config['table_prefix'].'alerts.alert_forumid
	WHERE alert_id = :id');
	$sth->execute(array(':id' => $id));
	$alert = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $alert;
}

function get_reasons() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT reason_id, reason_name FROM '.$config['table_prefix'].'alerts_reasons ORDER BY reason_order');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	$data = array();
	
	foreach($rows as $value)
		$data[$value['reason_id']] = $value['reason_name'];
	
	unset($value);
	
	return $data;
}

function update_reason($id, $reason) {
	global $dbh, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'alerts SET alert_reason = ? WHERE alert_id = ?');
	$sth->execute(array($reason, $id));
	unset($sth);

	return true;
}

function close_alert($id) {
	global $dbh, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'alerts SET alert_closed = 1 WHERE alert_id = ?');
	$sth->execute(array($id));
	unset($sth);

	return true;
}

function delete_post($postid, $topicid, $forumid, $topic_postid) {
	global $dbh, $config, $lang;

	$values = array($forumid, $topicid, $topic_postid);
	$values[] = $postid;

	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'posts SET post_invisible = 1 WHERE post_forumid = ? AND post_topicid = ? AND post_id <> ? AND post_id = ?');
		$sth->execute($values);
		$results = $sth->rowCount();
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['viewalert']['error_occurred'].' (001): '.$e->getMessage());
	}
	unset($sth);

	if($results > 0) {
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_posts_visible = topic_posts_visible-? WHERE topic_id = ?');
			$sth->execute(array($results, $topicid));
		}
		catch(Exception $e) {
			$dbh->rollBack();

			die($lang['viewalert']['error_occurred'].' (002): '.$e->getMessage());
		}
		unset($sth);
		
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_posts_visible = forum_posts_visible-? WHERE forum_id = ?');
			$sth->execute(array($results, $forumid));
		}
		catch(Exception $e) {
			$dbh->rollBack();

			die($lang['viewalert']['error_occurred'].' (003): '.$e->getMessage());
		}
		unset($sth);

		$dbh->commit();
	}

	return true;
}

function get_nb_posts($topicid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT topic_posts_visible FROM '.$config['table_prefix'].'topics WHERE topic_invisible = 0 AND topic_id = ?');
	$sth->execute(array($topicid));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	if(isset($data['topic_posts_visible']))
		return $data['topic_posts_visible'];

	return false;
}

function delete_topic($topicid, $forumid) {
	global $dbh, $config, $lang;

	$nb_posts = get_nb_posts($topicid);

	if(!$nb_posts)
		return false;

	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_invisible = 1, topic_sticky = 0, topic_sticky_order = 0 WHERE topic_forumid = ? AND topic_id = ?');
		$sth->execute(array($forumid, $topicid));
		$results = $sth->rowCount();
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['viewalert']['error_occurred'].' (001): '.$e->getMessage());
	}
	unset($sth);

	if($results > 0) {
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_topics_visible = forum_topics_visible-?, forum_posts_visible = forum_posts_visible-? WHERE forum_id = ?');
			$sth->execute(array($results, $nb_posts, $forumid));
		}
		catch(Exception $e) {
			$dbh->rollBack();
			
			die($lang['viewalert']['error_occurred'].' (002): '.$e->getMessage());
		}
		unset($sth);

		$dbh->commit();
	}

	return true;
}

function count_ban($userid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ?');
	$sth->execute(array($userid));
	$count = $sth->fetchColumn();
	unset($sth);

	return $count;
}

function ban($userid, $reason, $duration = 0) {
	global $dbh, $config;

	$time = time();
	$count_ban = count_ban($userid);

	if($count_ban == 0) {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'banlist (ban_userid, ban_start, ban_end, ban_reason) VALUES ('.placeholders('?', 4).')');
		$sth->execute(array($userid, $time, $duration, $reason));
		unset($sth);

		return true;
	}

	return false;
}