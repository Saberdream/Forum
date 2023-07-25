<?php
function get_pm($topic) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT pm_id, pm_postid, pm_userid, pm_username, pm_name, pm_first, pm_last, pm_closed, pm_rank, pm_posts, pm_nb_participants, pm_participants, user_name
	FROM '.$config['table_prefix'].'pm
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'pm.pm_userid
	WHERE pm_id = ?');
	$sth->execute(array($topic));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function count_rows($id, $clauses = array()) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'pm_posts'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($id, $offset, $limit, $clauses = array(), $order = 'post_id') {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT post_id, post_userid, post_username, post_time, post_ip, post_rank, post_text_parsed, user_rank, user_avatar
	FROM '.$config['table_prefix'].'pm_posts
	LEFT JOIN '.$config['table_prefix'].'users ON '.$config['table_prefix'].'users.user_id = '.$config['table_prefix'].'pm_posts.post_userid'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : '').
	' ORDER BY '.$order.' LIMIT :offset, :limit');
	$sth->bindValue(':id', (int) $id, PDO::PARAM_INT);
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}

function insert_post($pmid, $post, $post_parsed) {
	global $dbh, $config, $user, $lang;
	
	$time = time();
	
	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_posts(post_pmid, post_userid, post_username, post_time, post_ip, post_rank, post_text, post_text_parsed) VALUES('.placeholders('?', 8).')');
		$sth->execute(array($pmid, $user->data['user_id'], $user->data['user_name'], $time, $_SERVER['REMOTE_ADDR'], $user->data['user_rank'], $post, $post_parsed));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['viewpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);

	$postid = $dbh->lastInsertId();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_posts = pm_posts+1, pm_last = ? WHERE pm_id = ?');
		$sth->execute(array($time, $pmid));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['viewpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_ip = ?, user_last = ?, user_posts = user_posts+1 WHERE user_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $user->data['user_id']));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['viewpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);

	$participants = get_participants($pmid);

	if(count($participants) > 0) {
		$values = array();
		$counter = 0;
		
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm_participants SET participant_read = ?, participant_last = ? WHERE participant_pmid = ? AND participant_userid = ?');

		foreach($participants as $value) {
			if($value['participant_userid'] != $user->data['user_id'])
				$sth->execute(array(0, $value['participant_last'], $pmid, $value['participant_userid']));
			else
				$sth->execute(array(1, $time, $pmid, $value['participant_userid']));
		}

		unset($value, $sth);
	}

	$dbh->commit();

	return $postid;
}

function insert_participants($pmid, $participants, $new_participants) {
	global $dbh, $config, $lang;

	$time = time();
	
	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_participants = ?, pm_nb_participants = ? WHERE pm_id = ?');
		$sth->execute(array(implode(';', $participants), sizeof($participants), $pmid));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].': '.$e->getMessage());
	}

	try {
		$values = array();
		
		foreach($new_participants as $id => $username)
			$values = array_merge($values, array($id, $pmid, $time));
		
		unset($id, $username);
		
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_participants (participant_userid, participant_pmid, participant_last) VALUES '.placeholders_multi('?', count($values), 3));
		$sth->execute($values);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);
	
	$dbh->commit();
	
	return true;
}

function get_participants($pmid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT participant_userid, participant_last FROM '.$config['table_prefix'].'pm_participants WHERE participant_pmid = ?');
	$sth->execute(array($pmid));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function get_nb_posts() {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'pm_posts WHERE post_userid = ? AND post_time+? > ?');
	$sth->execute(array($user->data['user_id'], $config['pm_reply_flood_time'], time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_nb_ban($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	$sth->execute(array($id, time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_user_id($username) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT user_id FROM '.$config['table_prefix'].'users WHERE user_name = ?');
	$sth->execute(array($username));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function delete_user($pmid, $userid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'pm_participants WHERE participant_userid = ? AND participant_pmid = ?');
	$sth->execute(array($userid, $pmid));
	unset($sth);
	
	return true;
}

function update_participants($pmid, $participants) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_nb_participants = pm_nb_participants-1, pm_participants = ? WHERE pm_id = ? AND pm_nb_participants <> 0');
	$sth->execute(array($participants, $pmid));
	unset($sth);
	
	return true;
}

function close_pm($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_closed = 1 WHERE pm_id = ?');
	$sth->execute(array($id));
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

function get_nb_bl($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(bl_id) FROM '.$config['table_prefix'].'pm_blacklist WHERE bl_userid = ? AND bl_blacklisted_userid = ?');
	$sth->execute(array($id, $user->data['user_id']));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}