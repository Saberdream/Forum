<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/login.php';
include __DIR__.'/'.$lang_path.'login.php';

header('Content-Type: text/html; charset=utf-8');

$connect_adm = false;

if(isset($_GET['mode']) && $_GET['mode'] == 'admin') {
	if($user->data['user_rank'] >= ADMIN)
		$connect_adm = true;
	else
		die(header('Location: ./login'));
}

if($user->data['user_rank'] < USER || ($connect_adm && !$user->data['admin'])) {
	if(!$connect_adm)
		$previous_page = previous_page(!empty($_POST['previous']) ? $_POST['previous'] : false, $config['server_protocol'].$config['domain_name'].'/index');
	else
		$previous_page = './adm/index.php';

	if(isset($_POST['username']) && isset($_POST['password'])) {
		$error = array();
		
		if(token::verify('form_login', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/login'.($connect_adm ? '?mode=admin' : ''))) {
			if(captcha::check()) {
				if(!$connect_adm || (!empty($_POST['username']) && strtolower($_POST['username']) == strtolower($user->data['user_name']))) {
					if(!empty($_POST['password'])) {
						try {
							connect($_POST['username'], $_POST['password'], (isset($_POST['remember']) && !$connect_adm) ? true : false, $connect_adm ? true : false);
						}
						catch(Exception $e) {
							$error[] = $e->getMessage();
						}
						
						if(empty($error))
							die(header('Location: '.$previous_page));
					}
					else
						$error[] = $lang['form_errors']['enter_password'];
				}
				else
					$error[] = $lang['form_errors']['incorrect_username'];
			}
			else
				$error[] = $lang['form_errors']['incorrect_captcha'];
		}
		else
			$error[] = $lang['form_errors']['invalid_form'];
		
		token::destroy('form_login');
	}

	$token = new token('form_login');

	$tpl->assign('form', array(
		'error' => !empty($error) ? $error : null,
		'username' => !empty($_POST['username']) ? $_POST['username'] : '',
		'remember' => isset($_POST['remember']) ? true : false,
		'token' => $token->token,
		'previous' => $previous_page,
	));
}

$tpl->assign(array(
	'title' => $connect_adm ? $lang['login']['connect_acp'] : $lang['login']['connect'],
	'lang_login' => $lang['login'],
	'connect_adm' => $connect_adm
));

$tpl->draw('login');