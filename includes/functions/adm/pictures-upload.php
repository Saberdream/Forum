<?php
function count_files($waitTime, $time) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT COUNT(file_id) FROM '.$config['table_prefix'].'pictures WHERE file_time+? > ?');
	$sth->execute(array($waitTime, $time));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function insert_rows($filename, $width, $height, $filesize, $mime, $time) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'pictures(file_userid, file_name, file_width, file_height, file_size, file_mime, file_time, file_ip) VALUES('.placeholders('?', 8).')');
	$sth->execute(array($user->data['user_id'], $filename, $width, $height, $filesize, $mime, $time, $user->data['ip']));
	unset($sth);
	
	return true;
}