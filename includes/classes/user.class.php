<?php
class user {
	private $sessionid;
	public $data = array();
	private $cookie = array();
	private $ip;
	private $browser;
	private $time_now;
	private $crawlers = array('abachobot', 'accoona-ai-agent', 'baiduspider', 'becomebot', 'bingbot', 'dataparksearch', 'deepindex', 'exabot', 'fast-webcrawler', 'fdse robot', 'fyberspider', 'gaisbot', 'gigabot', 'girafabot', 'googlebot', 'ia_archiver', 'jyxobot', 'lapozzbot', 'mj12bot', 'mnogosearch', 'mojeekbot', 'msnbot', 'ng-search', 'orbiter', 'pagebiteshyperbot', 'psbot', 'scrubby', 'seekbot', 'sensis web crawler', 'snappy', 'surveybot', 'teoma', 'thumbnail.cz robot', 'voilabot', 'voyager', 'webcollage', 'wofindeich robot', 'yacybot', 'yahoo', 'yeti', 'zspider', 'zyborg');
	protected static $dbh;

	// default values that are used in class methods if no settings are specified
	private static $settings = array(
		'session_gc_probability'	=> 1,					// probability to run garbage collection function in % (1% by default)
		'session_expiration_time'	=> 3600,				// in seconds, default time is an hour
		'max_autologin_time'		=> 259200,				// in seconds, default time is 72h = 3 days
		'sessions_per_ip'			=> 10,					// number max of simultaneous sessions per ip
		'cookies_expiration_time'	=> 365,					// number of days, default cookie time is valable a year
		'cookies_name'				=> 'autologin_key',		// must be an alphanumeric string if specified (a-zA-Z0-9_)
		'cookies_secure'			=> false,				// boolean, defines if cookies should be transmitted by the ssl protocol
		'table_prefix'				=> '',					// must also be an alphanumeric string if specified
		'accepted_langs'			=> array('en'),			// accepted user local languages
		'default_lang'				=> 'en'					// default visitors language if no one is detected
	);

	// this prop gives the possibility to configure the language of the class instance (e.g. depending on the user's location, language of its browser...)
	private static $lang = array(
		'user_banned_permanently' => 'You have been banned from this site for the reason « %s » permanently.',
		'user_banned_temporarily' => 'You have been banned from this site for the reason « %s » for %d day(s).',
		'too_many_sessions' => 'There are too many sessions connected from your network, please try again later.',
		'site_unavailable_robot' => 'The site is temporarily unavailable, please try again later.'
	);

    public static function set_dbh($dbh) {
		self::$dbh = $dbh;
	}

	/*
	* static method that can be called as user::set_settings()
	*/
	public static function set_settings($settings) {
		if(is_array($settings) && !empty($settings)) {
			foreach($settings as $key => $value) {
				if(isset(self::$settings[$key]) && gettype(self::$settings[$key]) == gettype($value))
					self::$settings[$key] = $value;
			}
			
			unset($key, $value);
		}
	}

	public function __construct() {
		$this->session_begin();
	}

