<?php
$root_path = '../';
require $root_path.'config.php';
require $root_path.'includes/functions.php';
require $root_path.'includes/autoload.php';

spl_autoload_register('autoload');

$db = Db::getInstance();
$dbh = $db->getConnection();

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die('Id incorrect');

$stmt = $dbh->prepare('SELECT forum_id, forum_catid, forum_name, forum_topics, forum_topics_visible, forum_posts, forum_posts_visible, forum_sticky FROM forum_forums WHERE forum_id = ? LIMIT 1');
$stmt->execute(array((int) $_GET['id']));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
unset($stmt);

if(!$data)
	die('Forum introuvable');

$stmt = $dbh->prepare('SELECT topic_id, topic_name, topic_sticky, topic_invisible FROM forum_topics WHERE topic_forumid = ? ORDER BY topic_id');
$stmt->execute(array($_GET['id']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
unset($stmt);

$stmt = $dbh->prepare('SELECT COUNT(post_id) FROM forum_posts WHERE post_topicid = ? AND post_invisible = ?');

$topics = array();
$count_invisible = array();
$count_visible = array();
$nbposts_visible = 0;
$nbposts_invisible = 0;

foreach($rows as $key => $value) {
	$stmt->execute(array($value['topic_id'], 1));
	$count_invisible[$key] = $stmt->fetchColumn();
	
	$stmt->execute(array($value['topic_id'], 0));
	$count_visible[$key] = $stmt->fetchColumn();
	
	if($value['topic_invisible'] == 0) {
		$nbposts_visible = $nbposts_visible+$count_visible[$key];
		$nbposts_invisible = $nbposts_invisible+$count_invisible[$key];
	}
	else
		$nbposts_invisible = $nbposts_invisible+$count_visible[$key]+$count_invisible[$key];
	
	$topics[$key] = array(
		'topic_id' => $value['topic_id'],
		'topic_name' => $value['topic_name'],
		'topic_sticky' => $value['topic_sticky'],
		'topic_invisible' => $value['topic_invisible'],
		'topic_posts' => $count_invisible[$key]+$count_visible[$key],
		'topic_posts_visible' => $count_visible[$key]
	);
}

unset($key, $value, $stmt);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>Topics</title>
<style>
table {
	border-spacing: 0;
}
table, th, td {
  border: 1px solid black;
}
th, td {
	padding: 5px;
}
</style>
</head>
<body>
<?php
print '<p>Forum n°<strong>'.$data['forum_id'].'</strong> : <strong>'.display($data['forum_name']).'</strong></p>
<p>Posts visibles : '.$nbposts_visible.'</p>
<p>Posts invisibles : '.$nbposts_invisible.'</p>
<p>Posts (total) : '.($nbposts_visible+$nbposts_invisible).'</p>';
?>
<table>
<tr>
<th>id</th>
<th>name</th>
<th>invisible</th>
<th>sticky</th>
<th>posts</th>
<th>posts visible</th>
</tr>
<?php
foreach($topics as $key => $value) {
	print '<tr>
	<td>'.$value['topic_id'].'</td>
	<td><img src="http://forum.prog/styles/base/images/forum/topic_dossier1.gif" /> <a href="topic.php?id='.$value['topic_id'].'">'.display($value['topic_name']).'</a></td>
	<td>'.$value['topic_invisible'].'</td>
	<td>'.$value['topic_sticky'].'</td>
	<td>'.$value['topic_posts'].'</td>
	<td>'.$value['topic_posts_visible'].'</td>
	</tr>';
}

unset($key, $value);
?>
</table>
</body>
</html>