<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/posting.php';
include $root_path.'includes/functions/bbcode.php';
include $root_path.$lang_path.'posting.php';
include $root_path.$lang_path.'bbcode.php';
include $root_path.$lang_path.'preview.php';

header('Content-Type: text/html; charset=utf-8');

$modes = array('new', 'reply', 'edit');

if(empty($_POST['mode']) || !in_array($_POST['mode'], $modes))
	die(header('Location: ./forums'));

if(!isset($_POST['forum']) || !ctype_digit($_POST['forum']))
	die($lang['posting']['incorrect_forum_id']);

$forum = get_forum($_POST['forum']);

if(!$forum)
	die($lang['posting']['forum_not_found']);

if($user->data['user_rank'] >= USER && $user->data['user_rank'] >= $forum['forum_auth_view']) {
	$moderators = explode(';', $forum['forum_moderators']);
	$moderator = ($user->data['user_rank'] >= ADMIN || ($user->data['user_rank'] == MODERATOR && in_array(strtolower($user->data['user_name']), array_map('strtolower', $moderators)))) ? true : false;

	if($_POST['mode'] == 'new' && $user->data['user_rank'] >= $forum['forum_auth_topic']) {
		$error = array();
		$time = time();

		if(!token::verify('posting_new', $config['form_expiration_time']))
			$error[] = $lang['posting']['expired_form'];
		else {
			if($config['captcha_newtopic'] == 1 && !captcha::check())
				$error[] = $lang['posting']['incorrect_code'];

			if(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
				$error[] = $lang['posting']['poster_banned'];

			if(empty($_POST['subject']))
				$error[] = $lang['posting']['topic_not_filled'];
			elseif(mb_strlen($_POST['subject'], 'UTF-8') > $config['topic_max_size'])
				$error[] = sprintf($lang['posting']['topic_too_long'], intval($config['topic_max_size']));
			
			if(empty($_POST['message']))
				$error[] = $lang['posting']['message_not_filled'];
			elseif(mb_strlen($_POST['message'], 'UTF-8') > $config['post_max_size'])
				$error[] = sprintf($lang['posting']['message_too_long'], intval($config['post_max_size']));
			
			if($user->data['user_rank'] < ADMIN && $config['topic_flood_time'] > 0) {
				$nb = get_nb_topics();
				
				if($nb > 0) {
					$error[] = sprintf($lang['posting']['flood_time_topic'], intval($config['topic_flood_time']));
				}
			}
		}

		token::destroy('posting_new');
		
		if(empty($error)) {
			$text_parsed = smileys(bbcode($_POST['message']));

			$topic_id = insert_topic($forum['forum_id'], $forum['forum_catid'], $_POST['subject'], $_POST['message'], $text_parsed);

			if(!$topic_id)
				die($lang['posting']['topic_not_posted']);

			$url = $config['server_protocol'].$config['domain_name'].'/topic/'.strtolower(remove_spec($_POST['subject'])).'/'.$topic_id.'/1';

			redirection($url, (int) $config['post_redirection_time'], sprintf($lang['posting']['topic_posted_successful'], $config['post_redirection_time'], $url));
		}
		
		$token_new = new token('posting_new');
		$token = $token_new->token;
	}
	elseif($_POST['mode'] == 'reply' && $user->data['user_rank'] >= $forum['forum_auth_reply']) {
		$error = array();
		$time = time();

		if(!isset($_POST['topic']) || !ctype_digit($_POST['topic']))
			$error[] = $lang['posting']['invalid_topic_id'];
		else {
			$topic = get_topic($_POST['topic']);

			if(!token::verify('posting_reply', $config['form_expiration_time']))
				$error[] = $lang['posting']['expired_form'];
			else {
				if(!$topic)
					$error[] = $lang['posting']['topic_not_found'];
				else {
					if($topic['topic_invisible'] == 1)
						$error[] = $lang['posting']['topic_deleted'];

					if($topic['topic_lock'] == 1 && !$moderator)
						$error[] = $lang['posting']['topic_locked'];

					if($config['captcha_reply'] == 1 && !captcha::check())
						$error[] = $lang['posting']['incorrect_code'];

					if(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
						$error[] = $lang['posting']['poster_banned'];

					if(empty($_POST['message']))
						$error[] = $lang['posting']['message_not_filled'];
					elseif(mb_strlen($_POST['message'], 'UTF-8') > $config['post_max_size'])
						$error[] = sprintf($lang['posting']['message_too_long'], intval($config['post_max_size']));

					if($user->data['user_rank'] < ADMIN && $config['post_flood_time'] > 0) {
						$nb = get_nb_posts();

						if($nb > 0)
							$error[] = sprintf($lang['posting']['flood_time_message'], intval($config['post_flood_time']));
					}
				}
			}

			token::destroy('posting_reply');
			
			if(empty($error)) {
				$text_parsed = smileys(bbcode($_POST['message']));

				$post_id = insert_post($topic['topic_id'], $forum['forum_id'], $_POST['message'], $text_parsed, 'topic/'.$topic['topic_slug'].'/'.$topic['topic_id'].'/'.ceil(($topic['topic_posts_visible']+1)/$config['posts_per_page']));
				
				if(!$post_id)
					die($lang['posting']['message_not_posted']);
				
				$url = $config['server_protocol'].$config['domain_name'].'/topic/'.$topic['topic_slug'].'/'.$topic['topic_id'].'/'.ceil(((($moderator && $user->data['user_rank'] >= $forum['forum_auth_restore_post']) ? $topic['topic_posts'] : $topic['topic_posts_visible'])+1)/$config['posts_per_page']).'#post_'.$post_id;
				
				redirection($url, (int) $config['post_redirection_time'], sprintf($lang['posting']['message_posted_successful'], $config['post_redirection_time'], $url));
			}

			$token_reply = new token('posting_reply');
			$token = $token_reply->token;
		}
	}
	elseif($_POST['mode'] == 'edit') {
		$error = null;
		$time = time();
		
		if($user->data['user_rank'] < $forum['forum_auth_edit'])
			$error = $lang['posting']['not_authorized_edit'];
		else {
			if(!isset($_POST['postid']) || !ctype_digit($_POST['postid'])) {
				$error = $lang['posting']['invalid_post_id'];
			}
			else {
				$post = get_post($_POST['postid']);

				if(!token::verify('posting_edit', $config['form_expiration_time']))
					$error = $lang['posting']['expired_form'];
				elseif(!$post)
					$error = $lang['posting']['message_not_found'];
				else {
					if(!$post)
						$error = $lang['posting']['topic_not_found'];
					elseif($post['topic_invisible'] == 1)
						$error = $lang['posting']['topic_deleted'];
					elseif(get_nb_ban($user->data['user_id']) > 0 && $user->data['user_rank'] < FOUNDER)
						$error = $lang['posting']['poster_banned'];
					elseif($post['post_userid'] != $user->data['user_id'] && $user->data['user_rank'] < ADMIN)
						$error = $lang['posting']['edit_own_message'];
					elseif($post['topic_lock'] == 1 && !$moderator)
						$error = $lang['posting']['topic_locked'];
					else {
						if(empty($_POST['value']))
							$error = $lang['posting']['message_not_filled'];
						elseif(mb_strlen($_POST['value'], 'UTF-8') > $config['post_max_size'])
							$error = sprintf($lang['posting']['message_too_long'], intval($config['post_max_size']));
					}

					if($user->data['user_rank'] < ADMIN && ($config['post_flood_time'] > 0 && $post['post_time_edit']+$config['post_flood_time'] > $time))
						$error = sprintf($lang['posting']['flood_time_edit'], intval($config['post_flood_time']));
				}
			}
		}

		if(!empty($error))
			die('<strong class="text-danger">'.$error.'</strong>');
		else {
			$text_parsed = smileys(bbcode($_POST['value']));

			if(edit_post($_POST['postid'], $_POST['value'], $text_parsed))
				die($text_parsed);

			die('<strong class="text-danger">'.$lang['posting']['error_occured'].'</strong>');
		}
	}

	if(($_POST['mode'] == 'new' && $user->data['user_rank'] >= $forum['forum_auth_topic']) || ($_POST['mode'] == 'reply' && $user->data['user_rank'] >= $forum['forum_auth_reply'])) {
		if($_POST['mode'] == 'new')
			$captcha = (bool) $config['captcha_newtopic'];
		elseif($_POST['mode'] == 'reply')
			$captcha = (bool) $config['captcha_reply'];

		$token_preview = new token('preview');

		$tpl->assign(array(
			'lang_bbcode' => $lang['bbcode'],
			'preview_token' => $token_preview->token
		));
		
		$tpl->assign('form', array(
			'error' => !empty($error) ? $error : null,
			'captcha' => $captcha,
			'token' => $token,
			'subject' => !empty($_POST['subject']) ? $_POST['subject'] : '',
			'message' => !empty($_POST['message']) ? $_POST['message'] : ''
		));

		if(!empty($topic)) {
			$tpl->assign(array(
				'topic' => $topic,
				'last_page' => (isset($_POST['page']) && ctype_digit($_POST['page']) && $_POST['page'] > 0 && $_POST['page'] <= ceil(($user->data['user_rank'] >= ADMIN ? $topic['topic_posts'] : $topic['topic_posts_visible'])/$config['posts_per_page'])) ? $_POST['page'] : 1
			));
		}
	}
}

$tpl->assign(array(
	'forum' => $forum,
	'lang_posting' => $lang['posting'],
	'mode' => $_POST['mode']
));

$tpl->draw('posting');