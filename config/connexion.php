<?php
class DbConnexion {
/*	private $servername = "46.101.165.157";
	private $username = "root";
	private $password = "charf1990";
	private $dbname = "test_exec";
*/	
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "trattoufi";
	
	public function connect() {
		$conn = new mysqli ( $this->servername, $this->username, $this->password, $this->dbname );
		if ($conn->connect_error) {
			die ( "Connection failed" );
		}
		return $conn;
	}
	
	public function disconnect($conn) {
		mysqli_close($conn);
	}
}