<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/blacklist.php';
include $root_path.$lang_path.'blacklist.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] >= USER) {
	$nb = count_rows();
	$limit = 25;
	
	if(isset($_POST['users'])) {
		$error = array();
		$bl_users = array();
		$time = time();

		if(!token::verify('add_users_bl', $config['form_expiration_time']))
			$error[] = $lang['bl']['invalid_form'];
		else {
			if(empty($_POST['users']) || mb_strlen($_POST['users'], 'UTF-8') > 1000)
				$error[] = $lang['bl']['no_user_too_long'];
			else {
				if(strpos($_POST['users'], ';'))
					$post_users = explode(';', $_POST['users']);
				else
					$post_users = array($_POST['users']);

				$usernames = $users = array();

				foreach($post_users as $username) {
					if(!preg_match('#^[a-zA-Z0-9-]{3,15}$#', $username))
						$error[] = sprintf($lang['bl']['invalid_username'], display($username));
					else {
						if(strtolower($username) == strtolower($user->data['user_name']))
							$error[] = $lang['bl']['self_username'];
						elseif(in_array(strtolower($username), $usernames))
							$error[] = sprintf($lang['bl']['user_duplicate'], display($username));
						else {
							$users[$username] = get_user($username);
							
							if(!$users[$username])
								$error[] = sprintf($lang['bl']['user_not_exists'], display($username));
							elseif($users[$username]['user_rank'] == GUEST)
								$error[] = sprintf($lang['bl']['cant_add_user'], display($username));
							elseif(get_nb_ban($users[$username]['user_id']) > 0)
								$error[] = sprintf($lang['bl']['banned_user'], display($username));
							elseif(get_nb_bl($users[$username]['user_id']) > 0)
								$error[] = sprintf($lang['bl']['already_blacklisted'], display($username));
							else
								$bl_users[$users[$username]['user_id']] = $username;
						}

						$usernames[] = strtolower($username);
					}
				}

				unset($username);
			}
			
			if(sizeof($bl_users)+$nb > 6)
				$error[] = $lang['bl']['too_many_users'];

			if(count($error) == 0) {
				insert_users($bl_users);

				$ok = $lang['bl']['user_successful_added'];

				unset($error);
			}
		}

		token::destroy('add_users_bl');
	}

	if($nb > 0) {
		if(isset($_POST['sup']) && !empty($_POST['sup']) && is_array($_POST['sup'])) {
			if(!token::verify('bl', $config['form_expiration_time']))
				die($lang['bl']['expired_form']);

			$ids = array_filter($_POST['sup'], 'is_numeric');
			$ids = array_unique($ids, SORT_NUMERIC);
			
			if(count($ids) == 0 || count($ids) > $limit)
				die($lang['bl']['incorrect_ids']);

			if(count($ids) > 0) {
				if(delete_users($ids)) {
					token::destroy('bl');
					
					die($lang['bl']['users_deleted']);
				}

				die($lang['bl']['error_occured']);
			}
		}

		$nbpages	= ceil($nb/$limit);
		$page		= (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset		= ($page-1)*$limit;
		$pagination	= pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/blacklist?page=%d');
		$rows		= get_rows($offset, $limit);
		$token = new token('bl');

		$tpl->assign(array(
			'rows' => $rows,
			'pagination' => $pagination,
			'offset' => $offset,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
			'token' => $token->token
		));
	}
	
	$token_add = new token('add_users_bl');

	$tpl->assign('form', array(
		'ok' => !empty($ok) ? $ok : null,
		'error' => !empty($error) ? $error : null,
		'token' => $token_add->token,
		'users' => (!empty($_POST['users']) && empty($ok)) ? $_POST['users'] : '',
	));

	$tpl->assign('nb', $nb);
}

$tpl->assign(array(
	'blacklist' => $lang['bl']['blacklist'],
	'lang_bl' => $lang['bl']
));

$tpl->draw('blacklist');