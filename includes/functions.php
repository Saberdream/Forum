<?php
function display($str) {
	return htmlspecialchars($str);
}

function encrypt($str) {
	return hash('sha256', $str);
}

function read_config_file() {
	global $root_path;
	
	$config_file = $root_path.'cache/config.dat.ini';
	
	if(file_exists($config_file)) {
		if(!filesize($config_file))
			die('Error while reading the configuration file.');
		
		return parse_ini_file($config_file);
	}
	
	return false;
}

function get_notifications() {
	global $dbh, $user, $config;

	$sth = $dbh->prepare('SELECT COUNT(notif_id) FROM '.$config['table_prefix'].'notifications WHERE notif_viewed = 0 AND notif_userid = ?');
	$sth->execute(array($user->data['user_id']));
	$nb = $sth->fetchColumn();
	unset($sth);

	return $nb;
}

function escape_quotes($str) {
	return str_replace('\'', '\\\'', $str);
}

function random_str($length = 30, $specials = null) {
	$key = '';
	$pool = array_merge(range(0,9), range('a', 'z'));
	
	if($specials != null)
		$pool = array_merge($pool, str_split($specials));
	
	for($i=0; $i < $length; $i++)
		$key .= $pool[mt_rand(0, count($pool)-1)];
	
	return $key;
}

function random_int($length = 15) {
	$str = '';
	
	for($i = 0; $i < $length; $i++) {
		$rand = (string) mt_rand();
		$str .= $rand[mt_rand(0,strlen($rand)-1)];
	}
	
	return $str;
}

/*
 * @param $str			The placeholder marker, for example ?
 * @param $size			The number of values that are inserted, must be a multiple of the cols variable
 * @param $cols			The number of columns per row, must be a non null natural number (because we can't divide a number by zero)
 * @param $separator	The separator between the values (, for mysql/pdo)
*/
function placeholders_multi($str = '?', $size = 0, $cols = 0, $separator = ',') {
	if($size == 0 || $cols == 0)
		return false;

	if($size % $cols != 0)
		die('Error: number of values ('.$size.') is not a multiple of number of columns ('.$cols.')');

	$markers = $rows = array();

	for($x=0; $x < $cols; $x++)
		$markers[] = $str;

	$markers = '('.implode($separator, $markers).')';

	for($i = 0; $i < ($size/$cols); $i++)
		$rows[] = $markers;

	return implode($separator, $rows);
}

function placeholders($str, $size = 0, $separator = ',') {
	return implode($separator, array_fill(0, $size, $str));
}

function remove_spec($string, $separator = '-'){
	$specials = array(
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
		'/[^a-zA-Z0-9]/u'	=> $separator,
		'/['.$separator.']+/'						=> $separator,
		'/^['.$separator.']+|['.$separator.']+$/'	=> ''
	);
	
	return preg_replace(array_keys($specials), array_values($specials), trim($string));
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

function date_formatted($time) {
	global $lang;
	
	$date = date($lang['date']['format'], $time);
	$date = str_replace(array_keys($lang['days']), $lang['days'], $date);
	
	return $date;
}

function exception_handler($exception) {
	global $root_path;
	
    // these are our templates
    $traceline = "#%s %s(%s): %s(%s)";
    $msg = "PHP Fatal error:  Uncaught exception '%s' with message '%s' in %s:%s\nStack trace:\n%s\n  thrown in %s on line %s";
	$dir = $root_path.'logs/';
	
    // alter your trace as you please, here
    $trace = $exception->getTrace();
    foreach ($trace as $key => $stackPoint) {
        // I'm converting arguments to their type
        // (prevents passwords from ever getting logged as anything other than 'string')
        $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
    }

    // build your tracelines
    $result = array();
    foreach ($trace as $key => $stackPoint) {
        $result[] = sprintf(
            $traceline,
            $key,
            $stackPoint['file'],
            $stackPoint['line'],
            $stackPoint['function'],
            implode(', ', $stackPoint['args'])
        );
    }
    // trace always ends with {main}
    $result[] = '#' . ++$key . ' {main}';

    // write tracelines into main template
    $msg = sprintf(
        $msg,
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        implode("\n", $result),
        $exception->getFile(),
        $exception->getLine()
    );
	
	file_put_contents($dir.time().' - '.random_int().'.txt', $msg);
	
	die('An internal server error has occurred, please retry your request later.');
}

function get_server_load() {
    if(stristr(PHP_OS, 'win')) {
        $wmi = new COM('Winmgmts://');
        $server = $wmi->execquery('SELECT LoadPercentage FROM Win32_Processor');  
        $cpu_num = 0;
        $load_total = 0;
		
		foreach($server as $cpu) {
			$cpu_num++;
			$load_total += $cpu->loadpercentage;
		}
		
		$load = round($load_total/$cpu_num);
		return (int) $load;
    } 
    else {
		$load = sys_getloadavg();
		return (int) $load[0]*100;
    }
}

/*
 * @param $url				An url asked by a visitor in a form, a var passer in url... note that it can be manually passed by visitors by modifying their browser referer
 * @param $default_page		The url where the visitor is supposed to be redirected by default
*/
function previous_page($url = false, $default_page = './') {
	global $config;

	$root_domain = substr($config['domain_name'], 0, ((strpos($config['domain_name'], '/') !== false) ? strpos($config['domain_name'], '/') : strlen($config['domain_name'])));

	if(!$url) {
		if(isset($_SERVER['HTTP_REFERER']))
			$previous_page = (strpos(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), $root_domain) !== false) ? $_SERVER['HTTP_REFERER'] : $default_page;
		else
			$previous_page = $default_page;
	}
	else
		$previous_page = (strpos($url, $root_domain) !== false) ? $url : $default_page;

	return $previous_page;
}