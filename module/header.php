<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>MSPOS Web Plateform</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link
	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/uniform/css/uniform.default.css"
	rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
	href="../../ressources/assets/global/plugins/select2/select2.css" />
<link rel="stylesheet" type="text/css"
	href="../../ressources/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../ressources/assets/global/css/components-rounded.css"
	id="style_components" rel="stylesheet" type="text/css">
<link href="../../ressources/assets/global/css/plugins.css"
	rel="stylesheet" type="text/css">
<link href="../../ressources/assets/admin/layout3/css/layout.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/admin/layout3/css/themes/default.css"
	rel="stylesheet" type="text/css" id="style_color">
<link href="../../ressources/assets/admin/layout3/css/custom.css"
	rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link
	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/global/plugins/uniform/css/uniform.default.css"
	rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link
	href="../../ressources/assets/global/plugins/jqvmap/jqvmap/jqvmap.css"
	rel="stylesheet" type="text/css">
<link href="../../ressources/assets/global/plugins/morris/morris.css"
	rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="../../ressources/assets/admin/pages/css/tasks.css"
	rel="stylesheet" type="text/css" />
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="../../ressources/assets/global/css/components-rounded.css"
	id="style_components" rel="stylesheet" type="text/css">
<link href="../../ressources/assets/global/css/plugins.css"
	rel="stylesheet" type="text/css">
<link href="../../ressources/assets/admin/layout3/css/layout.css"
	rel="stylesheet" type="text/css">
<link
	href="../../ressources/assets/admin/layout3/css/themes/default.css"
	rel="stylesheet" type="text/css" id="style_color">
<link href="../../ressources/assets/admin/layout3/css/custom.css"
	rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
	<!-- BEGIN HEADER -->
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="#"><img style="height: 48%; width: 57%;"
						src="../../ressources/assets/admin/layout3/img/logo_mspos_b_w.png"
						alt="logo" class="logo-default"></a>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user dropdown-dark"><a
							href="javascript:;" class="dropdown-toggle"
							data-toggle="dropdown" data-hover="dropdown"
							data-close-others="true"> <img alt="" class="img-circle"
								src="../../ressources/assets/admin/layout3/img/User_Circle.png">
								<span class="username username-hide-mobile"><?php echo $_SESSION ['username'];?></span>
						</a>
							<ul class="dropdown-menu dropdown-menu-default" >
								<li><a href="users/profile.php" style="display: none;"> <i class="icon-user"></i> My
										Profile
								</a></li>
								<li><a href="../logout.php"> <i class="icon-key"></i> Log Out
								</a></li>
							</ul></li>
						<!-- END USER LOGIN DROPDOWN -->

					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
		<!-- END HEADER TOP -->
		<!-- BEGIN HEADER MENU -->
		<div class="page-header-menu">
			<div class="container">
				<!-- BEGIN HEADER SEARCH BOX -->
				<form class="search-form" action="#" method="GET">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search"
							name="query"> <span class="input-group-btn"> <a
							href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
						</span>
					</div>
				</form>
				<!-- END HEADER SEARCH BOX -->
				<!-- BEGIN MEGA MENU -->
				<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
				<div class="hor-menu ">
					<ul class="nav navbar-nav">
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full"><a
							href="product-list.php">Products</a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full"><a
							href="inventory-difference.php">Inventory Difference</a></li>
					</ul>
				</div>
				<!-- END MEGA MENU -->
			</div>
		</div>
		<!-- END HEADER MENU -->
	</div>
	<!-- END HEADER -->