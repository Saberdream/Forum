<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/register.php';
include $root_path.'includes/functions/bbcode.php';
include $root_path.$lang_path.'register.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] > GUEST)
	die(header('Location: ./index'));

$lang['register']['accept_terms'] = sprintf($lang['register']['accept_terms'], $config['server_protocol'].$config['domain_name'].'/register#terms');
$lang['register']['terms_text'] = sprintf($lang['register']['terms_text'], $config['domain_name']);

if(isset($_POST['username']) && $config['allow_register'] == 1) {
	$error = array();

	if(!token::verify('form_register', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/register'))
		$error[] = $lang['register']['invalid_form'];
	else {
		if(!captcha::check())
			$error[] = $lang['register']['incorrect_captcha'];

		if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9\-]{3,15}$/', $_POST['username']))
			$error[] = $lang['register']['invalid_username'];
		elseif(!check_user($_POST['username']))
			$error[] = $lang['register']['username_already_taken'];

		if(empty($_POST['pass']) || mb_strlen($_POST['pass'], 'UTF-8') > 30)
			$error[] = $lang['register']['invalid_password'];

		if(empty($_POST['pass_confirm']) || $_POST['pass'] != $_POST['pass_confirm'])
			$error[] = $lang['register']['passwords_not_identical'];

		if(empty($_POST['email']) || !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['email']))
			$error[] = $lang['register']['invalid_email'];
		elseif(!check_email($_POST['email']))
			$error[] = $lang['register']['email_already_taken'];
		elseif(!check_ban_email($_POST['email']))
			$error[] = $lang['register']['email_banned'];

		if(!check_ban_ip($_SERVER['REMOTE_ADDR']))
			$error[] = $lang['register']['ip_banned'];

		if(!isset($_POST['accept_terms']))
			$error[] = $lang['register']['must_accept_terms'];

		if(empty($error)) {
			$userid = insert_user($_POST['username'], $_POST['pass'], strtolower($_POST['email']), $_SERVER['REMOTE_ADDR'], time(), USER);
			
			if(!$userid)
				$error[] = $lang['register']['insert_error'];
			else {
				$user->session_create($userid);
				$tpl->assign('user', $user->data);
				$ok = sprintf($lang['register']['account_created'], display($_POST['username']), display($_POST['pass']));
			}
		}
	}

	token::destroy('form_register');
}

$token = new token('form_register');

$tpl->assign('form', array(
	'ok' => !empty($ok) ? $ok : '',
	'error' => !empty($error) ? $error : '',
	'username' => !empty($_POST['username']) ? $_POST['username']:'',
	'email' => !empty($_POST['email']) ? $_POST['email']:'',
	'accept_terms' => isset($_POST['accept_terms']) ? true : false,
	'token' => $token->token
));

$tpl->assign(array(
	'open' => (int) $config['allow_register'],
	'lang_register' => $lang['register']
));

$tpl->draw('register');