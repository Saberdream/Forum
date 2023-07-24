<?php
class token {
	private $name;
	public $token;

	public function __construct($name) {
		if(session_id() == '')
			session_start();
		
		$this->name = $name;
		$this->generate();
	}

	private function generate() {
		if(session_id() == '')
			session_start();
		
		$this->token = md5(uniqid(mt_rand(), true));
		$_SESSION[$this->name.'_token'] = $this->token;
		$_SESSION[$this->name.'_token_time'] = time();
	}

	public static function verify($name = '', $limit = 600, $method = 'post', $referer = null) {
		if(session_id() == '')
			session_start();
		
		if($referer == null || (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $referer))
			if(isset($_SESSION[$name.'_token']) && isset($_SESSION[$name.'_token_time']) && $_SESSION[$name.'_token_time'] >= (time() - $limit))
				if($method == 'post') {
					if(isset($_POST['token']) && $_SESSION[$name.'_token'] == $_POST['token'])
						return true;
				}
				elseif($method == 'get') {
					if(isset($_GET['token']) && $_SESSION[$name.'_token'] == $_GET['token'])
						return true;
				}
		
		return false;
	}

	public static function destroy($name = '') {
		if(session_id() == '')
			session_start();
		
		if(isset($_SESSION[$name.'_token']) && isset($_SESSION[$name.'_token_time']))
			unset($_SESSION[$name.'_token'], $_SESSION[$name.'_token_time']);
		
		return true;
	}
}