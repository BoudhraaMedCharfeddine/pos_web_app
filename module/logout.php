<?php
include '../security/check_session.php';

$cs = new CheckSession();
$cs->log_out_user();

header("location:./../index.php");

/*session_start();
echo $_SESSION['username'];
*/