	private function session_begin() {
		$this->time_now = time();
		$this->sessionid = session_id();
		$this->ip = (!empty($_SERVER['REMOTE_ADDR'])) ? (string) $_SERVER['REMOTE_ADDR'] : '';
		$this->browser = (!empty($_SERVER['HTTP_USER_AGENT'])) ? (string) $_SERVER['HTTP_USER_AGENT'] : '';

		// garbage collection
		if(rand(0, 100) <= self::$settings['session_gc_probability'])
			$this->gc();
		
		if(!empty($_SESSION['user']))
			$this->data = $_SESSION['user'];
		
		if(isset($this->data['user_id'])) {
			if($this->data['sessionid'] == $this->sessionid) {
				$session_expired = false;
				
				if(!$this->data['autologin']) {
					if($this->data['user_rank'] > GUEST && $this->time_now-$this->data['time'] > self::$settings['session_expiration_time']+60)
						$session_expired = true;
				}
				elseif(self::$settings['max_autologin_time'] > 0 && $this->time_now-$this->data['time'] > self::$settings['max_autologin_time']+60)
					$session_expired = true;
				
				if(!$session_expired) {
					if($this->time_now-$this->data['last'] > 300) {
						$sth = self::$dbh->prepare('SELECT COUNT(connected_sessionid) FROM '.self::$settings['table_prefix'].'connected WHERE connected_sessionid = ?');
						$sth->execute(array($this->sessionid));
						$nb_sessions = $sth->fetchColumn();
						
						if($nb_sessions > 0) {
							$sth = self::$dbh->prepare('UPDATE '.self::$settings['table_prefix'].'connected SET connected_last = ? WHERE connected_sessionid = ? AND connected_last+? < ?');
							$sth->execute(array($this->time_now, $this->sessionid, 300, $this->time_now));
							$results = $sth->rowCount();
							unset($sth);
						}
						else {
							$sth = self::$dbh->prepare('INSERT INTO '.self::$settings['table_prefix'].'connected(connected_sessionid, connected_userid, connected_ip, connected_browser, connected_robot, connected_time, connected_last, connected_autologin, connected_admin) VALUES ('.implode(',', array_fill(0, 9, '?')).')');
							$sth->execute(array($this->sessionid, $this->data['user_id'], $this->data['ip'], $this->data['browser'], $this->data['robot'], $this->time_now, $this->time_now, $this->data['autologin'], $this->data['admin']));
							unset($sth);
							
							$this->data['time'] = $this->time_now;
						}

						$this->data['last'] = $this->time_now;
						$_SESSION['user'] = $this->data;
					}
					
					return true;
				}
			}
		}
		
		return $this->session_create();
	}
	
	public function session_create($userid = false, $set_admin = false, $set_key = false) {
		$this->data = array();
		$robot = '';
		
		if(preg_match('/('.implode('|', $this->crawlers).')/', strtolower($this->browser), $matches))
			$robot = $matches[1];
		
		if($robot == null && isset($_COOKIE[self::$settings['cookies_name']])) {
			if(preg_match('/^id:([0-9]{1,8})\|([a-z0-9]{32})$/', $_COOKIE[self::$settings['cookies_name']], $cookie_data)) {
				$this->cookie['userid'] = (int) $cookie_data[1];
				$this->cookie['key'] = $cookie_data[2];
				
				$sth = self::$dbh->prepare('SELECT user_id, user_name, user_rank, user_avatarid, user_style, user_lang, user_timezone
				FROM '.self::$settings['table_prefix'].'keys
				LEFT JOIN '.self::$settings['table_prefix'].'users ON '.self::$settings['table_prefix'].'users.user_id = '.self::$settings['table_prefix'].'keys.key_userid
				WHERE key_id = ? AND key_userid = ? AND key_userid <> ?');
				$sth->execute(array($this->cookie['key'], $this->cookie['userid'], ANONYMOUS));
				$data = $sth->fetch(PDO::FETCH_ASSOC);
				unset($sth);
				
				if(isset($data['user_id']) && (!$userid || $data['user_id'] == $userid))
					$this->data = $data;
			}
		}
		
		if(count($this->data) == 0) {
			$this->cookie = array();
			
			if(!$userid) {
				switch($robot) {
					case null:
						$userid = ANONYMOUS;
						break;
					default:
						$userid = ROBOT;
				}
			}
			
			$sth = self::$dbh->prepare('SELECT user_id, user_name, user_rank, user_avatarid, user_style, user_lang, user_timezone FROM '.self::$settings['table_prefix'].'users WHERE user_id = ?');
			$sth->execute(array($userid));
			$this->data = $sth->fetch(PDO::FETCH_ASSOC);
			unset($sth);
		}
		
		// ban check
		if($this->data['user_rank'] < FOUNDER) {
			$sth = self::$dbh->prepare('SELECT ban_id, ban_userid, ban_ip, ban_end, ban_reason FROM '.self::$settings['table_prefix'].'banlist WHERE ban_userid = ? OR ban_ip = ?');
			$sth->execute(array($this->data['user_id'], $this->ip));
			$ban = $sth->fetchAll(PDO::FETCH_ASSOC);
			unset($sth);
			
			if(count($ban) > 0) {
				// we do a foreach loop because the user may have been banned multiple times/by multiple ways (id, ip...) so we have to check each value
				foreach($ban as $key => $value) {
					if(!empty($value['ban_ip'])) {
							if($value['ban_end'] > 0 && $value['ban_end'] < $this->time_now) {
								$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'banlist WHERE ban_id = ?');
								$sth->execute(array($value['ban_id']));
								unset($sth);
							}
							else {
								$this->session_kill(false);

								die(($value['ban_end'] == 0) ? sprintf(self::$lang['user_banned_permanently'], display($value['ban_reason'])) : sprintf(self::$lang['user_banned_temporarily'], display($value['ban_reason']), round(($value['ban_end']-$this->time_now)/86400)));
							}
					}
					elseif(!empty($value['ban_userid']) && $this->data['user_rank'] > GUEST) {
						if($value['ban_end'] > 0 && $value['ban_end'] < $this->time_now) {
							$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'banlist WHERE ban_userid = ?');
							$sth->execute(array($this->data['user_id']));
							unset($sth);
						}
						else
							$this->session_kill(false);
					}
				}

				unset($key, $value);
			}
		}
		
