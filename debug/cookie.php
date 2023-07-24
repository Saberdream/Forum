<?php
$root_path = '../';
include $root_path.'core.php';

if(!empty($_GET['user'])) {
	try {
		$user->connect($_GET['user'], (isset($_GET['pass']) ? $_GET['pass']:''), true, false);
		print 'Connection successful.';
	}
	catch(Exception $e) {
		print $e->getMessage();
	}
}