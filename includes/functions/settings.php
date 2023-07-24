<?php
function get_user($userid) {
	global $config, $dbh;

	$sth = $dbh->prepare('SELECT user_password, user_email, user_avatar, user_avatarid, user_sex, user_birthday, user_sign, user_desc, user_country, user_style, user_lang, user_timezone FROM '.$config['table_prefix'].'users WHERE user_id = ?');
	$sth->execute(array($userid));
	$user = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $user;
}

function update_user($userid, $values) {
	global $config, $dbh;
	
	$marks = vsprintf(placeholders('%s = ?', count($values)), array_keys($values));
	$values[] = $userid;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET '.$marks.' WHERE user_id = ?');
	$sth->execute(array_values($values));
	unset($sth);

	return true;
}

function get_styles() {
	global $root_path;
	
	$rd = scandir($root_path.'styles/');
	$styles = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_path.'styles/'.$dir) && $dir != '.' && $dir != '..')
			$styles[$dir] = $dir;
	}
	
	unset($dir);
	
	return $styles;
}

function get_langs() {
	global $root_path;
	
	$rd = scandir($root_path.'lang/');
	$langs = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_path.'lang/'.$dir) && $dir != '.' && $dir != '..')
			$langs[$dir] = $dir;
	}
	
	unset($dir);
	
	return $langs;
}
