<?php
$root_path = '../';
include $root_path.'core.php';
include $root_path.'includes/adm/functions.php';

$pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : 'Alpha';

$db->query('SELECT * FROM forum_users WHERE user_name = :pseudo');
$db->bind(':pseudo', $pseudo, PDO::PARAM_STR);
$query = $db->single();


echo md5(uniqid(rand(), true));

echo '<hr>';

$session_params = array(
	'session.cookie_lifetime',
	'session.cookie_path',
	'session.cookie_domain',
	'session.cookie_secure',
	'session.cookie_httponly',
	'session.use_cookies',
);

foreach ($session_params as $name) {
	echo $name.' : <b>';
	if(is_bool(ini_get($name)))
		echo '(bool) '.ini_get($name) ? 'true' : 'false';
	else
		echo '(str) '.ini_get($name);
	echo '</b><br>';
}

echo '<p>Session id : '.session_id().'</p>';
if(isset($_GET['user']))
	if(setrawcookie('ucpautolog', 'login:'.$_GET['user'].'|'.encrypt('123456'), time()+3600, '/', '', false, true))
		echo '<p>cookie created : login:'.$_GET['user'].'|'.encrypt('123456').'</p>';