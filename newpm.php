<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/newpm.php';
include __DIR__.'/includes/functions/bbcode.php';
include __DIR__.'/'.$lang_path.'newpm.php';
include __DIR__.'/'.$lang_path.'bbcode.php';
include __DIR__.'/'.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	if(!empty($_POST)) {
		$error = array();
		$pm_participants = array($user->data['user_id'] => $user->data['user_name']);
		$time = time();

		if(!token::verify('newpm', $config['form_expiration_time']))
			$error[] = $lang['newpm']['expired_form'];
		else {
			if($config['pm_captcha'] == 1 && !captcha::check())
				$error[] = $lang['newpm']['incorrect_code'];

			if(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
				$error[] = $lang['newpm']['poster_banned'];

			if(empty($_POST['recipients']) || mb_strlen($_POST['recipients'], 'UTF-8') > 1000)
				$error[] = $lang['newpm']['no_recipient_too_long'];
			else {
				if(strpos($_POST['recipients'], ';'))
					$participants = explode(';', $_POST['recipients']);
				else
					$participants = array($_POST['recipients']);

				$usernames = $users = array();

				foreach($participants as $username) {
					if(!preg_match('#^[a-zA-Z0-9-]{3,15}$#', $username))
						$error[] = sprintf($lang['newpm']['invalid_recipient_name'], display($username));
					else {
						if(strtolower($username) == strtolower($user->data['user_name']))
							$error[] = $lang['newpm']['self_username'];
						elseif(in_array(strtolower($username), $usernames))
							$error[] = sprintf($lang['newpm']['recipient_duplicate'], display($username));
						else {
							$users[$username] = get_user($username);
							
							if(!$users[$username])
								$error[] = sprintf($lang['newpm']['recipient_not_exists'], display($username));
							elseif($users[$username]['user_rank'] == GUEST)
								$error[] = sprintf($lang['newpm']['cant_send_message'], display($username));
							elseif(get_nb_ban($users[$username]['user_id']) > 0)
								$error[] = sprintf($lang['newpm']['banned_recipient'], display($username));
							elseif(get_nb_bl($users[$username]['user_id']) > 0)
								$error[] = sprintf($lang['newpm']['blacklisted_recipient'], display($username));
							else
								$pm_participants[$users[$username]['user_id']] = $username;
						}

						$usernames[] = strtolower($username);
					}
				}

				unset($username);
			}

			if(empty($_POST['subject']))
				$error[] = $lang['newpm']['topic_not_filled'];
			elseif(mb_strlen($_POST['subject'], 'UTF-8') > $config['pm_max_size'])
				$error[] = sprintf($lang['newpm']['topic_too_long'], intval($config['pm_max_size']));
			
			if(empty($_POST['message']))
				$error[] = $lang['newpm']['message_not_filled'];
			elseif(mb_strlen($_POST['message'], 'UTF-8') > $config['pm_reply_max_size'])
				$error[] = sprintf($lang['newpm']['message_too_long'], intval($config['pm_reply_max_size']));
			
			if($user->data['user_rank'] < ADMIN && $config['pm_flood_time'] > 0) {
				$nb = get_nb_pm();
				
				if($nb > 0) {
					$error[] = sprintf($lang['newpm']['flood_time_pm'], intval($config['pm_flood_time']));
				}
			}
		}

		token::destroy('newpm');
		
		if(empty($error)) {
			$text_parsed = smileys(bbcode($_POST['message']));

			$pm_id = insert_pm($_POST['subject'], $_POST['message'], $text_parsed, $pm_participants);

			if(!$pm_id)
				die($lang['newpm']['topic_not_posted']);

			die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/viewpm?id='.$pm_id));
		}
	}

	$token_new = new token('newpm');
	$token_preview = new token('preview');

	$tpl->assign(array(
		'lang_bbcode' => $lang['bbcode'],
		'preview_token' => $token_preview->token
	));

	$tpl->assign('form', array(
		'error' => !empty($error) ? $error : null,
		'captcha' => (bool) $config['pm_captcha'],
		'token' => $token_new->token,
		'recipients' => !empty($_POST['recipients']) ? $_POST['recipients'] : '',
		'subject' => !empty($_POST['subject']) ? $_POST['subject'] : '',
		'message' => !empty($_POST['message']) ? $_POST['message'] : ''
	));
}

$tpl->assign(array(
	'lang_newpm' => $lang['newpm'],
));

$tpl->draw('newpm');