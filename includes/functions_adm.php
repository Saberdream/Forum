<?php
function get_alerts() {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(alert_id) FROM '.$config['table_prefix'].'alerts WHERE alert_closed = 0');
	$sth->execute();
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}
