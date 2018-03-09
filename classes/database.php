<?php
/**
* Database class to establish a database connection
*/
class Database {
	
	/**
	* Define database credentials
	*/
	
	private $host_name = "host_name";
	private $database_name = "database_name";
	private $user_name = "user_name";
	private $password = "password";
	
	/**
	* getConnection method invokes PDO (PHP Data Object to establish the connection)
	* @access public
	* return database connection
	*/
	public function getConnection() {
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . $this->host_name . ";dbname=" . $this->database_name, $this->user_name, $this->password);
			$this->conn->exec("set names utf8");
		} catch (PDOExceptions $exception) {
			//errors
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}
	
}
?>