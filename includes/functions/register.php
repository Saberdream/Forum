<?php
function check_user($username) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(user_id) FROM '.$config['table_prefix'].'users WHERE user_name = ?');
	$sth->execute(array($username));
	$count = $sth->fetchColumn();
	unset($sth);

	if($count > 0)
		return false;

	return true;
}

function check_email($email) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(user_id) FROM '.$config['table_prefix'].'users WHERE user_email = ?');
	$sth->execute(array(strtolower($email)));
	$count = $sth->fetchColumn();
	unset($sth);

	if($count > 0)
		return false;
	else
		return true;
}

function check_ban_email($email) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT ban_end FROM '.$config['table_prefix'].'banlist WHERE ban_email = ?');
	$sth->execute(array($email));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	if($data) {
		if($data['ban_end'] > 0 && $data['ban_end'] < time()) {
			$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_email = ?');
			$sth->execute(array($email));
			unset($sth);
		}
		else
			return false;
	}

	return true;
}

function check_ban_ip($ip) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT ban_end FROM '.$config['table_prefix'].'banlist WHERE ban_ip = ?');
	$sth->execute(array($ip));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	if($data) {
		if($data['ban_end'] > 0 && $data['ban_end'] < time()) {
			$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_ip = ?');
			$sth->execute(array($ip));
			unset($sth);
		}
		else
			return false;
	}

	return true;
}

function insert_user($username, $password, $email, $ip, $time, $rank) {
	global $dbh, $config, $lang;

	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'users(user_name, user_password, user_email, user_ip, user_time, user_rank, user_avatar, user_sign, user_desc) VALUES('.placeholders('?', 9).')');
	$sth->execute(array($username, $password, $email, $ip, $time, $rank, '', '', ''));
	unset($sth);

	$userid = $dbh->lastInsertId();
	
	if($userid == null)
		return false;

	if(!empty($config['welcome_message'])) {
		$dbh->beginTransaction();
		
		try {
			$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm(pm_username, pm_name, pm_first, pm_last, pm_closed, pm_rank, pm_posts, pm_participants) VALUES('.placeholders('?', 8).')');
			$sth->execute(array('Admin', 'Message de l\'administration', $time, $time, 1, ADMIN, 1, $username));
			unset($sth);
		}
		catch(Exception $e) {
			$dbh->rollback();

			die($lang['register']['error_occured'].': '.$e->getMessage());
		}

		$pm_id = $dbh->lastInsertId();

		try {
			$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_posts(post_pmid, post_username, post_time, post_rank, post_text, post_text_parsed) VALUES('.placeholders('?', 6).')');
			$sth->execute(array($pm_id, 'Admin', $time, ADMIN, $config['welcome_message'], smileys(bbcode($config['welcome_message']))));
			unset($sth);
		}
		catch(Exception $e) {
			$dbh->rollback();

			die($lang['register']['error_occured'].': '.$e->getMessage());
		}
		
		$pm_post_id = $dbh->lastInsertId();
	
		try {
			$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pm_participants(participant_userid, participant_pmid, participant_last) VALUES('.placeholders('?', 3).')');
			$sth->execute(array($userid, $pm_id, $time));
			unset($sth);
		}
		catch(Exception $e) {
			$dbh->rollback();

			die($lang['register']['error_occured'].': '.$e->getMessage());
		}
		
		try {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'pm SET pm_postid = ? WHERE pm_id = ?');
			$sth->execute(array($pm_post_id, $pm_id));
			unset($sth);
		}
		catch(Exception $e) {
			$dbh->rollback();

			die($lang['register']['error_occured'].': '.$e->getMessage());
		}

		$dbh->commit();
	}

	return $userid;
}