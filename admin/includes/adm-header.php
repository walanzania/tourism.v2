<?php 
	session_start();
	include 'connection.php';
	if (!isset($_SESSION['id']) OR empty($_SESSION['id'])) {
		echo "<script>window.location='../index'</script>";
	} else {
		$id = $_SESSION['id'];
		// echo $id;
		$user = $connect2db->prepare("SELECT * FROM tbl_users WHERE id=?");
		$user->execute([$id]);

		$user_info = $user->fetch();
		$user_fullname = $user_info['firstname'] .' '. $user_info['lastname'];
		$role = $user_info['role'];
		$user_info['role'] ==1 ? $user_role = 'Administrator' : $user_role = 'Storyteller';

		$sm = $connect2db->prepare("SELECT count(id) as id FROM feedbacks WHERE status=?");$sm->execute([0]);
		$smg = $sm->fetch(); $smg['id'] <1 ? $msg = 0  : $msg = $smg['id'] ;




		// Time Function
		function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
}
	}
?><!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/flamygo-icon.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css" />
	<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
	<link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	
	<title>Tourism Management System</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/flamygo-icon.png" class="logo-icon" alt="logo icon">
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
					<a href="admin-dashboard" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<?php if($role == 1){?>
				<li class="menu-label">GENERAL</li>
				
				<li>
					<a href="#" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-user-circle'></i>
						</div>
						<div class="menu-title">System Admin</div>
					</a>
					<ul>
						<li> <a href="add_user"><i class="bx bx-right-arrow-alt"></i>Add User</a>
						</li>
						<li> <a href="manage_user"><i class="bx bx-right-arrow-alt"></i>Manage User</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Narrator</div>
					</a>
					<ul>
						<li> <a href="add_narrator"><i class="bx bx-right-arrow-alt"></i>Add Narrator</a>
						</li>
						<li> <a href="manage_narrator"><i class="bx bx-right-arrow-alt"></i>Manage Narrator</a>
						</li>
					</ul>
				</li>
			<?php } ?>
				<li class="menu-label">STORIES</li>
				<li>
					<a class="" href="create_tour_story">
						<div class="parent-icon"><i class='bx bx-message-square-edit'></i>
						</div>
						<div class="menu-title">Create Tour Story</div>
					</a>
				</li>
				<li>
					<a class="" href="all_tour_story">
						<div class="parent-icon"><i class="bx bx-grid-alt"></i>
						</div>
						<div class="menu-title">All Tour Story</div>
					</a>
				</li>
				<li>
					<a href="active_tour_story">
						<div class="parent-icon"> <i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">Active Story</div>
					</a>
				</li>
				<li>
					<a class="has-arrow" href="in_active_story">
						<div class="parent-icon"><i class="bx bx-error"></i>
						</div>
						<div class="menu-title">In-Active Story</div>
					</a>
				</li>
				<li class="menu-label">OTHERS</li>
				
				
				<li>
					<a href="feedbacks" target="_blank">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Feedbacks</div>
					</a>
				</li>			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center bg-success">
				<nav class="navbar navbar-expand">
					
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item dropdown dropdown-large">
								
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
												ago</span></h6>
													<p class="msg-info">5 new user registered</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
												ago</span></h6>
													<p class="msg-info">The pdf files generated</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">New customer comments recived</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 storyteller<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
									<?php if($msg!=0){?><span class="alert-count"><?php echo $msg;?></span><?php }?>
									<i class='bx bx-comment'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-message-list">
										<?php 
										$sm = $connect2db->prepare("SELECT * FROM feedbacks WHERE status=?");
										$sm->execute([0]);
										if($sm->rowcount()<1){
											echo 'No Messages';}else{
												while($sms = $sm->fetch()){?>

												
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/icons/usr2.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name"><?php echo $sms['name'];?> <span class="msg-time float-end">
														<!-- 6 hrs ago --> <?php echo date('F g, Y', strtotime($sms['created'])); ?></span></h6>
													<p class="msg-info">New message</p>
												</div>
											</div>
										</a>
										<?php }
											}?>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="assets/images/icons/usr2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $user_fullname; ?></p>
								<p class="designattion mb-0 text-white"><?php echo $user_role; ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>

		<!--end header -->