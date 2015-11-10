<?php
// include '../config/connexion.php';
class CheckSession {
	public function __construct() {
		session_start ();
	}
	public function check_user_session() {
		$result = false;
		if (isset ( $_SESSION ['username'] )) {
			$dbc = new DbConnexion ();
			$c = $dbc->connect ();
			$sql = "SELECT * FROM PEOPLE";
			$result = $c->query ( $sql );
			$login = "";
			while ( $row = $result->fetch_assoc () ) {
				$login = $row ["NAME"];
			}
			
			$username = $_SESSION ['username'];
			if ($login == $username) {
				$result = true;
			} else {
				$resultat = false;
			}
		} else {
			$result = false;
		}
		return $result;
	}
	public function check_administrator() {
		$result = false;
		$username = $_SESSION ['username'];
		if (isset ( $_SESSION ['username'] )) {
			$dbc = new DbConnexion ();
			$c = $dbc->connect ();
			$sql = "SELECT * FROM users where login='$username'";
			$result = $c->query ( $sql );
			$login = "";
			$usertype =0;
			while ( $row = $result->fetch_assoc () ) {
				$login = $row ["login"];
				$usertype = (int)$row ["user_type"];
			}
			if ($login == $username && $usertype == 1) {
				$result = true;
			} else {
				$result = false;
			}
		} else {
			$result = false;
		}
		return $result;
	}
	public function log_out_user() {
		session_start ();
		session_unset ();
		// print_r($_SESSION);
	}
}