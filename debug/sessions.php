<?php
header('Content-Type: text/html; charset=utf-8');

function random($length = 30) {
	$pool = array_merge(range(0,9), range('a', 'z'));
	for($i=0; $i < $length; $i++) {
		$key .= $pool[mt_rand(0, count($pool) - 1)];
	}
	return $key;
}

session_set_cookie_params(0, '/', '', false, true);

if(session_id() == '') {
	session_start();
}

function get_path() {
	return session_save_path();
}

if(isset($_GET['unlink']) && $_GET['unlink'] == 1) {
	if(file_exists(get_path().'/sess_'.session_id())) {
		chmod(get_path().'/sess_'.session_id(), 0777);
		unlink(get_path().'/sess_'.session_id());
	}
	echo '<p><b>Ok</b></p>';
}

$sessions = scandir(get_path());

foreach($sessions as $name):
	if($name != '.' && $name != '..' && $name == 'sess_'.session_id())
		echo get_path().'/'.$name.' (<a href="sessions.php?unlink=1">Delete</a>)';
endforeach;