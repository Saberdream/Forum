<?php
function get_cat($catid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT cat_id, cat_name FROM '.$config['table_prefix'].'categories WHERE cat_id = ?');
	$sth->execute(array($catid));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function count_rows($catid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT COUNT(forum_id) FROM '.$config['table_prefix'].'forums WHERE forum_catid = ?');
	$sth->execute(array($catid));
	$nb = $sth->fetchColumn();
	unset($sth);
	
	return $nb;
}

function get_rows($catid) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_id, forum_name, forum_slug, forum_order, forum_topics, forum_posts, forum_last, forum_closed FROM '.$config['table_prefix'].'forums WHERE forum_catid = ? ORDER BY forum_order');
	$sth->execute(array($catid));
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $rows;
}

function get_forum($id) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT forum_name, forum_order FROM '.$config['table_prefix'].'forums WHERE forum_id = ?');
	$sth->execute(array($id));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);
	
	return $data;
}

function insert_forum($cat, $name, $order) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'forums(forum_catid, forum_name, forum_slug, forum_order, forum_desc, forum_icon, forum_rules, forum_moderators) VALUES('.placeholders('?', 8).')');
	$sth->execute(array($cat, $name, strtolower(remove_spec($name)), $order, '', '', '', ''));
	unset($sth);
	
	return true;
}

function set_order($forum, $cat, $order, $new_order) {
	global $dbh, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_order = ? WHERE forum_order = ? AND forum_catid = ?');
	$sth->execute(array($order, $new_order, $cat));
	unset($sth);

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_order = ? WHERE forum_id = ?');
	$sth->execute(array($new_order, $forum));
	unset($sth);

	return true;
}

function delete_forum($id) {
	global $dbh, $config, $lang;
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'forums WHERE forum_id = ?');
		$sth->execute(array($id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (005): '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'topics WHERE topic_forumid = ?');
		$sth->execute(array($id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (006): '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('DELETE FROM '.$config['table_prefix'].'posts WHERE post_forumid = ?');
		$sth->execute(array($id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (007): '.$e->getMessage());
	}
	
	$dbh->commit();
			
	return true;
}

function synchronize($id) {
	global $dbh, $config, $lang;
	
	$nbposts_visible = $nbposts_invisible = 0;
	
	$dbh->beginTransaction();
	
	try {
		$sth = $dbh->prepare('SELECT topic_id, topic_invisible FROM '.$config['table_prefix'].'topics WHERE topic_forumid = ? ORDER BY topic_id');
		$sth->execute(array($id));
		$topics = $sth->fetchAll(PDO::FETCH_ASSOC);
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (001): '.$e->getMessage());
	}
	
	if(count($topics) > 0) {
		$values = array();
		$values_visible = array();
		$count_invisible = array();
		$count_visible = array();
		
		try {
			$sth = $dbh->prepare('SELECT COUNT(post_id) FROM '.$config['table_prefix'].'posts WHERE post_topicid = ? AND post_invisible = ?');
			
			foreach($topics as $key => $value) {
				$sth->execute(array($value['topic_id'], 1));
				$count_invisible[$key] = $sth->fetchColumn();
				
				$sth->execute(array($value['topic_id'], 0));
				$count_visible[$key] = $sth->fetchColumn();
				
				$values = $values+array($value['topic_id'] => $count_invisible[$key]+$count_visible[$key]);
				$values_visible = $values_visible+array($value['topic_id'] => $count_visible[$key]);
				
				if($value['topic_invisible'] == 0) {
					$nbposts_visible = $nbposts_visible+$count_visible[$key];
					$nbposts_invisible = $nbposts_invisible+$count_invisible[$key];
				}
				else
					$nbposts_invisible = $nbposts_invisible+$count_visible[$key]+$count_invisible[$key];
			}
			
			unset($key, $value, $sth);
		}
		catch(Exception $e) {
			$dbh->rollBack();
			
			die($lang['forums']['error_occured'].' (002): '.$e->getMessage());
		}
		
		if(count($values) > 0) {
			try {
				$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_posts = ? WHERE topic_id = ?');
				
				foreach($values as $key => $value)
					$sth->execute(array($value, $key));
				
				unset($key, $value, $sth);
			}
			catch(Exception $e) {
				$dbh->rollBack();
				
				die($lang['forums']['error_occured'].' (003): '.$e->getMessage());
			}
		}
		
		if(count($values_visible) > 0) {
			try {
				$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_posts_visible = ? WHERE topic_id = ?');
				
				foreach($values_visible as $key => $value)
					$sth->execute(array($value, $key));
				
				unset($key, $value, $sth);
			}
			catch(Exception $e) {
				$dbh->rollBack();
				
				die($lang['forums']['error_occured'].' (004): '.$e->getMessage());
			}
		}
	}
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'topics SET topic_sticky = 0 WHERE topic_forumid = ? AND topic_invisible = 1');
		$sth->execute(array($id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (005): '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('SELECT COUNT(topic_id) FROM '.$config['table_prefix'].'topics WHERE topic_forumid = ? AND topic_invisible = ?');

		$sth->execute(array($id, 1));
		$nbtopics_invisible = $sth->fetchColumn();

		$sth->execute(array($id, 0));
		$nbtopics_visible = $sth->fetchColumn();

		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (006): '.$e->getMessage());
	}
	
	try {
		$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'forums SET forum_topics = ?, forum_topics_visible = ?, forum_posts = ?, forum_posts_visible = ? WHERE forum_id = ?');
		$sth->execute(array($nbtopics_invisible+$nbtopics_visible, $nbtopics_visible, $nbposts_invisible+$nbposts_visible, $nbposts_visible, $id));
		unset($sth);
	}
	catch(Exception $e) {
		$dbh->rollBack();
		
		die($lang['forums']['error_occured'].' (007): '.$e->getMessage());
	}
	
	$dbh->commit();
	
	return true;
}