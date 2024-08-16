<?php
function get_user($user_id) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT user_id, user_name, user_password, user_email, user_ip, user_time, user_last, user_rank, user_posts, user_avatar, user_sex, user_birthday, user_sign, user_desc, user_country, user_style, user_lang, user_timezone
	FROM '.$config['table_prefix'].'users
	WHERE user_id = ? LIMIT 1');
	$sth->execute(array($_GET['id']));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function update_user($userid, $values) {
	global $dbh, $config;

	$marks = vsprintf(placeholders('%s = ?', count($values)), array_keys($values));
	$values[] = $userid;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET '.$marks.' WHERE user_id = ?');
	$sth->execute(array_values($values));
	unset($sth);

	return true;
}

function get_styles() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/styles/';

	$styles = parse_ini_file($root_dir.'styles.cfg', true);
	
	foreach($styles as $key => $value)
		$styles[$key] = !empty($value['name']) ? $value['name'] : $key;
	
	unset($key, $value);

	return $styles;
}
