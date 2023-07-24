<?php
function count_rows($userid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(file_id) FROM '.$config['table_prefix'].'avatars WHERE file_userid = ?');
	$sth->execute(array($userid));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_rows($userid, $offset, $limit) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT file_id, file_name, file_width, file_height, file_size, file_mime, file_time
	FROM '.$config['table_prefix'].'avatars
	WHERE file_userid = :userid
	ORDER BY file_id LIMIT :offset, :limit',
	array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
	$sth->bindValue(':userid', (int) $userid, PDO::PARAM_INT);
	$sth->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$sth->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
	$sth->execute();
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function get_avatar($userid, $avatarid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT file_name FROM '.$config['table_prefix'].'avatars WHERE file_userid = ? AND file_id = ?');
	$sth->execute(array($userid, $avatarid));
	$avatar = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $avatar;
}

function update_avatar($userid, $filename, $fileid) {
	global $dbh, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_avatar = ?, user_avatarid = ? WHERE user_id = ?');
	$sth->execute(array($filename, $fileid, $userid));
	unset($sth);

	return true;
}

function delete_avatars($userid, $ids, $uploadDir) {
	global $dbh, $config;

	$files = $array();

	$sth = $dbh->prepare('SELECT file_name FROM '.$config['table_prefix'].'avatars WHERE file_id = ? AND file_userid IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	if($data) {
		foreach($data as $value)
				array_push($files, $upload_dir.$value['file_name'], $upload_dir.'thumbnails/'.$value['file_name']);

		unset($value);

		$exists = array_filter($files, 'file_exists');

		if(count($exists) > 0)
			array_map('unlink', $exists);

		if(count(array_filter($files, 'file_exists')) == 0) {
			$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'avatars WHERE file_id IN ('.placeholders('?', sizeof($ids)).')');
			$sth->execute($ids);
			unset($sth);

			return true;
		}
	}

	return false;
}

function count_files($userid, $waitTime, $time) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(file_id) FROM '.$config['table_prefix'].'avatars WHERE file_time+? > ? AND file_userid = ?');
	$sth->execute(array($waitTime, $time, $userid));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function insert_rows($userid, $newName, $width, $height, $filesize, $mime, $time, $ip) {
	global $dbh, $config;

	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'avatars(file_userid, file_name, file_width, file_height, file_size, file_mime, file_time, file_ip) VALUES('.placeholders('?', 8).')');
	$sth->execute(array($userid, $newName, $width, $height, $filesize, $mime, $time, $ip));
	unset($sth);

	return true;
}
