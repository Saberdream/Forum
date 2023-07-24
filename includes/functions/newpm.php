<?php
function insert_pm($topic, $post, $post_parsed, $participants = array()) {
	global $dbh, $config, $user, $lang;
	
	$time = time();
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm(pm_userid, pm_username, pm_name, pm_first, pm_last, pm_closed, pm_rank, pm_posts, pm_nb_participants, pm_participants) VALUES('.placeholders('?', 10).')');
		$sth->execute(array($user->data['user_id'], $user->data['user_name'], $topic, $time, $time, 0, $user->data['user_rank'], 1, sizeof($participants), implode(';', $participants)));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['newpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);
	
	$pm_id = $dbh->lastInsertId();
	
	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_posts(post_pmid, post_userid, post_username, post_time, post_ip, post_rank, post_text, post_text_parsed) VALUES('.placeholders('?', 8).')');
		$sth->execute(array($pm_id, $user->data['user_id'], $user->data['user_name'], $time, $_SERVER['REMOTE_ADDR'], $user->data['user_rank'], $post, $post_parsed));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['newpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);
	
	$post_id = $dbh->lastInsertId();

	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_ip = ?, user_last = ? WHERE user_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $user->data['user_id']));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['newpm']['error_occured'].': '.$e->getMessage());
	}

	unset($sth);

	if(count($participants) > 0) {
		try {
			$values = array();
			
			foreach($participants as $id => $username)
				$values = array_merge($values, array($id, $pm_id, $time));
			
			unset($id, $username);
			
			$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_participants (participant_userid, participant_pmid, participant_last) VALUES '.placeholders_multi('?', count($values), 3));
			$sth->execute($values);
		}
		catch(Exception $e) {
			$dbh->rollback();
			
			die($lang['newpm']['error_occured'].': '.$e->getMessage());
		}

		unset($sth);
	}
	
	$dbh->commit();
	
	return $pm_id;
}

function get_nb_pm() {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(pm_id) FROM '.$config['table_prefix'].'pm WHERE pm_userid = ? AND pm_first+? > ?');
	$sth->execute(array($user->data['user_id'], $config['pm_flood_time'], time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
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
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	$sth->execute(array($id, time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_nb_bl($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(bl_id) FROM '.$config['table_prefix'].'pm_blacklist WHERE bl_userid = ? AND bl_blacklisted_userid = ?');
	$sth->execute(array($id, $user->data['user_id']));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}
