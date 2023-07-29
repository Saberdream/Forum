<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'			=> 'You are not authorized to access this part of the site',
	'connect'			=> 'Login',
	'connect_acp'			=> 'Admin Panel Login',
	'page_description'			=> 'You can choose to set a cookie to enable automatic login so you don\'t have to log in again on your next visit.',
	'page_description_acp'			=> 'Welcome to the admin panel login page. ',
	'username'			=> 'Pseudo',
	'password'			=> 'Password',
	'validate'			=> 'To validate',
	'already_connected'			=> 'You are already connected.',
	'already_connected_acp'			=> 'You are already logged in to the administration.',
	'copy_code'			=> 'Copy the code',
	'ask_new_code'			=> 'Request a new code',
	'enter_username'			=> 'Enter nickname',
	'errors_occurred'			=> 'One or more errors occurred',
	'automatic_connection'			=> 'Automatic connection',
	'account'			=> 'My account',
	'users_connected'			=> 'Connected users',
);

$lang['form_errors'] = array(
	'enter_password'			=> 'You must enter a password.',
	'incorrect_username'			=> 'The nickname is incorrect.',
	'incorrect_captcha'			=> 'The confirmation code is not filled in correctly/is incorrect.',
	'invalid_form'			=> 'The form is invalid, please try again.',
);

$lang['login_errors'] = array(
	'invalid_username'			=> 'The nickname is invalid.',
	'username_not_exists'			=> 'This nickname does not exist.',
	'cant_connect_guest'			=> 'You cannot log into a guest account.',
	'too_many_attempts'			=> 'You have made too many login attempts, you must wait another %d second(s) before trying to login again.',
	'incorrect_password'			=> 'The account password is incorrect.',
	'permanently_banned'			=> 'The nickname is banned for the reason "%s" for a permanent period.',
	'temporarily_banned'			=> 'The nickname is banned for the reason "%s" for a duration of %d day(s).',
	'session_error'			=> 'Invalid or non-existent session, please try again later.',
);
