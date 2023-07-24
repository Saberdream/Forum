<?php
function get_smileys() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT smiley_id, smiley_code, smiley_filename, smiley_order FROM '.$config['table_prefix'].'smilies ORDER BY smiley_order');
	$sth->execute();
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}