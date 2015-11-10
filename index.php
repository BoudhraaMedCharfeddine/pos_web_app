<?php
include 'security/check_session.php';
include 'config/connexion.php';

$cs = new CheckSession ();

if ($cs->check_user_session ()) {
	header ( "location:module/product/product-list.php" );
}

$dbc = new DbConnexion ();
$c = $dbc->connect ();
$errorMessage = "";
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title>MSPOS Web Plateform</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link
	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
	rel="stylesheet" type="text/css" />
<link
	href="ressources/assets/global/plugins/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="ressources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="ressources/assets/global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="ressources/assets/global/plugins/uniform/css/uniform.default.css"
	rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="ressources/assets/admin/pages/css/login.css"
	rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="ressources/assets/global/css/components-rounded.css"
	id="style_components" rel="stylesheet" type="text/css" />
<link href="ressources/assets/global/css/plugins.css" rel="stylesheet"
	type="text/css" />
<link href="ressources/assets/admin/layout/css/layout.css"
	rel="stylesheet" type="text/css" />
<link href="ressources/assets/admin/layout/css/themes/default.css"
	rel="stylesheet" type="text/css" id="style_color" />
<link href="ressources/assets/admin/layout/css/custom.css"
	rel="stylesheet" type="text/css" />
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="menu-toggler sidebar-toggler"></div>
	<!-- END SIDEBAR TOGGLER BUTTON -->
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="#"> <img
			src="ressources/assets/admin/layout3/img/Logo_mspos.png" alt="" />
		</a>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content" style="margin-top: 2%;">
		<!-- BEGIN LOGIN FORM -->
		<form  method="post">
			<h3 class="form-title">Login</h3>
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span> Enter any username and password. </span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<input class="form-control form-control-solid placeholder-no-fix"
					type="text" autocomplete="off" name="username" placeholder="Username" />
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control form-control-solid placeholder-no-fix"
					type="password" autocomplete="off" name="password" placeholder="Passeword" />
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-success uppercase" name="login">Connect</button>
			</div>
		</form>
	</div>
		
	<?php
	function check_password($passwordForm, $password) {
		$res = false;
		if ($password == null || substr ( $password, 5, strlen ( $password ) - 1 ) == strtoupper ( sha1 ( $passwordForm ) ) || substr ( $password, 5, strlen ( $password ) - 1 ) == strtoupper ( sha1 ( $passwordForm ) ) || substr ( $password, 5, strlen ( $password ) - 1 ) == sha1 ( $passwordForm )) {
			{
				$res = true;
			}
			return $res;
		}
	}
	
	if (isset ( $_POST ['login'] )) {
		$sql = "SELECT * FROM PEOPLE";
		$result = $c->query ( $sql );
		$loginForm = $_POST ['username'];
		$passwordForm = $_POST ['password'];
		while ( $row = $result->fetch_assoc () ) {
			$login = $row ["NAME"];
			$password = $row ["APPPASSWORD"];
			if ($loginForm == $login) {
				if ($password == null || substr ( $password, 5, strlen ( $password ) - 1 ) == strtoupper ( sha1 ( $passwordForm ) ) || substr ( $password, 5, strlen ( $password ) - 1 ) == strtoupper ( sha1 ( $passwordForm ) ) || substr ( $password, 5, strlen ( $password ) - 1 ) == sha1 ( $passwordForm )) {
					session_start ();
					$_SESSION ['username'] = $login;
					header ( "location:" . "module/product/product-list.php" );
					exit ();
				} else {
					$errorMessage = "Invalid Password!";
				}
			} else {
				$errorMessage = "Invalid Username!";
			}
		}
	}
	?>
<?php

	echo $errorMessage;
	?>
<div class="copyright">2015 (c) MSPOS. POS Web Plateform.<a style="    margin-left: 1%;"
			href="http://mspos.ch"
			target="_blank">MSPOS</a></div>
	<!-- END LOGIN -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
<script src="ressources/assets/global/plugins/respond.min.js"></script>
<script src="ressources/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
	<script src="ressources/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>
	<script src="ressources/assets/global/plugins/jquery-migrate.min.js"
		type="text/javascript"></script>
	<script
		src="ressources/assets/global/plugins/bootstrap/js/bootstrap.min.js"
		type="text/javascript"></script>
	<script src="ressources/assets/global/plugins/jquery.blockui.min.js"
		type="text/javascript"></script>
	<script
		src="ressources/assets/global/plugins/uniform/jquery.uniform.min.js"
		type="text/javascript"></script>
	<script src="ressources/assets/global/plugins/jquery.cokie.min.js"
		type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script
		src="ressources/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
		type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="ressources/assets/global/scripts/metronic.js"
		type="text/javascript"></script>
	<script src="ressources/assets/admin/layout/scripts/layout.js"
		type="text/javascript"></script>
	<script src="ressources/assets/admin/layout/scripts/demo.js"
		type="text/javascript"></script>
	<script src="ressources/assets/admin/pages/scripts/login.js"
		type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
});
</script>
	<!-- END JAVASCRIPTS -->

<?php $dbc->disconnect($c);?>
</body>
<!-- END BODY -->
</html>

