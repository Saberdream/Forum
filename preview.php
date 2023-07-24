<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/bbcode.php';
include $root_path.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_POST['message']) || empty($_POST['message']))
	die($lang['preview']['message_not_filled']);

if($user->data['user_rank'] < USER)
	die($lang['preview']['not_logged_in']);

if(!token::verify('preview', $config['form_expiration_time']))
	die($lang['preview']['expired_form']);

if(mb_strlen($_POST['message'], 'UTF-8') > $config['post_max_size'])
	die($lang['preview']['message_too_long']);

echo smileys(bbcode($_POST['message']));