<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/recover.php';
include __DIR__.'/'.$lang_path.'recover.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] > GUEST)
	die(header('Location: ./index'));

if(isset($_POST['username'])) {
	$error = array();

	if(!token::verify('form_recover', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/recover'))
		$error[] = $lang['recover']['invalid_form'];
	else {
		if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9\-]{3,15}$/', $_POST['username']))
			$error[] = $lang['recover']['invalid_username'];

		if(empty($_POST['email']) || !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['email']))
			$error[] = $lang['recover']['invalid_email'];

		if(!captcha::check())
			$error[] = $lang['recover']['incorrect_captcha'];
		else {
			$data = get_user($_POST['username']);

			if(!$data)
				$error[] = $lang['recover']['username_not_exists'];
			else {
				if($data['user_rank'] == GUEST)
					$error[] = $lang['recover']['cant_recover_password'];

				if(strtolower($_POST['email']) != $data['user_email'])
					$error[] = $lang['recover']['username_email_not_match'];

				if(count($error) == 0) {
					$mail_text = sprintf($lang['recover']['mail_body'], $config['server_protocol'].$config['domain_name'].'/', $config['domain_name'], htmlspecialchars($_POST['username']), htmlspecialchars($data['user_password']), $config['domain_name']);
					if(send_mail($_POST['username'], $data['user_password'], $data['user_email'], $lang['recover']['password_recovery'], $mail_text))
						$ok = $lang['recover']['email_sent_success'];
					else
						$error[] = $lang['recover']['mail_not_sent'];
				}
			}
		}
	}

	token::destroy('form_recover');
}

$tpl->assign(array(
	'title' => $lang['recover']['forgot_password'],
	'lang_recover' => $lang['recover']
));

$token = new token('form_recover');

$tpl->assign('form', array(
	'ok' => !empty($ok) ? $ok : '',
	'error' => !empty($error) ? $error : '',
	'username' => !empty($_POST['username']) ? $_POST['username']:'',
	'email' => !empty($_POST['email']) ? $_POST['email']:'',
	'token' => $token->token,
));

$tpl->draw('recover');