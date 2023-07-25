<?php
function get_rows() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT smiley_id, smiley_code, smiley_filename, smiley_order FROM '.$config['table_prefix'].'smilies ORDER BY smiley_order');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function count_rows() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(smiley_id) FROM '.$config['table_prefix'].'smilies');
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_order($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT smiley_order FROM '.$config['table_prefix'].'smilies WHERE smiley_id = ?');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function set_order($id, $order, $new_order) {
	global $dbh, $config, $lang;
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'smilies SET smiley_order = ? WHERE smiley_order = ?');
		$sth->execute(array($order, $new_order));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['smilies']['error_occured'].' (001) : '.$e->getMessage());
	}
	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'smilies SET smiley_order = ? WHERE smiley_id = ?');
		$sth->execute(array($new_order, $id));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['smilies']['error_occured'].' (002) : '.$e->getMessage());
	}
	unset($sth);
	
	$dbh->commit();
	
	return true;
}

function delete_rows($ids) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'smilies WHERE smiley_id IN ('.placeholders('?', sizeof($ids)).')');
	$sth->execute(array_values($ids));
	unset($sth);
	
	return true;
}

function set_order_multiple($ids) {
	global $dbh, $config;
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'smilies SET smiley_order = ? WHERE smiley_id = ?');
		
		foreach($ids as $key => $value)
			$sth->execute(array($value, $key));
		
		unset($key, $value, $sth);
		
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['smilies']['error_occured'].': '.$e->getMessage());
	}
	
	$dbh->commit();
	
	return true;
}

function update_code($value, $id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'smilies SET smiley_code = ? WHERE smiley_id = ?');
	$sth->execute(array($value, $id));
	unset($sth);
	
	return true;
}

function create_json() {
	$rows = get_rows();
	$data = '{}';
	
	if(count($rows) > 0) {
		$json = array();
		
		foreach($rows as $value) {
			$json[$value['smiley_filename']] = $value['smiley_code'];
		}
		
		unset($value);
		
		$data = json_encode($json, JSON_FORCE_OBJECT);
	}

	if(file_put_contents(dirname(dirname(dirname(__DIR__))).'/gallery/smilies/smilies.json', $data))
		return true;
	
	return false;
}

function create_pattern() {
	$rows = get_rows();
	$pattern = '';
	
	if(count($rows) > 0) {
		$list = array();
		
		foreach($rows as $value)
			$list[$value['smiley_code']] = $value['smiley_filename'];
		
		unset($value);
		
		$pattern = implode('|', array_map('preg_quote', array_keys($list)));
	}
	
	if(file_put_contents(dirname(dirname(dirname(__DIR__))).'/cache/smilies-pattern.dat', $pattern))
		return true;
	
	return false;
}