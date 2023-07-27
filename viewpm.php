<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/viewpm.php';
include __DIR__.'/includes/functions/bbcode.php';
include __DIR__.'/'.$lang_path.'viewpm.php';
include __DIR__.'/'.$lang_path.'bbcode.php';
include __DIR__.'/'.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
		die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/index'));

	$pm = get_pm($_GET['id']);

	if(!$pm)
		die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/index'));

	$limit = (int) 15;
	$participants = explode(';', $pm['pm_participants']);
	$in_pm = in_array(strtolower($user->data['user_name']), array_map('strtolower', $participants)) ? true : false;

	if($in_pm) {
		if($pm['pm_closed'] == 0) {
			if(isset($_POST['message'])) {
				$error = array();
				$time = time();

				if(!token::verify('pm_reply', $config['form_expiration_time']))
					$error[] = $lang['viewpm']['expired_form'];
				else {
					if($config['pm_reply_captcha'] == 1 && !captcha::check())
						$error[] = $lang['viewpm']['incorrect_code'];

					if(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
						$error[] = $lang['viewpm']['poster_banned'];

					if(empty($_POST['message']))
						$error[] = $lang['viewpm']['message_not_filled'];
					elseif(mb_strlen($_POST['message'], 'UTF-8') > $config['pm_reply_max_size'])
						$error[] = sprintf($lang['viewpm']['message_too_long'], intval($config['pm_reply_max_size']));

					if($user->data['user_rank'] < ADMIN && $config['pm_reply_flood_time'] > 0) {
						$nb = get_nb_posts();

						if($nb > 0)
							$error[] = sprintf($lang['viewpm']['flood_time_message'], intval($config['pm_reply_flood_time']));
					}
				}

				token::destroy('pm_reply');

				if(empty($error)) {
					$text_parsed = smileys(bbcode($_POST['message']));

					$post_id = insert_post($pm['pm_id'], $_POST['message'], $text_parsed);
					
					if(!$post_id)
						die($lang['viewpm']['message_not_posted']);
					
					die(header('Location: '.$config['server_protocol'].$config['domain_name'].'/viewpm?id='.$pm['pm_id'].'&page='.ceil(($pm['pm_posts']+1)/$limit).'#post_'.$post_id));
				}
			}
			
			if($pm['pm_userid'] == $user->data['user_id']) {
				if(isset($_GET['action'])) {
					if(!token::verify('viewpm_action', $config['form_expiration_time'], 'get'))
						die($lang['viewpm']['expired_token']);

					switch($_GET['action']) {
						case 'close':
							close_pm($pm['pm_id']);
							
							die($lang['viewpm']['successful_closed']);
							
							break;
						
						case 'exclude':
							if(isset($_GET['user']) && mb_strlen($_GET['user'], 'UTF-8') <= 15 && strtolower($_GET['user']) != strtolower($user->data['user_name']) && in_array(strtolower($_GET['user']), array_map('strtolower', $participants))) {
								$userid = get_user_id($_GET['user']);

								if(delete_user($pm['pm_id'], (int) $_GET['id'])) {
									foreach($participants as $key => $username) {
										if(strtolower($username) == strtolower($_GET['user']))
											unset($participants[$key]);
									}

									update_participants($pm['pm_id'], implode(';', $participants));

									die($lang['viewpm']['user_correctly_excluded']);
								}
							}

							break;
					}

					token::destroy('viewpm_action');
					
					die($lang['viewpm']['error_occurred']);
				}
				
				if(isset($_POST['participants'])) {
					$error = array();
					$time = time();
					$new_participants = array();
					
					if(!token::verify('viewpm_add', $config['form_expiration_time']))
						$error[] = $lang['viewpm']['expired_form'];
					else {
						if(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
							$error[] = $lang['viewpm']['poster_banned'];
						
						if(empty($_POST['participants']) || mb_strlen($_POST['participants'], 'UTF-8') > 1000)
							$error[] = $lang['viewpm']['no_user_too_long'];
						else {
							if(strpos($_POST['participants'], ';'))
								$post_participants = explode(';', $_POST['participants']);
							else
								$post_participants = array($_POST['participants']);

							$usernames = $users = array();

							foreach($post_participants as $username) {
								if(!preg_match('#^[a-zA-Z0-9-]{3,15}$#', $username))
									$error[] = sprintf($lang['viewpm']['invalid_username'], display($username));
								else {
									if(in_array(strtolower($username), array_map('strtolower', $participants)))
										$error[] = sprintf($lang['viewpm']['user_already_in'], display($username));
									elseif(in_array(strtolower($username), $usernames))
										$error[] = sprintf($lang['viewpm']['user_duplicate'], display($username));
									else {
										$users[$username] = get_user($username);
										
										if(!$users[$username])
											$error[] = sprintf($lang['viewpm']['user_not_exists'], display($username));
										elseif($users[$username]['user_rank'] == GUEST)
											$error[] = sprintf($lang['viewpm']['cant_add_user'], display($username));
										elseif(get_nb_ban($users[$username]['user_id']) > 0)
											$error[] = sprintf($lang['viewpm']['banned_user'], display($username));
										elseif(get_nb_bl($users[$username]['user_id']) > 0)
											$error[] = sprintf($lang['viewpm']['blacklisted_user'], display($username));
										else
											$new_participants[$users[$username]['user_id']] = $username;
									}

									$usernames[] = strtolower($username);
								}
							}

							unset($username);
						}
					}
					
					token::destroy('viewpm_add');
					
					if(empty($error)) {
						$participants = array_merge($participants, array_values($new_participants));
						$pm['pm_nb_participants'] = $pm['pm_nb_participants']+sizeof($new_participants);
						
						if(insert_participants($pm['pm_id'], $participants, $new_participants))
							$ok = $lang['viewpm']['users_successful_added'];
						else
							$error[] = $lang['viewpm']['error_occurred'];
					}
				}
			}
		}

		$title = $lang['viewpm']['read_private_message'];
		$clauses = array('post_pmid = :id');
		$nb = $pm['pm_posts'];
		$url = $config['server_protocol'].$config['domain_name'].'/viewpm?id='.$pm['pm_id'].'&page=%d';
		$nbpages = ceil($nb/$limit);
		$page	 = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset	 = ($page-1)*$limit;
		$lang['viewpm']['participants_list'] = sprintf($lang['viewpm']['participants_list'], $pm['pm_nb_participants']);

		if($nb > 0) {
			if($page > $nbpages)
				die(header('Location: '.sprintf($url, $nbpages)));

			$rows = get_rows($pm['pm_id'], $offset, $limit, $clauses);
			$pagination = pagination($page, $nbpages, $url, false);

			if($page > 1)
				$title .= ' - '.$lang['viewpm']['page'].' '.$page;
			
			$tpl->assign(array(
				'rows' => $rows,
				'pagination' => $pagination,
				'limit' => $limit,
				'offset' => $offset,
				'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit
			));
		}

		$token_action = new token('viewpm_action');

		$tpl->assign(array(
			'nb' => $nb,
			'participants' => $participants,
			'page' => $page,
			'token' => $token_action->token,
			'current_url' => sprintf($url, $page),
			'title' => $title
		));

		if($pm['pm_closed'] == 0) {
			$token_reply = new token('pm_reply');
			$token_preview = new token('preview');

			$tpl->assign(array(
				'lang_bbcode' => $lang['bbcode'],
				'preview_token' => $token_preview->token
			));

			$tpl->assign('form', array(
				'token' => $token_reply->token,
				'captcha' => $config['pm_reply_captcha'],
				'message' => !empty($_POST['message']) ? $_POST['message'] : '',
				'error' => !empty($error) ? $error : null,
			));
			
			if($pm['pm_userid'] == $user->data['user_id']) {
				$token_add = new token('viewpm_add');
				
				$tpl->assign('form_add', array(
					'ok' => !empty($ok) ? $ok : null,
					'error' => !empty($error) ? $error : null,
					'token' => $token_add->token,
					'participants' => !empty($_POST['participants']) ? $_POST['participants'] : '',
				));
			}
		}
	}
}

$pm['pm_name'] = wordwrap($pm['pm_name'], 25, "\n", true);

$tpl->assign(array(
	'pm' => $pm,
	'in_pm' => (bool) $in_pm,
	'lang_viewpm' => $lang['viewpm']
));

$tpl->draw('viewpm');