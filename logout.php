<?php
$root_path = './';
include $root_path.'core.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] == GUEST)
	die('Vous ne pouvez pas vous déconnecter.');

if(!isset($_GET['sid']) || $_GET['sid'] != encrypt($user->data['sessionid']))
	die('ID de session incorrect.');

$user->session_kill();

header('Location: '.previous_page(false, './login.php'));