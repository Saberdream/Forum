<?php
/*
 * topics moderation
*/

function get_forum($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_slug, forum_auth_view, forum_auth_topic, forum_auth_reply, forum_auth_edit, forum_auth_alert, forum_auth_lock_topic, forum_auth_stick_topic, forum_auth_delete_topic, forum_auth_delete_post, forum_auth_restore_topic, forum_auth_restore_post, forum_auth_ban, forum_moderators, forum_closed
	FROM '.$config['table_prefix'].'forums
	WHERE forum_id = ? LIMIT 1');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function get_nb_sticky($forumid) {
	global $dbh, $config;

	// we add a clause to don't count the invisibles sticky topics, but it's not supposed to be necessary as the invisible topics are automatically unstick...
	$sth = $dbh->prepare('SELECT COUNT(topic_id) FROM '.$config['table_prefix'].'topics WHERE topic_invisible = 0 AND topic_sticky = 1 AND topic_forumid = ?');
	$sth->execute(array($forumid));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_nb_posts($ids, $forumid, $invisible) {
	global $dbh, $config;

	$values = array($invisible, $forumid);
	$values = array_merge($values, $ids);

	$sth = $dbh->prepare('SELECT SUM(topic_posts_visible) FROM '.$config['table_prefix'].'topics WHERE topic_invisible = ? AND topic_forumid = ? AND topic_id IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function delete_restore_topics($ids, $forumid, $invisible) {
	global $dbh, $config, $lang;

	$values = array($invisible, $forumid);
	$values = array_merge($values, $ids);
	$nb_posts = get_nb_posts($ids, $forumid, $invisible == 1 ? 0 : 1);
	
	if($nb_posts == null)
		return 0;

	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_invisible = ?'.($invisible == 1 ? ', topic_sticky = 0, topic_sticky_order = 0' : '').' WHERE topic_forumid = ? AND topic_id IN('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($values));
		$results = $sth->rowCount();
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['mod_errors']['error_occurred'].' (001): '.$e->getMessage());
	}
	unset($sth);

	if($results > 0) {
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET '.($invisible == 1 ? 'forum_topics_visible = forum_topics_visible-?, forum_posts_visible = forum_posts_visible-?' : 'forum_topics_visible = forum_topics_visible+?, forum_posts_visible = forum_posts_visible+?').' WHERE forum_id = ?');
			$sth->execute(array($results, $nb_posts, $forumid));
		}
		catch(Exception $e) {
			$dbh->rollBack();
			
			die($lang['mod_errors']['error_occurred'].' (002): '.$e->getMessage());
		}
		unset($sth);

		$dbh->commit();
	}

	return $results;
}

function lock_unlock_topics($ids, $forumid, $lock) {
	global $dbh, $config;

	$values = array($lock, $forumid);
	$values = array_merge($values, $ids);

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_lock = ? WHERE topic_invisible = 0 AND topic_forumid = ? AND topic_id IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	$results = $sth->rowCount();
	unset($sth);

	return $results;
}

function stick_topics($ids, $forumid, $nb_sticky) {
	global $dbh, $config, $lang;

	$count = array();
	$results = 0;
	$order = $nb_sticky;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_sticky = 1 WHERE topic_invisible = 0 AND topic_id = ? AND topic_forumid = ?');
	$sth2 = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_sticky_order = ? WHERE topic_invisible = 0 AND topic_id = ? AND topic_forumid = ?');
	
	foreach($ids as $id) {
		$sth->execute(array($id, $forumid));

		$count[$id] = $sth->rowCount();
		$results = $results+$count[$id];

		// we have to make two queries separately because we should increase the forum sticky topics number only if the topics were not already sticked...
		if($count[$id] > 0) {
			$sth2->execute(array($order+1, $id, $forumid));

			$order++;
		}
	}

	unset($id, $sth, $sth2);

	return $results;
}

function unstick_topics($ids, $forumid) {
	global $dbh, $config, $lang;

	$values = array($forumid);
	$values = array_merge($values, $ids);

	// Normally non admins can't modify invisible topics so we should add a clause to avoid this, but invisible topics are not supposed to be sticked, so we consider we don't need to
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_sticky = 0, topic_sticky_order = 0 WHERE topic_forumid = ? AND topic_id IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	$results = $sth->rowCount();
	unset($sth);

	return $results;
}

