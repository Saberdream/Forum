<?php
function get_user($user) {
	global $config, $dbh;

	$sth = $dbh->prepare('SELECT user_name, user_id, user_name, user_email, user_ip, user_time, user_last, user_rank, user_posts, user_avatar, user_avatarid, user_sign, user_desc, user_sex, user_birthday, user_country FROM '.$config['table_prefix'].'users WHERE user_name = ? AND user_name <> "anonymous" AND user_name <> "robot"');
	$sth->execute(array($user));
	$rows = $sth->fetch(PDO::FETCH_ASSOC);
	unset($sth);

	return $rows;
}

function count_ban($userid) {
	global $config, $dbh;

	$sth = $dbh->prepare('SELECT COUNT(ban_id) FROM '.$config['table_prefix'].'banlist WHERE ban_userid = ?');
	$sth->execute(array($userid));
	$count = $sth->fetchColumn();
	
	return $count;
}

function posts_bar($nb) {
	if($nb == 0) $width = 0;
	elseif($nb < 5) $width = 1;
	elseif($nb > 240000) $width = 100;
	else $width = floor(log($nb, 1.131));
	return $width;
}

// function that gives how many years old is a user with his birthday
function age($birth) {
	$birth = explode('/', $birth);
	$day = $birth[0];
	$month = $birth[1];
	$year = $birth[2];
	$today['month'] = date('n');
	$today['day'] = date('j');
	$today['year'] = date('Y');
	$years = $today['year'] - $year;
	
	if($today['month'] <= $month) {
		if($month == $today['month']) {
			if($day > $today['day'])
				$years--;
		}
		else
			$years--;
	}
	
	return $years;
}