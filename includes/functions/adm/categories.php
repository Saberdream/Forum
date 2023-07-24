<?php
function count_rows() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(cat_id) FROM '.$config['table_prefix'].'categories');
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT cat_id, cat_name, cat_order FROM '.$config['table_prefix'].'categories ORDER BY cat_order');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function get_cat($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT cat_name, cat_order FROM '.$config['table_prefix'].'categories WHERE cat_id = ? LIMIT 1');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function insert_cat($name, $order) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'categories(cat_name, cat_order) VALUES(?, ?)');
	$sth->execute(array($name, $order));
	unset($sth);
	
	return true;
}

function set_order($id, $order, $new_order) {
	global $dbh, $config, $lang;
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'categories SET cat_order = ? WHERE cat_order = ?');
		$sth->execute(array($order, $new_order));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['categories']['error_occured'].' (001): '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'categories SET cat_order = ? WHERE cat_id = ?');
		$sth->execute(array($new_order, $id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['categories']['error_occured'].' (002): '.$e->getMessage());
	}
	
	$dbh->commit();
	
	return true;
}

function delete_cat($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'categories WHERE cat_id = ?');
	$sth->execute(array($id));
	unset($sth);
			
	return true;
}

function update_name($value, $id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'categories SET cat_name = ? WHERE cat_id = ?');
	$sth->execute(array($value, $id));
	unset($sth);
	
	return true;
}