<?php
/*
 * https://github.com/cfwin/Secure-PHP-Session-Class/blob/master/session.class.php
*/

class session {
	private $read_stmt;
	private $w_stmt;
	private $key_stmt;
	private $delete_stmt;
	private $gc_stmt;
	private $session_params = array();
	private $salt;
	const SESS_CIPHER = 'aes-128-cbc';
	protected static $dbh;
	public static $table_prefix = '';

    public static function set_dbh($dbh) {
		self::$dbh = $dbh;
	}

	function __construct() {
		session_set_save_handler(array($this, 'open'),
								 array($this, 'close'),
								 array($this, 'read'),
								 array($this, 'write'),
								 array($this, 'destroy'),
								 array($this, 'gc')
		);
		
		register_shutdown_function('session_write_close');
		
		$this->salt = '6ieacr)gz*&e20-8|=kldf&j?u=!1_-~3&&j17>m7a0!a2ki/m&1gv_lqw!zh/~s';
		$this->session_params = array(
			'session.hash_function'				=> 'sha512',	// default = sha512
			'session.hash_bits_per_character'	=> 4,			// default = 5
			'session.use_only_cookies'			=> 1,			// default = 1
			'session.gc_probability'			=> 1,			// default = 1
			'session.gc_divisor'				=> 10			// default = 100
		);
		
		if(!in_array($this->session_params['session.hash_function'], hash_algos()))
			$this->session_params['session.hash_function'] = 'sha512';
	}
	
	function start_session($session_name = null, $secure = false, $http_only = true, $regenerate_id = false) {
		foreach($this->session_params as $key => $value)
			ini_set($key, $value);
		
		unset($key, $value);
		
		$cookie_params = session_get_cookie_params();
		
		session_set_cookie_params($cookie_params['lifetime'], $cookie_params['path'], $cookie_params['domain'], $secure, $http_only);
		
		if($session_name != null)
			session_name($session_name);
		
		session_start();
		
		if($regenerate_id)
			session_regenerate_id(true);
	}
	
	function open() {
		return true;
	}
	
	function close() {
		return true;
	}
	
	function read($id) {
		if(!isset($this->read_stmt))
			$this->read_stmt = self::$dbh->prepare('SELECT session_data FROM '.self::$table_prefix.'sessions WHERE session_id = ? LIMIT 1');
		
		$this->read_stmt->bindValue(1, $id, PDO::PARAM_INT);
		$this->read_stmt->execute();
		$data = $this->read_stmt->fetch(PDO::FETCH_ASSOC);
		
		$key = $this->getkey($id);
		
		return $this->decrypt($data['session_data'], $key);
	}
	
	function write($id, $data) {
		$key = $this->getkey($id);
		$data = $this->encrypt($data, $key);
		$time = time();
		
		if(!isset($this->w_stmt))
			$this->w_stmt = self::$dbh->prepare('REPLACE INTO '.self::$table_prefix.'sessions (session_id, session_set_time, session_data, session_key) VALUES ('.implode(',', array_fill(0, 4, '?')).')');
		
		return $this->w_stmt->execute(array($id, $time, $data, $key));
	}
	
	function destroy($id) {
		if(!isset($this->delete_stmt))
			$this->delete_stmt = self::$dbh->prepare('DELETE FROM '.self::$table_prefix.'sessions WHERE session_id = ?');
		
		$this->delete_stmt->bindValue(1, $id, PDO::PARAM_INT);
		return $this->delete_stmt->execute();
	}
	
	function gc($max) {
		if(!isset($this->gc_stmt))
			$this->gc_stmt = self::$dbh->prepare('DELETE FROM '.self::$table_prefix.'sessions WHERE session_set_time < ?');
		
		$old = time() - $max;
		
		$this->gc_stmt->bindValue(1, $old, PDO::PARAM_INT);
		return $this->gc_stmt->execute();
	}
	
	private function getkey($id) {
		if(!isset($this->key_stmt))
			$this->key_stmt = self::$dbh->prepare('SELECT session_key FROM '.self::$table_prefix.'sessions WHERE session_id = ? LIMIT 1');
		
		$this->key_stmt->bindValue(1, $id, PDO::PARAM_INT);
		$this->key_stmt->execute();
		$key = $this->key_stmt->fetch(PDO::FETCH_ASSOC);
		
		if($key)
			return $key['session_key'];
		else {
			$random_key = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			return $random_key;
		}
	}
	
	private function encrypt($data, $key) {
		$key = substr(hash('sha256', $this->salt.$key.$this->salt), 0, 32);
		
		$ivlen = openssl_cipher_iv_length(self::SESS_CIPHER);
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($data, self::SESS_CIPHER, $key, OPENSSL_RAW_DATA, $iv);
		
		$ciphertext = base64_encode($iv.$ciphertext_raw);
		
		return $ciphertext;
	}
	
	private function decrypt($data, $key) {
		$key = substr(hash('sha256', $this->salt.$key.$this->salt), 0, 32);
		
		$decoded = base64_decode($data);
		
		$ivlen = openssl_cipher_iv_length(self::SESS_CIPHER);
		$iv = substr($decoded, 0, $ivlen);
		$ciphertext_raw = substr($decoded, $ivlen);
		$original_data = openssl_decrypt($ciphertext_raw, self::SESS_CIPHER, $key, OPENSSL_RAW_DATA, $iv);
		
		return $original_data;
	}
}