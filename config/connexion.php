<?php
class DbConnexion {
	private $servername = "";
	private $username = "";
	private $password = "";
	private $dbname = "";

	
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