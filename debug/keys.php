<?php
$root_path = '../';
require $root_path.'includes/constants.php';
require $root_path.'config.php';
require $root_path.'includes/autoload.php';

spl_autoload_register('autoload');

$db = Db::getInstance();
$dbh = $db->getConnection();

$sth = $dbh->prepare('SELECT user_id, user_name, user_rank, user_style
FROM forum_keys
LEFT JOIN forum_users ON forum_users.user_id = forum_keys.key_userid
WHERE key_id = ? AND key_userid = ? AND key_userid <> ?');
$sth->execute(array('c83282a23ad657b2177d029d649e2cf8', 1, ANONYMOUS));
$data = $sth->fetch(PDO::FETCH_ASSOC);
unset($sth);

if(isset($data['user_id']))
	print_r($data);
else
	print 'not result found in db';