function get_topic_users($ids, $forumid) {
	global $dbh, $config;
	
	$values = array($forumid);
	$values = array_merge($values, $ids);
	
	$sth = $dbh->prepare('SELECT topic_userid FROM '.$config['table_prefix'].'topics WHERE topic_forumid = ? AND topic_id IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

/*
 * posts moderation
*/

function get_topic($topicid, $forumid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT topic_id, topic_postid, topic_slug, topic_invisible FROM '.$config['table_prefix'].'topics WHERE topic_id = ? AND topic_forumid = ?');
	$sth->execute(array($topicid, $forumid));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function delete_restore_posts($ids, $topicid, $forumid, $topic_postid, $invisible) {
	global $dbh, $config, $lang;
	
	$values = array($invisible, $forumid, $topicid, $topic_postid);
	$values = array_merge($values, $ids);
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'posts SET post_invisible = ? WHERE post_forumid = ? AND post_topicid = ? AND post_id <> ? AND post_id IN('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($values));
		$results = $sth->rowCount();
	}
	catch(Exception $e) {
		$dbh->rollBack();

		die($lang['mod_errors']['error_occurred'].' (001): '.$e->getMessage());
	}
	unset($sth);
	
	if($results > 0) {
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET '.($invisible == 1 ? 'topic_posts_visible = topic_posts_visible-?' : 'topic_posts_visible = topic_posts_visible+?').' WHERE topic_id = ?');
			$sth->execute(array($results, $topicid));
		}
		catch(Exception $e) {
			$dbh->rollBack();

			die($lang['mod_errors']['error_occurred'].' (002): '.$e->getMessage());
		}
		unset($sth);
		
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET '.($invisible == 1 ? 'forum_posts_visible = forum_posts_visible-?' : 'forum_posts_visible = forum_posts_visible+?').' WHERE forum_id = ?');
			$sth->execute(array($results, $forumid));
		}
		catch(Exception $e) {
			$dbh->rollBack();

			die($lang['mod_errors']['error_occurred'].' (003): '.$e->getMessage());
		}
		unset($sth);
		
		$dbh->commit();
	}
	
	return $results;
}

function get_post_users($ids, $topicid, $forumid) {
	global $dbh, $config;
	
	$values = array($forumid, $topicid);
	$values = array_merge($values, $ids);
	
	$sth = $dbh->prepare('SELECT post_userid FROM '.$config['table_prefix'].'posts WHERE post_forumid = ? AND post_topicid = ? AND post_id IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($values));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function ban_users($ids, $duration = 0) {
	global $dbh, $config;
	
	$time = time();
	$values = $count = array();
	$results = 0;
	
	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	
	foreach($ids as $key => $value) {
		$sth->execute(array($value, $time));
		$count[$value] = $sth->fetchColumn();

		if($count[$value] == 0) {
			$values = array_merge($values, array($value, $time, $duration, 'No reason given'));
			$results++;
		}
		else
			unset($ids[$key]);
	}
	unset($sth, $value, $key);

	if(count($values) > 0) {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'banlist(ban_userid, ban_start, ban_end, ban_reason) VALUES '.placeholders_multi('?', sizeof($values), 4));
		$sth->execute($values);
		unset($sth);
		
		delete_sessions($ids);
	}
	
	return $results;
}

function delete_sessions($ids) {
	global $dbh, $config, $lang;
	
	$sth = $dbh->prepare('SELECT connected_sessionid FROM '.$config['table_prefix'].'connected WHERE connected_userid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	$sessions = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	$dbh->beginTransaction();
	
	if(count($sessions) > 0) {
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'sessions SET session_data = ? WHERE session_id = ?');
			
			foreach($sessions as $value)
				$sth->execute(array('', $value['connected_sessionid']));
			
			unset($sth, $value);
		}
		catch(Exception $e) {
			$dbh->rollback();
			
			die($lang['mod_errors']['error_occurred'].' (001): '.$e->getMessage());
		}
	}
	
	try {
		$sth = $dbh->prepare('DELETE FROM forum_keys WHERE key_userid IN ('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($ids));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['mod_errors']['error_occurred'].' (002): '.$e->getMessage());
	}
	
	$dbh->commit();
	
	return true;
}