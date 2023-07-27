<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/forum-edit.php';
include dirname(__DIR__).'/'.$lang_path.'adm/forum-edit.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die($lang['forum_edit']['incorrect_id']);

$data = get_forum((int) $_GET['id']);

if($data) {
	$array_data = array('name', 'catid', 'desc', 'icon', 'rules', 'alerts', 'auth_view', 'auth_topic', 'auth_reply', 'auth_edit', 'auth_alert', 'auth_lock_topic', 'auth_stick_topic', 'auth_delete_topic', 'auth_delete_post', 'auth_restore_topic', 'auth_restore_post', 'auth_ban', 'moderators', 'closed');

	$forum_auth_min = array(
		'auth_view' => GUEST,
		'auth_topic' => USER,
		'auth_reply' => USER,
		'auth_edit' => USER,
		'auth_alert' => USER,
		'auth_lock_topic' => MODERATOR,
		'auth_stick_topic' => MODERATOR,
		'auth_delete_topic' => MODERATOR,
		'auth_delete_post' => MODERATOR,
		'auth_restore_topic' => MODERATOR,
		'auth_restore_post' => MODERATOR,
		'auth_ban' => MODERATOR
	);

	$forum_auth = array();

	foreach($forum_auth_min as $key => $value) {
		$forum_auth[$key] = array(
			'auth' => $data['forum_'.$key],
			'auth_min' => $value,
			'name' => !empty($lang['forum_edit'][$key]) ? $lang['forum_edit'][$key] : $key
		);
	}
	
	unset($key, $value);

	if(!empty($_POST['data']) && is_array($_POST['data'])) {
		$error = array();
		$post_data = $_POST['data'];
		
		if(token::verify('adm_forum_edit', $config['form_expiration_time'])) {
			$values = array();

			foreach($_POST['data'] as $key => $value) {
				if(!empty($key) && in_array($key, $array_data)) {
					if($value == $data['forum_'.$key])
						unset($_POST['data'][$key]);
					else
						$values['forum_'.$key] = $value;
				}
			}

			unset($key, $value);

			if(count($values) > 0) {
				if(isset($_POST['data']['name']) && (empty($_POST['data']['name']) || mb_strlen($_POST['data']['name'], 'UTF-8') > 100))
					$error[] = $lang['forum_edit']['invalid_forum_name'];
				
				if(isset($_POST['data']['category'])) {
					if(!ctype_digit($_POST['data']['category']))
						$error[] = $lang['forum_edit']['incorrect_category'];
					else {
						$count = count_cat((int) $_POST['data']['category']);
						
						if($count == 0)
							$error[] = $lang['forum_edit']['category_not_exists'];
					}
				}
				
				if(isset($_POST['data']['icon']) && mb_strlen($_POST['data']['icon'], 'UTF-8') > 1000)
					$error[] = $lang['forum_edit']['invalid_icon'];
				
				if(isset($_POST['data']['desc']) && mb_strlen($_POST['data']['desc'], 'UTF-8') > 1000)
					$error[] = $lang['forum_edit']['invalid_description'];
				
				if(isset($_POST['data']['rules']) && mb_strlen($_POST['data']['rules'], 'UTF-8') > 15000)
					$error[] = $lang['forum_edit']['invalid_rules'];
				
				if(isset($_POST['data']['alerts']) && ($_POST['data']['alerts'] != 1 && $_POST['data']['alerts'] != 0))
					$error[] = $lang['forum_edit']['chose_if_alerts'];
				
				if(isset($_POST['data']['closed']) && ($_POST['data']['closed'] != 1 && $_POST['data']['closed'] != 0))
					$error[] = $lang['forum_edit']['chose_if_closed'];
				
				if(isset($_POST['data']['moderators']) && !empty($_POST['data']['moderators'])) {
					if(!strpos($_POST['data']['moderators'], ';')) {
						if(!preg_match('#^[a-zA-Z0-9-]{3,15}$#', $_POST['data']['moderators']))
							$error[] = sprintf($lang['forum_edit']['invalid_moderator_name'], display($_POST['data']['moderators']));
					}
					else {
						$moderators = explode(';', $_POST['data']['moderators']);
						
						foreach($moderators as $value)
							if(!preg_match('#^[a-zA-Z0-9-]{3,15}$#', $value))
								$error[] = sprintf($lang['forum_edit']['invalid_moderator_name'], display($value));
						
						unset($value);
					}
				}
				
				foreach($forum_auth as $key => $value) {
					if(isset($_POST['data'][$key])) {
						if(!ctype_digit($_POST['data'][$key]) || $_POST['data'][$key] < $value['auth_min'] || $_POST['data'][$key] > ADMIN)
							$error[] = $lang['forum_edit']['error_'.$key];
						else
							$forum_auth[$key]['auth'] = $_POST['data'][$key];
					}
				}
				
				unset($key, $value);
				
				if(count($error) == 0) {
					if(update_forum($data['forum_id'], $values))
						$ok = $lang['forum_edit']['forum_successful_edited'];
					else
						$error[] = $lang['settings']['update_error'];
				}
			}
		
		}
		else
			$error[] = $lang['forum_edit']['invalid_form'];

		token::destroy('adm_forum_edit');
	}

	$token = new token('adm_forum_edit');
	
	$tpl->assign('form', array(
		'ok' => !empty($ok) ? $ok : null,
		'error' => !empty($error) ? $error : null,
		'token' => $token->token
	));

	if(isset($post_data)) {
		foreach($post_data as $key => $value) {
			if(!empty($key) && in_array($key, $array_data))
				$data['forum_'.$key] = $value;
		}

		unset($key, $value);
	}

	$tpl->assign(array(
		'data' => $data,
		'cats' => get_cats(),
		'forum_auth' => $forum_auth
	));
}

$tpl->assign(array(
	'title' => $lang['forum_edit']['manage_forums'],
	'lang_forum_edit' => $lang['forum_edit']
));

$tpl->draw('forum-edit');