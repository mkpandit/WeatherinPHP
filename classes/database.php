<?php
/**
* Database class to establish a database connection
*/
class Database {
	
	/**
	* Define database credentials
	*/
	
	private $host_name = "localhost";
	private $database_name = "htbase_portal";
	private $user_name = "root";
	private $password = "";
	
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