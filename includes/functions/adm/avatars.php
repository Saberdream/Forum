<?php
function count_rows($clauses = array(), $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(file_id) FROM '.$config['table_prefix'].'avatars
	LEFT JOIN forum_users ON '.$config['table_prefix'].'avatars.file_userid = forum_users.user_id'
	.(count($clauses) > 0 ? ' WHERE '.implode(' AND ', $clauses) : ''));
	
	if(!empty($keywords))
		$sth->bindValue(':keywords', $exact ? $keywords : '%'.$keywords.'%', PDO::PARAM_STR);
	
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($offset, $limit, $clauses = array(), $order = 'file_id', $keywords = null, $exact = false) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT file_id, file_name, file_width, file_height, file_size, file_mime, file_time, user_name
	FROM '.$config['table_prefix'].'avatars
	LEFT JOIN forum_users ON '.$config['table_prefix'].'avatars.file_userid = forum_users.user_id'
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

function delete_avatars($ids, $upload_dir) {
	global $dbh, $config;
	
	$files = array();
	
	$sth = $dbh->prepare('SELECT file_name FROM '.$config['table_prefix'].'avatars WHERE file_id IN ('.placeholders('?', sizeof($ids)).')');
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
			$sth->execute(array_values($ids));
			unset($sth);
			
			return true;
		}
	}

	return false;
}