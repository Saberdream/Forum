<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/mod.php';
include __DIR__.'/'.$lang_path.'mod.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] < MODERATOR)
	die($lang['mod_errors']['not_authorized_access']);

if(!isset($_GET['forum']) || !ctype_digit($_GET['forum']))
	die($lang['mod_errors']['incorrect_forum_id']);

$forum = get_forum($_GET['forum']);

if(!$forum)
	die($lang['mod_errors']['forum_not_found']);

$moderators = explode(';', $forum['forum_moderators']);

if($user->data['user_rank'] == MODERATOR && !in_array(strtolower($user->data['user_name']), array_map('strtolower', $moderators)))
	die($lang['mod_errors']['not_moderator']);

if($user->data['user_rank'] < $forum['forum_auth_view'])
	die($lang['mod_errors']['not_moderator']);

if(!token::verify('forum_mod', $config['form_expiration_time'], 'get'))
	die($lang['mod_errors']['expired_token']);

if(isset($_POST['topic'])) {
	if(empty($_POST['topic']) || !is_array($_POST['topic']))
		die($lang['mod_errors']['no_topic_selected']);
	
	$limit = $config['topics_per_page'];
	$ids = array_filter($_POST['topic'], 'is_numeric');
	$ids = array_unique($ids, SORT_NUMERIC);
	
	if(count($ids) == 0 || count($ids) > $limit)
		die($lang['mod_errors']['incorrect_ids']);
	
	$actions = array('delete', 'remove', 'stick', 'unstick', 'lock', 'unlock', 'restore', 'ban');
	
	if(empty($_POST['action']) || !in_array($_POST['action'], $actions))
		die($lang['mod_errors']['incorrect_action']);
	
	$results = 0;
	
	switch($_POST['action']) {
		case 'delete':
			if($user->data['user_rank'] < $forum['forum_auth_delete_topic'])
				die($lang['mod_errors']['not_authorized_action']);
			
			$results = delete_restore_topics($ids, $forum['forum_id'], 1);
			break;
			
		case 'remove':
			if($user->data['user_rank'] < $forum['forum_auth_remove_topic'])
				die($lang['mod_errors']['not_authorized_action']);
			
			$results = delete_topics($ids, $forum['forum_id']);
			break;
		
		case 'restore':
			if($user->data['user_rank'] < $forum['forum_auth_restore_topic'])
				die($lang['mod_errors']['not_authorized_action']);
			
			$results = delete_restore_topics($ids, $forum['forum_id'], 0);
			break;
		
		case 'lock':
			if($user->data['user_rank'] < $forum['forum_auth_lock_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = lock_unlock_topics($ids, $forum['forum_id'], 1);
			break;
		
		case 'unlock':
			if($user->data['user_rank'] < $forum['forum_auth_lock_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = lock_unlock_topics($ids, $forum['forum_id'], 0);
			break;
		
		case 'stick':
			if($user->data['user_rank'] < $forum['forum_auth_stick_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$nb_sticky = get_nb_sticky($forum['forum_id']);

			if($nb_sticky >= $config['max_sticky_topics'] && $user->data['user_rank'] < ADMIN)
				die(sprintf($lang['mod_errors']['max_sticky_reached'], $nb_sticky));

			if($nb_sticky+sizeof($ids) > $config['max_sticky_topics'] && $user->data['user_rank'] < ADMIN)
				die(sprintf($lang['mod_errors']['max_sticky_reached'], $nb_sticky));

			$results = stick_topics($ids, $forum['forum_id'], $nb_sticky);
			break;
		
		case 'unstick':
			if($user->data['user_rank'] < $forum['forum_auth_stick_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = unstick_topics($ids, $forum['forum_id']);
			break;
		
		case 'ban':
			if($user->data['user_rank'] < $forum['forum_auth_ban'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$users = get_topic_users($ids, $forum['forum_id']);

			foreach($users as $key => $value) {
				$users[$key] = (int) $value['topic_userid'];
			}
			unset($key, $value);

			$users = array_unique($users, SORT_NUMERIC);
			$results = ban_users($users);
	}

	if($results > 0)
		die(sprintf($lang['mod_errors']['action_success'], $results));
	else
		die($lang['mod_errors']['no_topic_affected']);
}

elseif(isset($_POST['post'])) {
	if(empty($_POST['post']) || !is_array($_POST['post']))
		die($lang['mod_errors']['incorrect_post_id']);
	
	$limit = $config['posts_per_page'];
	$ids = array_filter($_POST['post'], 'is_numeric');
	$ids = array_unique($ids, SORT_NUMERIC);
	
	if(count($ids) == 0 || count($ids) > $limit)
		die($lang['mod_errors']['incorrect_ids']);
	
	$actions = array('delete', 'remove', 'restore', 'ban', 'ban-tempo');
	
	if(empty($_POST['action']) || !in_array($_POST['action'], $actions))
		die($lang['mod_errors']['incorrect_action']);
	
	if(!isset($_GET['topic']) || !ctype_digit($_GET['topic']))
		die($lang['mod_errors']['incorrect_topic_id']);
	
	$topic = get_topic($_GET['topic'], $forum['forum_id']);
	
	if(!$topic || ($topic['topic_invisible'] == 1 && $user->data['user_rank'] < $forum['forum_auth_restore_topic']))
		die($lang['mod_errors']['topic_not_found']);
	
	switch($_POST['action']) {
		case 'delete':
			if($topic['topic_invisible'] == 1 || $user->data['user_rank'] < $forum['forum_auth_delete_post'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = delete_restore_posts($ids, $topic['topic_id'], $forum['forum_id'], $topic['topic_postid'], 1);
			break;
			
		case 'remove':
			if($user->data['user_rank'] < $forum['forum_auth_remove_post'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = delete_posts($ids, $topic['topic_id'], $forum['forum_id'], $topic['topic_postid']);
			break;
	
		case 'restore':
			if($topic['topic_invisible'] == 1 || $user->data['user_rank'] < $forum['forum_auth_restore_post'])
				die($lang['mod_errors']['not_authorized_action']);
			
			$results = delete_restore_posts($ids, $topic['topic_id'], $forum['forum_id'], $topic['topic_postid'], 0);
			break;
	
		case 'ban':
			if($user->data['user_rank'] < $forum['forum_auth_ban'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$users = get_post_users($ids, $topic['topic_id'], $forum['forum_id']);
			
			foreach($users as $key => $value) {
				$users[$key] = $value['post_userid'];
			}
			unset($key, $value);
			
			$results = ban_users($users);
			break;
		
		case 'ban-tempo':
			if($user->data['user_rank'] < $forum['forum_auth_ban'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$users = get_post_users($ids, $topic['topic_id'], $forum['forum_id']);
			
			foreach($users as $key => $value) {
				$users[$key] = $value['post_userid'];
			}
			unset($key, $value);
			
			$results = ban_users($users, time()+(86400*30));
	}

	if($results > 0)
		die(sprintf($lang['mod_errors']['action_success'], $results));
	else
		die($lang['mod_errors']['no_topic_affected']);
}

elseif(!empty($_GET['action'])) {
	if(!isset($_GET['topic']) || !ctype_digit($_GET['topic']))
		die('Id du topic incorrect');
	
	$actions = array('delete-topic', 'remove-topic', 'restore-topic', 'delete-post', 'remove-post', 'restore-post', 'stick-topic', 'unstick-topic', 'lock-topic', 'unlock-topic', 'ban-user', 'ban-user-tempo');
	
	if(!in_array($_GET['action'], $actions))
		die($lang['mod_errors']['incorrect_action']);
	
	switch($_GET['action']) {
		case 'delete-topic':
			if($user->data['user_rank'] < $forum['forum_auth_delete_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = delete_restore_topics(array($_GET['topic']), $forum['forum_id'], 1);
			break;
		
		case 'restore-topic':
			if($user->data['user_rank'] < $forum['forum_auth_restore_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = delete_restore_topics(array($_GET['topic']), $forum['forum_id'], 0);
			break;
			
		case 'remove-topic':
			if($user->data['user_rank'] < $forum['forum_auth_remove_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = delete_topics(array($_GET['topic']), $forum['forum_id']);
			break;
		
		case 'stick-topic':
			if($user->data['user_rank'] < $forum['forum_auth_stick_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$nb_sticky = get_nb_sticky($forum['forum_id']);

			if($nb_sticky >= $config['max_sticky_topics'] && $user->data['user_rank'] < ADMIN)
				die(sprintf($lang['mod_errors']['max_sticky_reached'], $nb_sticky));

			$results = stick_topics(array($_GET['topic']), $forum['forum_id'], $nb_sticky);
			break;
		
		case 'unstick-topic':
			if($user->data['user_rank'] < $forum['forum_auth_stick_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = unstick_topics(array($_GET['topic']), $forum['forum_id']);
			break;
		
		case 'lock-topic':
			if($user->data['user_rank'] < $forum['forum_auth_lock_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = lock_unlock_topics(array($_GET['topic']), $forum['forum_id'], 1);
			break;
		
		case 'unlock-topic':
			if($user->data['user_rank'] < $forum['forum_auth_lock_topic'])
				die($lang['mod_errors']['not_authorized_action']);
		
			$results = lock_unlock_topics(array($_GET['topic']), $forum['forum_id'], 0);
			break;
		
		case 'delete-post':
			if($user->data['user_rank'] < $forum['forum_auth_delete_post'])
				die($lang['mod_errors']['not_authorized_action']);
		
			if(!isset($_GET['post']) || !ctype_digit($_GET['post']))
				die($lang['mod_errors']['incorrect_post_id']);
			
			$topic = get_topic($_GET['topic'], $forum['forum_id']);
			
			if(!$topic || $topic['topic_invisible'] == 1)
				die($lang['mod_errors']['topic_not_found']);
			
			$results = delete_restore_posts(array($_GET['post']), $topic['topic_id'], $forum['forum_id'], $topic['topic_postid'], 1);
			break;
		
		case 'remove-post':
			if($user->data['user_rank'] < $forum['forum_auth_remove_post'])
				die($lang['mod_errors']['not_authorized_action']);
		
			if(!isset($_GET['post']) || !ctype_digit($_GET['post']))
				die($lang['mod_errors']['incorrect_post_id']);
			
			$topic = get_topic($_GET['topic'], $forum['forum_id']);
			
			if(!$topic)
				die($lang['mod_errors']['topic_not_found']);
			
			$results = delete_posts(array($_GET['post']), $topic['topic_id'], $forum['forum_id'], $topic['topic_postid']);
			break;
		
		case 'restore-post':
			if($user->data['user_rank'] < $forum['forum_auth_restore_post'])
				die($lang['mod_errors']['not_authorized_action']);
			
				if(!isset($_GET['post']) || !ctype_digit($_GET['post']))
					die($lang['mod_errors']['incorrect_post_id']);
				
				$topic = get_topic($_GET['topic'], $forum['forum_id']);
				
				if(!$topic || $topic['topic_invisible'] == 1)
					die($lang['mod_errors']['topic_not_found']);
				
				$results = delete_restore_posts(array($_GET['post']), $topic['topic_id'], $forum['forum_id'], $topic['topic_postid'], 0);
			break;
		
		case 'ban-user':
			if($user->data['user_rank'] < $forum['forum_auth_ban'])
				die($lang['mod_errors']['not_authorized_action']);
			
			if(!isset($_GET['userid']) || !ctype_digit($_GET['userid']))
				die($lang['mod_errors']['incorrect_user_id']);
			
			$results = ban_users(array($_GET['userid']));
			break;
		
		case 'ban-user-tempo':
			if($user->data['user_rank'] < $forum['forum_auth_ban'])
				die($lang['mod_errors']['not_authorized_action']);
			
			if(!isset($_GET['userid']) || !ctype_digit($_GET['userid']))
				die($lang['mod_errors']['incorrect_user_id']);
			
			$results = ban_users(array($_GET['userid']), time()+(86400*30));
	}

	if($results > 0) {
		// token::destroy('forum_mod');
		
		die(sprintf($lang['mod_errors']['action_success'], $results));
	}
	else
		die($lang['mod_errors']['no_topic_affected']);
}