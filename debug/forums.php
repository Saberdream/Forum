<?php
$root_path = '../';
require $root_path.'config.php';
require $root_path.'includes/functions.php';
require $root_path.'includes/autoload.php';

spl_autoload_register('autoload');

$db = Db::getInstance();
$dbh = $db->getConnection();

$stmt = $dbh->prepare('SELECT forum_id, forum_catid, forum_name, forum_topics, forum_topics_visible, forum_posts, forum_posts_visible, forum_sticky FROM forum_forums ORDER BY forum_id');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>Forums</title>
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
<table>
<tr>
<th>id</th>
<th>catid</th>
<th>name</th>
<th>topics</th>
<th>topics visible</th>
<th>posts</th>
<th>posts visible</th>
<th>topics sticky</th>
</tr>
<?php
foreach($rows as $key => $value) {
	print '<tr>
	<td>'.$value['forum_id'].'</td>
	<td>'.$value['forum_catid'].'</td>
	<td><img src="http://forum.prog/styles/base/images/forum/default.png" /> <a href="topics.php?id='.$value['forum_id'].'">'.display($value['forum_name']).'</a></td>
	<td>'.$value['forum_topics'].'</td>
	<td>'.$value['forum_topics_visible'].'</td>
	<td>'.$value['forum_posts'].'</td>
	<td>'.$value['forum_posts_visible'].'</td>
	<td>'.$value['forum_sticky'].'</td>
	</tr>';
}

unset($key, $value);
?>
</table>
</body>
</html>