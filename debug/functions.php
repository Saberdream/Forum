<?php
function dbconnect() {
	try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e) {
		die('Une erreur est survenue lors de la tentative de connexion à la bdd : ' .$e->getMessage());
	}
	return $pdo;
}

function session_begin() {
	global $pdo;
	$ip = $_SERVER['REMOTE_ADDR'];
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$time = time();
	if(session_id() == '')
		session_start();
	session_set_cookie_params(0, '/', '', false, true);
	if(!empty($_SESSION['user']) && $_SESSION['user']['rank'] > GUEST) {
		if($_SESSION['user']['time']+SESSION_TIME_LIMIT < time()) {
			try {
				connect_user($_SESSION['user']['username'], $_SESSION['user']['password']);
			}
			catch(Exception $e) {
				session_end();
			}
		}
	}
	elseif(isset($_COOKIE['forumautolog'])) {
		if(preg_match('/^login:([a-zA-Z0-9\-]{3,15})\|(.*)$/', $_COOKIE['forumautolog'], $logs)) {
			$username = $logs[1];
			$password = $logs[2];
			try {
				connect_user($username, $password);
			}
			catch(Exception $e) {
				unset($_COOKIE['forumautolog']);
			}
		}
	}
	if(empty($_SESSION['user'])) {
		try {
			connect_user('anonymous', '', false, false);
		}
		catch(Exception $e) {
			die('Erreur lors de la tentative de connexion au compte invité : '.$e->getMessage());
		}
	}
	
	try {
		$sth = $pdo->prepare('SELECT sess_username FROM forum_sessions WHERE sess_ip = :ip');
		$sth->execute(array(':ip' => $ip));
		$sess = $sth->fetch(PDO::FETCH_ASSOC);
		
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($sth);
	if($sess) {
		if($_SESSION['user']['username'] == $sess['sess_username']) {
			try {
				$query = $pdo->prepare('UPDATE forum_sessions SET sess_last = :time WHERE sess_ip = :ip');
				$query->execute(array(':time' => $time, ':ip' => $ip));
			}
			catch(Exception $e) {
				die('Erreur : ' .$e->getMessage());
			}
			unset($query);
		}
		else {
			try {
				$query = $pdo->prepare('UPDATE forum_sessions SET sess_userid = ?, sess_username = ?, sess_last = ? WHERE sess_ip = ?');
				$query->execute(array($_SESSION['user']['id'], $_SESSION['user']['username'], $time, $ip));
			}
			catch(Exception $e) {
				die('Erreur : ' .$e->getMessage());
			}
			unset($query);
		}
	}
	else {
		$bot = '';
		$crawlers = array('abachobot', 'accoona-ai-agent', 'baiduspider', 'becomebot', 'bingbot', 'dataparksearch', 'deepindex', 'exabot', 'fast-webcrawler', 'fdse robot', 'fyberspider', 'gaisbot', 'gigabot', 'girafabot', 'googlebot', 'ia_archiver', 'jyxobot', 'lapozzbot', 'mj12bot', 'mnogosearch', 'mojeekbot', 'msnbot', 'ng-search', 'orbiter', 'pagebiteshyperbot', 'psbot', 'scrubby', 'seekbot', 'sensis web crawler', 'snappy', 'surveybot', 'teoma', 'thumbnail.cz robot', 'voilabot', 'voyager', 'webcollage', 'wofindeich robot', 'yacybot', 'yahoo', 'yeti', 'zspider', 'zyborg');
		if(preg_match('/('.implode('|', $crawlers).')/', strtolower($ua), $matches)) {
			$bot = $matches[1];
		}
		try {
			$query = $pdo->prepare('INSERT INTO forum_sessions(sess_userid, sess_username, sess_ip, sess_ua, sess_bot, sess_time, sess_last) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$query->execute(array($_SESSION['user']['id'], $_SESSION['user']['username'], $ip, $ua, $bot, $time, $time));
		}
		catch(Exception $e) {
			die('Erreur : ' .$e->getMessage());
		}
		unset($query);
	}
	try {
		$query = $pdo->prepare('DELETE FROM forum_sessions WHERE sess_last+300 < :time');
		$query->execute(array(':time' => $time));
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($query);
}

function connect_user($username, $password = null, $cookie = false, $encrypted_password = true) {
	global $pdo, $conf;
	$time = time();
	if(empty($username) || !preg_match('/^[a-zA-Z0-9\-]{3,15}$/', $username)) {
		throw new Exception('Le pseudo est invalide.');
	}
	try {
		$sth = $pdo->prepare('SELECT user_id, user_password, user_rank FROM forum_users WHERE user_name = :username');
		$sth->execute(array(':username' => $username));
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	if(!$sth) {
		throw new Exception('Une erreur est survenue lors de la tentative de connexion à la bdd.');
	}
	try {
		$data = $sth->fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($sth);
	if(!$data) {
		throw new Exception('Ce pseudo n\'existe pas.');
	}
	try {
		$sth = $pdo->prepare('SELECT attempt_nb, attempt_time FROM forum_login_attempts WHERE attempt_ip = ?');
		$sth->execute(array($_SERVER['REMOTE_ADDR']));
		$attempts = $sth->fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($sth);
	if(!$attempts) {
		try {
			$query = $pdo->prepare('INSERT INTO forum_login_attempts(attempt_ip, attempt_username, attempt_time, attempt_ua) VALUES(?, ?, ?, ?)');
			$query->execute(array($_SERVER['REMOTE_ADDR'], $username, $time, $_SERVER['HTTP_USER_AGENT']));
		}
		catch(Exception $e) {
			die('Erreur : ' .$e->getMessage());
		}
		unset($query);
	}
	elseif($attempts['attempt_nb'] >= $conf['max_login_attempts']) {
		if($attempts['attempt_time']+$conf['attempt_wait_time'] > $time)
			throw new Exception('Vous avez fait trop de tentatives de connexion, vous devez attendre '.$conf['attempt_wait_time'].' seconde(s) avant de tenter de vous connecter à nouveau.');
		else {
			try {
				$query = $pdo->prepare('UPDATE forum_login_attempts SET attempt_nb = 0 WHERE attempt_ip = ?');
				$query->execute(array($_SERVER['REMOTE_ADDR']));
			}
			catch(Exception $e) {
				die('Erreur : ' .$e->getMessage());
			}
			unset($query);
		}
	}
	if(!$encrypted_password && $password !== null)
		$password = encrypt($password);
	if(encrypt($data['user_password']) !== $password) {
		try {
			$query = $pdo->prepare('UPDATE forum_login_attempts SET attempt_username = ?, attempt_time = ?, attempt_ua = ?, attempt_nb = attempt_nb+1 WHERE attempt_ip = ?');
			$query->execute(array($username, $time, $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']));
		}
		catch(Exception $e) {
			die('Erreur : ' .$e->getMessage());
		}
		unset($query);
		throw new Exception('Le mot de passe du compte est incorrect.');
	}
	try {
		$query = $pdo->prepare('UPDATE forum_login_attempts SET attempt_nb = 0 WHERE attempt_ip = ?');
		$query->execute(array($_SERVER['REMOTE_ADDR']));
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($query);
	if($data['user_rank'] < FOUNDER) {
		try {
			$sth = $pdo->prepare('SELECT ban_end, ban_reason FROM forum_banlist WHERE ban_userid = ?');
			$sth->execute(array($data['user_id']));
			$ban = $sth->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception $e) {
			die('Erreur : ' .$e->getMessage());
		}
		unset($sth);
		if($ban) {
			if($ban['ban_end'] > 0 && $ban['ban_end'] < $time) {
				try {
					$query = $pdo->prepare('DELETE FROM forum_banlist WHERE ban_userid = ?');
					$query->execute(array($data['user_id']));
				}
				catch(Exception $e) {
					die('Erreur : ' .$e->getMessage());
				}
				unset($query);
			}
			else {
				$duree = ($ban['ban_end'] == 0) ? 'définitive.' : 'de '.round(($ban['ban_end']-$time)/86400).' jour(s).';
				throw new Exception('Le pseudo est banni pour le motif « '.display($ban['ban_reason']).' » pour une durée '.$duree);
			}
		}
	}
	try {
		$query = $pdo->prepare('UPDATE forum_users SET user_name = ?, user_ip = ?, user_last = ? WHERE user_id = ?');
		$query->execute(array($username, $_SERVER['REMOTE_ADDR'], $time, $data['user_id']));
	}
	catch(Exception $e) {
		die('Erreur : ' .$e->getMessage());
	}
	unset($query);
	if($data['user_rank'] > GUEST) {
		try {
			$sth = $pdo->prepare('SELECT COUNT(log_id) FROM forum_login_log WHERE log_userid = ? AND log_ip = ? AND log_time+3600 > ?');
			$sth->execute(array($data['user_id'], $_SERVER['REMOTE_ADDR'], $time));
			$nblog = $sth->fetchColumn();
		}
		catch(Exception $e) {
			die('Erreur : ' .$e->getMessage());
		}
		unset($sth);
		if($nblog == 0) {
			try {
				$query = $pdo->prepare('INSERT INTO forum_login_log(log_userid, log_username, log_time, log_ip, log_ua) VALUES(?, ?, ?, ?, ?)');
				$query->execute(array($data['user_id'], $username, $time, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
			}
			catch(Exception $e) {
				die('Erreur : ' .$e->getMessage());
			}
			unset($query);
		}
	}
	if(session_id() == '')
		session_start();
	$_SESSION['user']['id'] = (int) $data['user_id'];
	$_SESSION['user']['username'] = $username;
	$_SESSION['user']['password'] = encrypt($data['user_password']);
	$_SESSION['user']['rank'] = (int) $data['user_rank'];
	$_SESSION['user']['time'] = $time;
	if($cookie) {
		setrawcookie('forumautolog', 'login:'.$username.'|'.encrypt($data['user_password']), $time+($conf['cookies_expires']*86400), '/', '', false, true);
	}
	return true;
}

function session_end() {
	if(session_id() == '')
		session_start();
	$_SESSION = array();
	if(ini_get("session.use_cookies")) {
		setcookie(session_name(), '', 1, '/', '', false, true);
	}
	if(!empty($_COOKIE))
		foreach($_COOKIE as $name => $value) :
			setcookie($name, '', 1, '/', '', false, true);
		endforeach;
	session_destroy();
}

function display($str) {
	return htmlspecialchars($str);
}

function autoload($class) {
	if($class == 'RainTPL')
		include ROOT_PATH.'includes/classes/rain.tpl.class.php';
	elseif($class == 'Mobile_Detect')
		include ROOT_PATH.'includes/classes/Mobile_Detect.class.php';
	elseif($class == 'User')
		include ROOT_PATH.'includes/classes/User.class.php';
}

function encrypt($str) {
	return hash('sha256', $str);
}

function read_config_file() {
	if(file_exists(ROOT_PATH.'/includes/cache/config.dat.ini'))
		return parse_ini_file(ROOT_PATH.'/includes/cache/config.dat.ini');
	else
		return false;
}

function generate_token($nom = '') {
	if(session_id() == '')
		session_start();
	$token = md5(uniqid(mt_rand(), true));
	$_SESSION[$nom.'_token'] = $token;
	$_SESSION[$nom.'_token_time'] = time();
    return $token;
}

function verify_token($nom = '', $limit = 600, $method = 'post', $referer = null) {
	if(session_id() == '')
		session_start();
	if( (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $referer) || $referer == null )
		if(isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) && $_SESSION[$nom.'_token_time'] >= (time() - $limit))
			if($method == 'post') {
				if(isset($_POST['token']) && $_SESSION[$nom.'_token'] == $_POST['token'])
					return true;
			}
			elseif($method == 'get') {
				if(isset($_GET['token']) && $_SESSION[$nom.'_token'] == $_GET['token'])
					return true;
			}
	return false;
}

function destroy_token($nom = '') {
	if(session_id() == '')
		session_start();
	if(	isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) )
		unset($_SESSION[$nom.'_token'], $_SESSION[$nom.'_token_time']);
	return true;
}

function random_int($length = 15) {
	$str = '';
	for($i = 0; $i < $length; $i++) {
		$rand = (string) mt_rand();
		$str .= $rand[mt_rand(0,strlen($rand)-1)];
	}
	return $str;
}

function placeholders($text, $count = 0, $separator = ",") {
	$result = array();
	if($count > 0) {
		for($x=0; $x<$count; $x++) {
			array_push($result, $text);
		}
	}
	return implode($separator, $result);
}

function remove_spec( $str, $sep = '-' ){
	$spec = array(
		'/[ÀÁÂÃÄÅAAA]/u'	=> 'A', 
		'/[àáâãäåaaa]/u'	=> 'a',
		'/[ÇCCCC]/u'		=> 'C', 
		'/[çcccc]/u'		=> 'c',
		'/[ÐDÐ]/u'			=> 'D',
		'/[ðdd]/u'			=> 'd',
		'/[ÈÉÊËEEEEE]/u'	=> 'E', 
		'/[èéêëeeeee]/u'	=> 'e',
		'/[GGGG]/u'			=> 'G', 
		'/[gggg]/u'			=> 'g',
		'/[HH]/u'			=> 'H',
		'/[hh]/u'			=> 'h',
		'/[ÌÍÎÏIIIII]/u'	=> 'I', 
		'/[ìíîïiiiii]/u'	=> 'i',
		'/[J]/u'			=> 'J',
		'/[j]/u'			=> 'j',
		'/[K]/u'			=> 'K',
		'/[k?]/u'			=> 'k',
		'/[LLL?L]/u'		=> 'L',
		'/[lll?l]/u'		=> 'l',
		'/[ÑNNN?]/u'		=> 'N',
		'/[ñnnn??]/u'		=> 'n',
		'/[ÒÓÔÕÖØOOO]/u'	=> 'O',
		'/[òóôõöøooo]/u'	=> 'o',
		'/[RRR]/u'			=> 'R',
		'/[rrr]/u'			=> 'r',
		'/[SSSŠ]/u'			=> 'S',
		'/[sssš?]/u'		=> 's',
		'/[TTT]/u'			=> 'T',
		'/[ttt]/u'			=> 't',
		'/[ÙÚÛÜUUUUUU]/u'	=> 'U',
		'/[ùúûüuuuuuu]/u'	=> 'u',
		'/[W]/u'			=> 'W',
		'/[w]/u'			=> 'w',
		'/[ÝŸY]/u'			=> 'Y',
		'/[ýÿy]/u'			=> 'y',
		'/[ZZŽ]/u'			=> 'Z',
		'/[zzž]/u'			=> 'z',
		'/[^a-zA-Z0-9]/u'	=> $sep,
		'/['.$sep.']+/'		=> $sep,
		'/^['.$sep.']+|['.$sep.']+$/'	=> ''
	);
	return preg_replace(array_keys($spec), array_values($spec), trim($str));
}

function bbcode($text) {
	$text = htmlspecialchars($text);
	$regex = array(
		'`\[b\](.*)\[/b\]`Usi',
		'`\[i\](.*)\[/i\]`Usi',
		'`\[u\](.*)\[/u\]`Usi',
		'`\[s\](.*)\[/s\]`Usi',
		'`\[img\](https?:\/\/(.*)\.(jpg|jpeg|gif|png))\[/img\]`Usi',
		'`\[url=(.*)\](.*)\[/url\]`Usi',
		'`\[url\](.*)\[/url\]`Usi',
		'`\[email\](.*)\[/email\]`Usi',
		'`\[email=(.*)\](.*)\[/email\]`Usi',
		'`\[left\](.*)\[/left\]`Usi',
		'`\[center\](.*)\[/center\]`Usi',
		'`\[right\](.*)\[/right\]`Usi',
		'`\[justify\](.*)\[/justify\]`Usi',
		'`\[list\](.+)\[/list\]`Usi',
		'`\[list=1\](.+)\[/list\]`Usi',
		'`\[list=I\](.+)\[/list\]`Usi',
		'`\[list=disc\](.+)\[/list\]`Usi',
		'`\[list=square\](.+)\[/list\]`Usi',
		'`\[\*\](.+)(?=(\[\*\]|</ul>|</ol>))`Usi',
		'`\[color=(.*)\](.*)\[/color\]`Usi',
		'`\[size=(.*)\](.*)\[/size\]`Usi',
		'`\[h1\](.*)\[/h1\]`Usi',
		'`\[h2\](.*)\[/h2\]`Usi',
		'`\[h3\](.*)\[/h3\]`Usi',
		'`\[h4\](.*)\[/h4\]`Usi',
		'`\[h5\](.*)\[/h5\]`Usi',
		'`\[kbd\](.*)\[/kbd\]`Usi'
	);
	$output = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<u>$1</u>',
		'<s>$1</s>',
		'<img src="$1" alt="$1" class="image-resize" />',
		'<a href="$1">$2</a>',
		'<a href="$1">$1</a>',
		'<a href="mailto:$1">$1</a>',
		'<a href="mailto:$1">$2</a>',
		'<span class="text-left">$1</span>',
		'<span class="text-center">$1</span>',
		'<span class="text-right">$1</span>',
		'<span class="text-justify">$1</span>',
		'<ul class="list-unstyled">$1</ul>',
		'<ol>$1</ol>',
		'<ol style="list-style-type:upper-roman;">$1</ol>',
		'<ul>$1</ul>',
		'<ul style="list-style-type:square;">$1</ul>',
		'<li>$1</li>',		
		'<span style="color:$1;">$2</span>',
		'<span style="font-size:$1;">$2</span>',
		'<h1>$1</h1>',
		'<h2>$1</h2>',
		'<h3>$1</h3>',
		'<h4>$1</h4>',
		'<h5>$1</h5>',
		'<kbd>$1</kbd>'
	);
	$text = preg_replace($regex, $output, $text);
	$text = preg_replace_callback('`\[code\](.*)\[/code\]`Usi', 'bbcode_code', $text);
	$text = preg_replace('`\[quote]`Usi', '<blockquote>', $text, -1, $quotes);
	$text = preg_replace('`\[/quote\]`Usi', '</blockquote>', $text, $quotes);
	$text = preg_replace_callback('`(?<=^|\s|<|>)(((f|ht){1}tps?://)([^\s<>"]+))`i', 'bbcode_url', $text);
	return nl2br($text);
}

function bbcode_code($match) {
	$matchs = explode("\n", $match[1]);
	$code = array();
	foreach($matchs as $line) :
		array_push($code, '<li>'.$line.'</li>');
	endforeach;
	return '<pre><ol>'.implode($code).'</ol></pre>';
}

function bbcode_url($match) {
	return '<a href="'.$match[1].'" target="_blank">'.$match[2].(mb_strlen($match[4], 'UTF-8')>40 ? substr($match[4], 0, 19).$match[4][19].'<span style="left:-9999em;position:absolute;letter-spacing:-1em;">'.substr($match[4], 20, -20).'</span>'.substr($match[4], -20) : $match[4]).'</a>';
}

function smileys($text, $max = 50, $file = './includes/cache/smilies.dat.ini') {
	global $conf;
	$list = parse_smilies($file);
	$pattern = '#('.implode('|', array_map('preg_quote', $list)).')#Usi';
	$text = preg_replace_callback(
		$pattern,
		function($match) use($list, $conf) {
			$keys = array_keys($list, $match[0]);
			return '<img src="http://'.display($conf['domain_name']).'/gallery/smilies/'.$keys[0].'" alt="'.$match[0].'" />';
		},
		$text, $max);
	return $text;
}

function parse_smilies($file) {
	if(file_exists($file))
		return parse_ini_file($file);
	else
		return false;
}

function age($birth)  {
	$birth = explode('/', $birth);
	$jour = $birth[0];
	$mois = $birth[1];
	$annee = $birth[2];
	$today['mois'] = date('n');
	$today['jour'] = date('j');
	$today['annee'] = date('Y');
	$annees = $today['annee'] - $annee;
	if ($today['mois'] <= $mois) {
	if ($mois == $today['mois']) {
	  if ($jour > $today['jour'])
		$annees--;
	  }
	else
	  $annees--;
	}
	return $annees;
}

function pagination($current_page, $nb_pages, $link = '?page=%d', $display_disabled = true, $around = 3, $firstlast = 1) {
	$pagination = array();
	if ( $nb_pages > 1 ) {
		if ( $current_page > 1 )
			$pagination[] = '<li><a href="'.sprintf($link, $current_page-1).'" aria-label="Previous">&laquo;</a></li>';
		elseif($display_disabled == true)
			$pagination[] = '<li class="disabled"><a href="#" aria-label="Previous">&laquo;</a></li>';
		
		for ( $i=1 ; $i<=$firstlast ; $i++ ) {
			if($display_disabled == true) $pagination[] = ($current_page==$i) ? '<li class="active"><a href="#">'.$i.'</a></li>' : '<li><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
			else $pagination[] = ($current_page==$i) ? '<li class="active">'.$i.'</li>' : '<li><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
		}
		
		if ( ($current_page-$around) > $firstlast+1 )
			$pagination[] = '<li class="disabled"><a href="#">&hellip;</a></li>';

		$start = ($current_page-$around)>$firstlast ? $current_page-$around : $firstlast+1;
		$end = ($current_page+$around)<=($nb_pages-$firstlast) ? $current_page+$around : $nb_pages-$firstlast;
		for ( $i=$start ; $i<=$end ; $i++ ) {
			if ( $i==$current_page ) {
				if($display_disabled == true) $pagination[] = '<li class="active"><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
				else $pagination[] = '<li class="active">'.$i.'</li>';
			}
			else
				$pagination[] = '<li><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
		}

		if ( ($current_page+$around) < $nb_pages-$firstlast )
			$pagination[] = '<li class="disabled"><a href="#">&hellip;</a></li>';

		$start = $nb_pages-$firstlast+1;
		if( $start <= $firstlast ) $start = $firstlast+1;
		for ( $i=$start ; $i<=$nb_pages ; $i++ ) {
			if($display_disabled == true) $pagination[] = ($current_page==$i) ? '<li class="active"><a href="#">'.$i.'</a></li>' : '<li><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
			else  $pagination[] = ($current_page==$i) ? '<li class="active">'.$i.'</li>' : '<li><a href="'.sprintf($link, $i).'">'.$i.'</a></li>';
		}

		if ( $current_page < $nb_pages )
			$pagination[] = '<li><a href="'.sprintf($link, ($current_page+1)).'" aria-label="Next">&raquo;</a></li>';
		elseif($display_disabled == true)
			$pagination[] = '<li class="disabled"><a href="#" aria-label="Next">&raquo;</a></li>';
	}
	else {
		if($display_disabled == true) $pagination[] = '<li class="active"><a href="#">1</a></li>';
		else $pagination[] = '<li class="active">1</li>';
	}
	return implode($pagination);
}

function imagethumb($image_src, $image_dest = null, $max_size = 100, $expand = false, $square = false) {
	if( !file_exists($image_src) ) return FALSE;

	// Récupère les infos de l'image
	$fileinfo = getimagesize($image_src);
	if( !$fileinfo ) return FALSE;

	$width		= $fileinfo[0];
	$height		= $fileinfo[1];
	$type_mime	= $fileinfo['mime'];
	$type_src	= str_replace('image/', '', $type_mime);
	$dst_x		= 0;
	$dst_y		= 0;
	
	if($image_dest) {
		$type = substr(strrchr($image_dest, '.'), 1);
		if($type == 'jpg')
			$type = 'jpeg';
	}
	else {
		$type = str_replace('image/', '', $type_mime);
	}
	
	if( !$expand && max($width, $height)<=$max_size && (!$square || ($square && $width==$height) ) )
	{
		// L'image est plus petite que max_size
		if($image_dest)
		{
			return copy($image_src, $image_dest);
		}
		else
		{
			header('Content-Type: '. $type_mime);
			return (boolean) readfile($image_src);
		}
	}

	// Calcule les nouvelles dimensions
	$ratio = $width / $height;

	if( $square )
	{
		$new_width = $dst_w = $new_height = $dst_h = $max_size;

		if( $ratio > 1 )
		{
			// Paysage
			$src_y = 0;
			$src_x = round( ($width - $height) / 2 );

			$src_w = $src_h = $height;
		}
		else
		{
			// Portrait
			$src_x = 0;
			$src_y = round( ($height - $width) / 2 );

			$src_w = $src_h = $width;
		}
	}
	elseif($expand)
	{
		// on demande une expansion pour prendre les dimensions maximales de max_size
		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;
		
		if(max($width, $height)<$max_size)
		{
			// l'image est plus petite que max_size et on demande un étirement
			$dst_x = ($max_size/2)-($width/2);
			$dst_y = ($max_size/2)-($height/2);
			$dst_w = $width;
			$dst_h = $height;
			$new_width = $max_size;
			$new_height = $max_size;
		}
		else
		{
			// si l'image est plus grande, on calcule la position manuellement
			if ( $ratio > 1 )
			{
				// Paysage
				$new_width = $dst_w = $new_height = $max_size;
				$dst_h = round( $max_size / $ratio );
				$dst_y = ($max_size/2)-($dst_h/2);
			}
			else
			{
				// Portrait
				$new_height = $dst_h = $new_width = $max_size;
				$dst_w = round( $max_size * $ratio );
				$dst_x = ($max_size/2)-($dst_w/2);
			}
		}
	}
	else
	{
		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		if ( $ratio > 1 )
		{
			// Paysage
			$new_width = $dst_w = $max_size;
			$new_height = $dst_h = round( $max_size / $ratio );
		}
		else
		{
			// Portrait
			$new_height = $dst_h = $max_size;
			$new_width = $dst_w = round( $max_size * $ratio );
		}
	}

	// Ouvre l'image originale
	$func = 'imagecreatefrom' . $type_src;
	if( !function_exists($func) ) return FALSE;

	$image_src = $func($image_src);
	$new_image = imagecreatetruecolor( $new_width, $new_height );

	// Gestion de la transparence pour les png
	if( $type=='png' )
	{
		imagealphablending($new_image,false);
		if( function_exists('imagesavealpha') )
			imagesavealpha($new_image,true);
	}

	// Gestion de la transparence pour les gif
	elseif( $type=='gif' && imagecolortransparent($image_src)>=0 && imagecolorstotal($image_src) > imagecolortransparent($image_src) )
	{
		$transparent_index = imagecolortransparent($image_src);
		$transparent_color = imagecolorsforindex($image_src, $transparent_index);
		$transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
		imagefill($new_image, 0, 0, $transparent_index);
		imagecolortransparent($new_image, $transparent_index);
	}

	// Redimensionnement de l'image
	imagecopyresampled(
		$new_image, $image_src,
		$dst_x, $dst_y, $src_x, $src_y,
		$dst_w, $dst_h, $src_w, $src_h
	);
	
	// Enregistrement de l'image
	$func = 'image'. $type;
	if($image_dest)
	{
		$func($new_image, $image_dest);
	}
	else
	{
		header('Content-Type: '. $type_mime);
		$func($new_image);
	}

	// Libération de la mémoire
	imagedestroy($new_image); 

	return TRUE;
}

function date_fr($time) {
	$days_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$days_fr = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
	$s = date('S', $time) == 'st' ? 'er' : '';
	$date_d = date('j', $time).$s;
	$date_m = str_replace($days_en, $days_fr, date('F', $time));
	return $date_d.' '.$date_m.' '.date('Y à H:i:s', $time);
}