		if($robot != null) {
			$sth = self::$dbh->prepare('SELECT connected_sessionid AS sessionid, connected_ip AS ip, connected_browser AS browser, connected_robot AS robot, connected_time AS time, connected_last AS last, connected_autologin AS autologin, connected_admin AS admin FROM '.self::$settings['table_prefix'].'connected WHERE connected_userid = ? AND connected_robot = ?');
			$sth->execute(array($this->data['user_id'], $robot));
			$data = $sth->fetch(PDO::FETCH_ASSOC);
			unset($sth);
			
			if(isset($data['sessionid'])) {
				if($data['ip'] == $this->ip && $data['browser'] == $this->browser) {
					$this->data = array_merge($this->data, $data);
					
					if($this->time_now-$this->data['time'] > 60) {
						// we limit the number of connections to one per minute for bots so they do not consume too much bandwidth (this does not protect against ddos)
						$sth = self::$dbh->prepare('UPDATE '.self::$settings['table_prefix'].'connected SET connected_sessionid = ?, connected_time = ?, connected_last = ? WHERE connected_userid = ? AND connected_robot = ?');
						$sth->execute(array($this->sessionid, $this->time_now, $this->time_now, $this->data['user_id'], $robot));
						unset($sth);
						
						$this->data['sessionid'] = $this->sessionid;
						$this->data['time'] = $this->data['last'] = $this->time_now;
						
						$_SESSION['user'] = $this->data;
						
						return true;
					}
					else {
						$this->session_kill(false);
						
						die(self::$lang['site_unavailable_robot']);
					}
				}
				else {
					$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'connected WHERE connected_userid = ? AND connected_robot = ?');
					$sth->execute(array($this->data['user_id'], $robot));
					unset($sth);
				}
			}
		}

		// browser language check
		if(($this->data['user_rank'] == GUEST || empty($this->data['user_lang'])) && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$browser_preferred_langs = explode(',', substr(trim($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 100));
			
			if(count($browser_preferred_langs) > 0) {
				$preferred_langs = array();
				
				// extracts languages and sorts them by preference order
				foreach($browser_preferred_langs as $value) {
					if(!empty($value) && preg_match('/(\*|[a-zA-Z0-9]{1,8}(?:-[a-zA-Z0-9]{1,8})*)(?:\s*;\s*q\s*=\s*(0(?:\.\d{0,3})|1(?:\.0{0,3})))?/', trim($value), $match))
						$preferred_langs[!empty($match[2]) ? $match[2] : '1.0'] = strtolower($match[1]);
				}

				unset($value);
				
				krsort($preferred_langs);
				
				// check preferred languages
				foreach($preferred_langs as $value) {
					if(stripos($value, '-'))
							$value = stristr($value, '-', true);
					
					if(in_array($value, self::$settings['accepted_langs'])) {
						$this->data['user_lang'] = $value;
						
						break;
					}
				}
				
				unset($value);
			}
		}

		$autologin = (($set_key == true || isset($this->cookie['key'])) && $this->data['user_rank'] > GUEST) ? true : false;
		$admin = ($set_admin == true && $this->data['user_rank'] >= ADMIN) ? true : false;

		$sql_array = array(
			'sessionid' => $this->sessionid,
			'userid' => $this->data['user_id'],
			'ip' => $this->ip,
			'browser' => trim(substr($this->browser, 0, 149)),
			'robot' => $robot,
			'time' => $this->time_now,
			'last' => $this->time_now,
			'autologin' => ($autologin == true) ? 1:0,
			'admin' => ($admin == true) ? 1:0
		);
		
		// prevents session duplication
		$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'connected WHERE connected_sessionid = ?');
		$sth->execute(array($this->sessionid));
		
		if(!empty($_SESSION['user']) && $_SESSION['user']['sessionid'] != $this->sessionid)
			$sth->execute(array($_SESSION['user']['sessionid']));
		
		unset($sth);
		
		$sth = self::$dbh->prepare('SELECT COUNT(connected_sessionid) FROM '.self::$settings['table_prefix'].'connected WHERE connected_ip = ? AND connected_time+? > ?');
		$sth->execute(array($this->ip, 60, $this->time_now));
		$count_sessions = $sth->fetchColumn();
		unset($sth);
		
		if($count_sessions >= self::$settings['sessions_per_ip']) {
			$this->session_kill(false);
			
			die(self::$lang['too_many_sessions']);
		}
		
		$sth = self::$dbh->prepare('INSERT INTO '.self::$settings['table_prefix'].'connected(connected_sessionid, connected_userid, connected_ip, connected_browser, connected_robot, connected_time, connected_last, connected_autologin, connected_admin) VALUES ('.implode(',', array_fill(0, 9, '?')).')');
		$sth->execute(array_values($sql_array));
		unset($sth);
		
		$this->data = array_merge($this->data, $sql_array);
		
		$_SESSION['user'] = $this->data;
		
		unset($sql_array);
		
		if($autologin) {
			$new_key = md5(random_str());
			$sql_array = array($new_key, $this->data['user_id'], $this->ip, $this->time_now);
			
			if(isset($this->cookie['key'])) {
				$sql_array[] = $this->cookie['key'];
				
				$sth = self::$dbh->prepare('UPDATE '.self::$settings['table_prefix'].'keys SET key_id = ?, key_userid = ?, key_ip = ?, key_last = ? WHERE key_id = ?');
				$sth->execute($sql_array);
				unset($sth);
			}
			else {
				$sth = self::$dbh->prepare('INSERT INTO '.self::$settings['table_prefix'].'keys(key_id, key_userid, key_ip, key_last) VALUES('.implode(',', array_fill(0, 4, '?')).')');
				$sth->execute($sql_array);
				unset($sth);
			}
			
			$this->cookie['key'] = $new_key;
			
			unset($new_key);
		}
		
		if($robot == null) {
			$this->set_cookie(isset($this->cookie['key']) ? $this->time_now+(self::$settings['cookies_expiration_time']*86400) : 1);
			
			if($this->data['user_rank'] > GUEST) {
				$sth = self::$dbh->prepare('UPDATE '.self::$settings['table_prefix'].'users SET user_last = ? WHERE user_id = ?');
				$sth->execute(array($this->time_now, $this->data['user_id']));
				unset($sth);
			}
		}
		
		return true;
	}

	public function session_kill($new_session = true) {
		if(!empty($_SESSION['user'])) {
			$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'connected WHERE connected_sessionid = ?');
			$sth->execute(array($_SESSION['user']['sessionid']));
			unset($sth);
			
			unset($_SESSION['user']);
		}

		if($this->data['user_rank'] > GUEST) {
			$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'keys WHERE key_userid = ?');
			$sth->execute(array($this->data['user_id']));
			unset($sth);

			if(isset($this->cookie['key']))
				$this->cookie = array();

			$this->data = array();

			$sth = self::$dbh->prepare('SELECT user_id, user_name, user_rank, user_avatarid, user_style, user_lang, user_timezone FROM '.self::$settings['table_prefix'].'users WHERE user_id = ?');
			$sth->execute(array(ANONYMOUS));
			$this->data = $sth->fetch(PDO::FETCH_ASSOC);
		}

		$this->set_cookie();

		if($new_session)
			$this->session_create(ANONYMOUS);

		return true;
	}
	
	private function gc() {
		$sth = self::$dbh->prepare('DELETE FROM '.self::$settings['table_prefix'].'connected WHERE connected_last+? < ?');
		$sth->execute(array(300, $this->time_now));
		unset($sth);
		
		return true;
	}
	
	private function set_cookie($expiration = 1) {
		setrawcookie(self::$settings['cookies_name'], !empty($this->cookie['key']) ? 'id:'.$this->data['user_id'].'|'.$this->cookie['key'] : '', $expiration, '/', '', self::$settings['cookies_secure'], true);
	}
}