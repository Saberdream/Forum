<?php
try {
	$sth = $pdo->prepare('SELECT * FROM forum_users ORDER BY user_id',
	array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
	$sth->execute();
}
catch(Exeception $e) {
	die ('Erreur : ' .$e->getMessage());
}

if($sth) {
	while($data = $sth->fetch(PDO::FETCH_ASSOC))
	{
		print 'Id : '.intval($data['user_id']).' Pseudo : '.display($data['user_name']).' Mot de passe : '.display($data['user_password']).'<br />';
	}
}
$sth->closeCursor();
