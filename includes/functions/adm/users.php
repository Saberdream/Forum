<?php
function count_rows($clauses = array(), $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(user_id) FROM '.$config['table_prefix'].'users'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($offset, $limit, $clauses = array(), $order = 'user_id', $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT user_id, user_name, user_password, user_email, user_ip, user_time, user_last, user_rank, user_posts, user_avatar, user_sign
	FROM '.$config['table_prefix'].'users'
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

function ban_users($ids, $duration = 0) {
	global $dbh, $config;
	
	$time = time();
	$values = $count = array();

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	
	foreach($ids as $key => $value) {
		$sth->execute(array($value, $time));
		$count[$value] = $sth->fetchColumn();
		
		if($count[$value] == 0)
			$values = array_merge($values, array($value, $time, $duration, 'No reason given'));
		else
			unset($ids[$key]);
	}
	
	unset($sth, $key, $value);
	
	if(count($values) > 0) {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'banlist (ban_userid, ban_start, ban_end, ban_reason) VALUES '.placeholders_multi('?', count($values), 4));
		$sth->execute(array_values($values));
		unset($sth);
		
		delete_sessions($ids);
	}
	
	return true;
}

function deban_users($ids) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_userid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}

function delete_users($ids) {
	global $dbh, $config, $lang;
	
	$upload_dir = dirname(dirname(dirname(__DIR__))).'/gallery/avatars/';
	
	// delete avatars files and rows in db
	$sth = $dbh->prepare('SELECT file_name FROM '.$config['table_prefix'].'avatars WHERE file_userid IN('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	$avatars = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	$dbh->beginTransaction();
	
	if(count($avatars) > 0) {
		$files = array();
		
		foreach($avatars as $value)
			array_push($files, $upload_dir.$value['file_name'], $upload_dir.'thumbs/'.$value['file_name']);
		
		unset($value);
		
		if(count(array_filter($files, 'file_exists')) > 0)
			array_map('unlink', array_filter($files, 'file_exists'));
		
		try {
			$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'avatars WHERE file_userid IN ('.placeholders('?', sizeof($ids)).')');
			$sth->execute(array_values($ids));
			unset($sth);
		}
		catch(Exception $e) {
			$dbh->rollBack();
			
			die($lang['user']['error_occurred'].': '.$e->getMessage());
		}
		
		if(count(array_filter($files, 'file_exists')) > 0) {
			$dbh->rollBack();
			
			die($lang['user']['files_not_deleted']);
		}
	}
	
	// delete users rows in db
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'banlist WHERE ban_userid IN ('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($ids));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['user']['error_occurred'].': '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'keys WHERE key_userid IN ('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($ids));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['user']['error_occurred'].': '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'users WHERE user_id IN ('.placeholders('?', sizeof($ids)).')');
		$sth->execute(array_values($ids));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['user']['error_occurred'].': '.$e->getMessage());
	}
	
	$dbh->commit();
	
	delete_sessions($ids);
	
	return true;
}

function delete_sessions($ids) {
	global $dbh, $config, $lang;
	
	$sth = $dbh->prepare('SELECT connected_sessionid FROM '.$config['table_prefix'].'connected WHERE connected_userid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	$sessions = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	if(count($sessions) > 0) {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'sessions SET session_data = ? WHERE session_id = ?');
		
		foreach($sessions as $value)
			$sth->execute(array('', $value['connected_sessionid']));
		
		unset($sth, $value);
	}

	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'keys WHERE key_userid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}