<?php
function get_forum($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_catid, forum_name, forum_slug, forum_auth_view, forum_auth_topic, forum_auth_reply, forum_auth_edit, forum_auth_restore_post, forum_moderators, cat_name
	FROM '.$config['table_prefix'].'forums
	LEFT JOIN '.$config['table_prefix'].'categories ON '.$config['table_prefix'].'categories.cat_id = '.$config['table_prefix'].'forums.forum_catid
	WHERE forum_id = ?');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function get_topic($id) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT topic_id, topic_name, topic_slug, topic_posts, topic_posts_visible, topic_lock, topic_invisible FROM '.$config['table_prefix'].'topics WHERE topic_id = ?');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function insert_topic($forumid, $catid, $topic, $post, $post_parsed) {
	global $dbh, $config, $user, $lang;
	
	$time = time();
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'topics(topic_forumid, topic_catid, topic_userid, topic_username, topic_name, topic_slug, topic_first, topic_last, topic_posts, topic_posts_visible, topic_rank) VALUES('.placeholders('?', 11).')');
		$sth->execute(array($forumid, $catid, $user->data['user_id'], $user->data['user_name'], $topic, strtolower(remove_spec($topic)), $time, $time, 1, 1, $user->data['user_rank']));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['posting']['error_occured'].' (001): '.$e->getMessage());
	}

	unset($sth);
	
	$topicid = $dbh->lastInsertId();
	
	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'posts(post_topicid, post_forumid, post_userid, post_username, post_ip, post_time, post_rank, post_text, post_text_parsed) VALUES('.placeholders('?', 9).')');
		$sth->execute(array($topicid, $forumid, $user->data['user_id'], $user->data['user_name'], $_SERVER['REMOTE_ADDR'], $time, $user->data['user_rank'], $post, $post_parsed));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (002): '.$e->getMessage());
	}

	unset($sth);
	
	$postid = $dbh->lastInsertId();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_postid = ? WHERE topic_id = ?');
		$sth->execute(array($postid, $topicid));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (003): '.$e->getMessage());
	}

	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_topics = forum_topics+1, forum_topics_visible = forum_topics_visible+1, forum_posts = forum_posts+1, forum_posts_visible = forum_posts_visible+1, forum_last = ? WHERE forum_id = ?');
		$sth->execute(array($time, $forumid));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (004): '.$e->getMessage());
	}

	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_ip = ?, user_last = ?, user_posts = user_posts+1 WHERE user_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $user->data['user_id']));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (005): '.$e->getMessage());
	}

	unset($sth);
	
	$dbh->commit();
	
	return $topicid;
}

function insert_post($topicid, $forumid, $post, $post_parsed, $topic_url = null) {
	global $dbh, $config, $user, $lang;
	
	$time = time();
	
	$dbh->beginTransaction();

	try {
		$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'posts(post_topicid, post_forumid, post_userid, post_username, post_ip, post_time, post_rank, post_text, post_text_parsed) VALUES('.placeholders('?', 9).')');
		$sth->execute(array($topicid, $forumid, $user->data['user_id'], $user->data['user_name'], $_SERVER['REMOTE_ADDR'], $time, $user->data['user_rank'], $post, $post_parsed));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['posting']['error_occured'].' (001): '.$e->getMessage());
	}
	unset($sth);

	$postid = $dbh->lastInsertId();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_posts = topic_posts+1, topic_posts_visible = topic_posts_visible+1, topic_last = ? WHERE topic_id = ?');
		$sth->execute(array($time, $topicid));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['posting']['error_occured'].' (002): '.$e->getMessage());
	}
	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_posts = forum_posts+1, forum_posts_visible = forum_posts_visible+1, forum_last = ? WHERE forum_id = ?');
		$sth->execute(array($time, $forumid));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['posting']['error_occured'].' (003): '.$e->getMessage());
	}
	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_ip = ?, user_last = ?, user_posts = user_posts+1 WHERE user_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $user->data['user_id']));
	}
	catch(Exception $e) {
		$dbh->rollback();

		die($lang['posting']['error_occured'].' (004): '.$e->getMessage());
	}
	unset($sth);

	$subscribers = get_subscribers($topicid);

	if(count($subscribers) > 0) {
		$values = array();
		$counter = 0;
		
		foreach($subscribers as $value) {
			if(($config['notifications_limit'] == 0 || $counter <= $config['notifications_limit']) && $value['sub_userid'] != $user->data['user_id']) {
				$values = array_merge($values, array($value['sub_userid'], sprintf($lang['posting']['replied_followed_topic'], $user->data['user_name']), substr($post, 0, 50), $topic_url.'#post_'.$postid, $time));
				$counter++;
			}
		}
		unset($value);

		if($counter > 0) {
			try {
				$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'notifications(notif_userid, notif_name, notif_desc, notif_url, notif_time) VALUES '.placeholders_multi('?', count($values), 5));
				$sth->execute(array_values($values));
			}
			catch(Exception $e) {
				$dbh->rollback();

				die($lang['posting']['error_occured'].' (005) : '.$e->getMessage());
			}
			unset($sth);
		}
	}

	$dbh->commit();

	return $postid;
}

