<?php 
	session_start();
	include 'connection.php';
	if (!isset($_SESSION['id']) OR empty($_SESSION['id'])) {
		echo "<script>window.location='../index'</script>";
	} else {
		$id = $_SESSION['id'];
		echo $id;
		$user = $connect2db->prepare("SELECT * FROM tbl_users WHERE id=?");
		$user->execute([$id]);

		$user_info = $user->fetch();
		$user_fullname = $user_info['firstname'] .' '. $user_info['lastname'];
		$role = $user_info['role'];
		$user_info['role'] ==1 ? $user_role = 'Administrator' : $user_role = 'Storyteller';
	}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->

	<link href="../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css" />
	<script type="text/javascript" src="../assets/plugins/ckeditor/ckeditor.js"></script>
	<link href="../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="../assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	
	<title>Tourism Management System</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../assets/images/flamygo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Flamygo</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="menu-label">MAIN</li>
				<li>
					<a href="dashboard" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="menu-label">STORIES</li>
				<li>
					<a class="" href="create_story">
						<div class="parent-icon"><i class='bx bx-message-square-edit'></i>
						</div>
						<div class="menu-title">Create Story</div>
					</a>
				</li>
				<li>
					<a class="" href="all_story">
						<div class="parent-icon"><i class="bx bx-grid-alt"></i>
						</div>
						<div class="menu-title">All Story</div>
					</a>
				</li>
				<li>
					<a href="active_story">
						<div class="parent-icon"> <i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">Active Story</div>
					</a>
				</li>
				<li>
					<a href="inactive_story">
						<div class="parent-icon"><i class="bx bx-error"></i>
						</div>
						<div class="menu-title">In-Active Story</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../assets/images/icons/usr2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $user_fullname; ?></p>
								<p class="designattion mb-0"><?php echo $user_role; ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="../logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>

		<!--end header -->