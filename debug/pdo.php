<?php
$root_path = '../';
require $root_path.'config.php';
require $root_path.'includes/functions.php';
require $root_path.'includes/autoload.php';

spl_autoload_register('autoload');

$db = Db::getInstance();
$dbh = $db->getConnection();

$stmt = $dbh->prepare('SELECT user_id, user_name, user_email, user_ip, user_rank, user_posts, user_sex, user_birthday, user_country, user_style FROM forum_users ORDER BY user_name');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

print '<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>Users</title>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>
<table>
<tr>
<th>key</th>
<th>id</th>
<th>name</th>
<th>email</th>
<th>ip</th>
<th>rank</th>
<th>posts</th>
<th>sex</th>
<th>birthday</th>
<th>country</th>
<th>style</th>
</tr>';

foreach($data as $key => $value) {
	print '<tr>
	<td>'.$key.'</td>
	<td>'.$value['user_id'].'</td>
	<td>'.$value['user_name'].'</td>
	<td>'.$value['user_email'].'</td>
	<td>'.$value['user_ip'].'</td>
	<td>'.$value['user_rank'].'</td>
	<td>'.$value['user_posts'].'</td>
	<td>'.$value['user_sex'].'</td>
	<td>'.$value['user_birthday'].'</td>
	<td>'.$value['user_country'].'</td>
	<td>'.$value['user_style'].'</td>
	</tr>';
}

print '</table>';
/*
print '<p>';
print_r($data);
print '</p>';

$pages = array_chunk($data, 5);

foreach($pages as $k => $v) {
	print '<p>'.$k.': ';
	print_r($v);
	print '</p>';
}
*/

print '<hr>';

$ids = array('4', '24', '25');

$sth = $dbh->prepare('SELECT connected_sessionid FROM forum_connected WHERE connected_userid IN ('.placeholders('?', sizeof($ids)).')');
$sth->execute($ids);
$sessions = $sth->fetchAll(PDO::FETCH_ASSOC);

if(count($sessions) > 0) {
	print '<p>sessions results: ';
	print_r($sessions);
	print '</p>';
}

print '</body>
</html>';