function get_subscribers($topicid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT sub_userid FROM '.$config['table_prefix'].'subscriptions WHERE sub_topicid = ?');
	$sth->execute(array($topicid));
	$data = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function get_nb_topics() {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(topic_id) FROM '.$config['table_prefix'].'topics WHERE topic_userid = ? AND topic_first+? > ?');
	$sth->execute(array($user->data['user_id'], $config['topic_flood_time'], time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function get_nb_posts() {
	global $dbh, $config, $user;
	
	$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'posts WHERE post_userid = ? AND post_time+? > ?');
	$sth->execute(array($user->data['user_id'], $config['post_flood_time'], time()));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_post($postid) {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT post_topicid, post_userid, post_time_edit, post_invisible, topic_name, topic_slug, topic_posts, topic_lock, topic_invisible
	FROM '.$config['table_prefix'].'posts
	LEFT JOIN '.$config['table_prefix'].'topics ON '.$config['table_prefix'].'topics.topic_id = '.$config['table_prefix'].'posts.post_topicid
	WHERE post_id = ?');
	$sth->execute(array($postid));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function get_nb_ban($id) {
	global $dbh, $config, $user;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ? AND (ban_end > ? OR ban_end = 0)');
	$sth->execute(array($id, time()));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function edit_post($postid, $text, $text_parsed) {
	global $dbh, $config, $user, $lang;
	
	$time = time();
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'posts SET post_ip = ?, post_time_edit = ?, post_text = ?, post_text_parsed = ? WHERE post_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $text, $text_parsed, $postid));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (001): '.$e->getMessage());
	}
	unset($sth);
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'users SET user_ip = ?, user_last = ? WHERE user_id = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR'], $time, $user->data['user_id']));
	}
	catch(Exception $e) {
		$dbh->rollback();
		
		die($lang['posting']['error_occured'].' (002): '.$e->getMessage());
	}
	unset($sth);
	
	$dbh->commit();
	
	return true;
}

function redirection($url = './index', $time = 5, $text = null) {
	global $tpl, $lang;
	
	// if time is set to 0, then it's not necessary to display an entire page...
	if($time == 0)
		header('Location: '.$url);
	else {
		// we create a virtual template called "redirection.html"...
		$tpl->draw('header');
		echo '<div class="container-fluid">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3 col-md-7 col-md-push-4 col-lg-6 col-lg-push-4">
					<div class="panel panel-default">
					<div class="panel-body">
					<script type="text/javascript">
					setTimeout(function(){
						window.location.href = "'.$url.'";
					}, '.($time*1000).');
					</script>
					'.(!empty($text) ? $text : 'Redirection in '.$time.' second(s)...').'
					</div>
					</div>
				</div>
				
				<div class="col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-6 col-lg-2 col-lg-pull-4">
					<div class="list-group">
					<a class="list-group-item" href="index.htm">'.$lang['menu_top']['home'].'</a>
					<a class="list-group-item" href="viewonline.htm">'.$lang['posting']['users_connected'].'</a>
					</div>
				</div>
			</div>
		</div>';
		$tpl->draw('footer');
	}
	
	die;
	
	return true;
}
