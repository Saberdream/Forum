<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/viewalert.php';
include $root_path.'includes/functions/bbcode.php';
include $root_path.$lang_path.'adm/viewalert.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die($lang['viewalert']['incorrect_alert_id']);

$data = get_alert((int) $_GET['id']);

if(isset($data['alert_id'])) {
	$reasons = get_reasons();
	
	if(isset($_POST['new_reason']) && $data['alert_closed'] == 0) {
		$error = array();
		
		if(token::verify('adm_alerts_change_reason', $config['form_expiration_time'])) {
			if(ctype_digit($_POST['new_reason'])) {
				if(isset($reasons[$_POST['new_reason']])) {
					if($reasons[$_POST['new_reason']] != $data['alert_reason']) {
						if(update_reason($data['alert_id'], $reasons[$_POST['new_reason']])) {
							$data['alert_reason'] = $reasons[$_POST['new_reason']];
							
							$ok = $lang['viewalert']['reason_updated'];
							
							unset($error);
						}
					}
					else
						$error[] = $lang['viewalert']['identical_reason'];
				}
				else
					$error[] = $lang['viewalert']['reason_not_exists'];
			}
			else
				$error[] = $lang['viewalert']['invalid_reason'];
		}
		else
			$error[] = $lang['viewalert']['incorrect_token'];
		
		token::destroy('adm_alerts_change_reason');
	}

	if(!empty($_GET['action']) && $data['alert_closed'] == 0) {
		if(!token::verify('adm_alerts_action', $config['form_expiration_time'], 'get'))
			die($lang['viewalert']['incorrect_token']);
		
		switch($_GET['action']) {
			case 'close' :
				close_alert($data['alert_id']);

				break;

			case 'delete' :
				if($data['alert_postid'] == $data['topic_postid'])
					delete_topic($data['alert_topicid'], $data['alert_forumid']);
				else
					delete_post($data['alert_postid'], $data['alert_topicid'], $data['alert_forumid'], $data['topic_postid']);

				close_alert($data['alert_id']);
				
				break;

			case 'ban' :
				ban($data['post_userid'], $data['alert_reason']);

				if($data['alert_postid'] == $data['topic_postid'])
					delete_topic($data['alert_topicid'], $data['alert_forumid']);
				else
					delete_post($data['alert_postid'], $data['alert_topicid'], $data['alert_forumid'], $data['topic_postid']);

				close_alert($data['alert_id']);

				break;

			case 'ban-tempo' :
				ban($data['post_userid'], $data['alert_reason'], time()+(30*86400));

				if($data['alert_postid'] == $data['topic_postid'])
					delete_topic($data['alert_topicid'], $data['alert_forumid']);
				else
					delete_post($data['alert_postid'], $data['alert_topicid'], $data['alert_forumid'], $data['topic_postid']);

				close_alert($data['alert_id']);
		}

		token::destroy('adm_alerts_action');

		die($lang['viewalert']['action_success']);
	}

	$token_action = new token('adm_alerts_action');

	$tpl->assign(array(
		'data' => $data,
		'token' => $token_action->token
	));

	$token_form = new token('adm_alerts_change_reason');

	$tpl->assign('form', array(
		'reasons' => $reasons,
		'ok' => !empty($ok) ? $ok : null,
		'error' => !empty($error) ? $error : null,
		'token' => $token_form->token
	));
}

$tpl->assign(array(
	'title' => $lang['viewalert']['manage_alerts'],
	'lang_viewalert' => $lang['viewalert']
));

$tpl->draw('viewalert');