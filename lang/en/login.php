<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'	=> 'You are not authorized to access this part of the site',
	'connect'	=> 'Connection',
	'connect_acp'	=> 'Login to the admin panel',
	'page_description'	=> 'You may choose to set a cookie to enable automatic login so that you do not have to log in again on your next visit.',
	'page_description_acp'	=> 'Welcome to the admin panel login page. ',
	'username'	=> 'Pseudo',
	'password'	=> 'Password',
	'validate'	=> 'To validate',
	'already_connected'	=> 'You are already logged in.',
	'already_connected_acp'	=> 'You are already connected to the administration.',
	'copy_code'	=> 'Copy the code',
	'ask_new_code'	=> 'Request a new code',
	'enter_username'	=> 'Enter nickname',
	'errors_occurred'	=> 'One or more errors have occurred',
	'automatic_connection'	=> 'Automatic connection',
	'account'	=> 'My account',
	'users_connected'	=> 'Logged in users',
);

$lang['form_errors'] = array(
	'enter_password'	=> 'You must enter a password.',
	'incorrect_username'	=> 'The nickname is incorrect.',
	'incorrect_captcha'	=> 'The confirmation code is not correctly filled/is incorrect.',
	'invalid_form'	=> 'The form is invalid, please try again.',
);

$lang['login_errors'] = array(
	'invalid_username'	=> 'The nickname is invalid.',
	'username_not_exists'	=> 'This nickname does not exist.',
	'cant_connect_guest'	=> 'You cannot log in to a guest account.',
	'too_many_attempts'	=> 'You have made too many connection attempts, you still need to wait %d second(s) before trying to connect again.',
	'incorrect_password'	=> 'The account password is incorrect.',
	'permanently_banned'	=> 'The nickname is banned for the reason “%s” for a permanent period.',
	'temporarily_banned'	=> 'The nickname is banned for the reason “%s” for a period of %d day(s).',
	'session_error'	=> 'Incorrect or non-existent session, please try again later.',
);
