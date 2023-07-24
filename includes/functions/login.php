<?php
function connect($username, $password, $set_cookie = false, $set_admin = false) {
	global $dbh, $config, $user, $lang;
	
	$time_now = time();
	
	if(empty($username) || !preg_match('/^[a-zA-Z0-9\-]{3,15}$/', $username))
		throw new Exception($lang['login_errors']['invalid_username']);
	
	$sth = $dbh->prepare('SELECT user_id, user_password, user_rank FROM '.$config['table_prefix'].'users WHERE user_name = :username');
	$sth->execute(array(':username' => $username));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	if(!$data)
		throw new Exception($lang['login_errors']['username_not_exists']);
	
	if($data['user_rank'] < USER)
		throw new Exception($lang['login_errors']['cant_connect_guest']);
	
	$sth = $dbh->prepare('SELECT attempt_nb, attempt_time FROM '.$config['table_prefix'].'login_attempts WHERE attempt_ip = ?');
	$sth->execute(array($user->data['ip']));
	$attempts = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	if(!$attempts) {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'login_attempts(attempt_ip, attempt_username, attempt_time, attempt_browser) VALUES('.placeholders('?', 4).')');
		$sth->execute(array($user->data['ip'], $username, $time_now, $user->data['browser']));
		unset($sth);
	}
	elseif($attempts['attempt_nb'] >= $config['max_login_attempts']) {
		if($attempts['attempt_time']+$config['attempt_wait_time'] > $time_now)
			throw new Exception(sprintf($lang['login_errors']['too_many_attempts'], ($attempts['attempt_time']+$config['attempt_wait_time'])-$time_now));
		else {
			$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'login_attempts SET attempt_nb = 0 WHERE attempt_ip = ?');
			$sth->execute(array($user->data['ip']));
			unset($sth);
		}
	}
	
	if($data['user_password'] !== $password) {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'login_attempts SET attempt_username = ?, attempt_time = ?, attempt_browser = ?, attempt_nb = attempt_nb+1 WHERE attempt_ip = ?');
		$sth->execute(array($username, $time_now, $user->data['browser'], $user->data['ip']));
		unset($sth);
		
		throw new Exception($lang['login_errors']['incorrect_password']);
	}
	
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'login_attempts SET attempt_nb = 0 WHERE attempt_ip = ?');
	$sth->execute(array($user->data['ip']));
	unset($sth);

	if($data['user_rank'] < FOUNDER) {
		$sth = $dbh->prepare('SELECT ban_end, ban_reason FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ?');
		$sth->execute(array($data['user_id']));
		$ban = $sth->fetch(PDO::FETCH_ASSOC);
		unset($sth);
		
		if($ban) {
			if($ban['ban_end'] > 0 && $ban['ban_end'] < $time_now) {
				$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ?');
				$sth->execute(array($data['user_id']));
				unset($sth);
			}
			else {
				if($ban['ban_end'] == 0)
					throw new Exception(sprintf($lang['login_errors']['permanently_banned'], display($ban['ban_reason'])));
				else
					throw new Exception(sprintf($lang['login_errors']['temporarily_banned'], display($ban['ban_reason']), round(($ban['ban_end']-$time_now)/86400)));
			}
		}
	}
	
	// updating user last time, ip and eventually the nickname in case it had changed
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_name = ?, user_ip = ?, user_last = ? WHERE user_id = ?');
	$sth->execute(array($username, $user->data['ip'], $time_now, $data['user_id']));
	unset($sth);
	
	// if the visitor is registered, we log up his connection
	$sth = $dbh->prepare('SELECT COUNT(log_id) FROM '.$config['table_prefix'].'login_logs WHERE log_userid = ? AND log_ip = ? AND log_time+3600 > ?');
	$sth->execute(array($data['user_id'], $user->data['ip'], $time_now));
	$count_log = $sth->fetchColumn();
	unset($sth);
	
	if($count_log == 0) {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'login_logs(log_userid, log_username, log_time, log_ip, log_browser) VALUES('.placeholders('?', 5).')');
		$sth->execute(array($data['user_id'], $username, $time_now, $user->data['ip'], $user->data['browser']));
		unset($sth);
	}
	
	if(!$user->session_create($data['user_id'], $set_admin, $set_cookie))
		throw new Exception($lang['login_errors']['session_error']);
	
	return true;
}