<?php
class Db {
	private $_connection;
	private static $_instance;		// The single instance
	private $_host 		 = DB_HOST;
	private $_username 	 = DB_USER;
	private $_password 	 = DB_PSWD;
	private $_database	 = DB_NAME;
	private $error;					// get any error
	private $options = array(
		PDO::ATTR_PERSISTENT => true,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	);
	
	public function __construct() {
		$dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_database;
		try {
			$this->_connection = new \PDO($dsn, $this->_username, $this->_password, $this->options);
		}
		catch(Exception $e) {
			$this->error = 'An error has occurred while trying to connect to the database: ' .$e->getMessage();
		}
	}
	
	public static function configure($options) {
		$this->options = $options;
	}
	
    /*
     * Get an instance of the Database
     * @return Instance
    */
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
		
        return self::$_instance;
    }
	
    // Get mysql pdo connection
    public function getConnection() {
        return $this->_connection;
    }
	
    /*
	 * Magic method clone is empty to prevent duplication of connection
	*/
    private function __clone() {
	}
	
	public function debug() {
		return debugDumpParams();
	}
}