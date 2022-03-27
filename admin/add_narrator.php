<?php include 'includes/adm-header.php';?>


<div class="page-wrapper">
<div class="page-content">
<div class="row">
	<div class="col-xl-9 mx-auto">
		<div class="card border-top border-0 border-4 border-primary">
			<div class="card-body p-5">
				<div class="card-title d-flex align-items-center">
					<div><!-- <i class="bx bxs-user me-1 font-22 text-primary"></i> -->
					</div>
					<h5 class="mb-0 text-primary uppercase">Add Narrator</h5>
				</div>
				<hr>
				<form class="row g-3" method="post">
					<div class="col-md-12">
						<label for="inputFirstName" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname">
					</div>
					<div class="col-md-12">
						<label for="inputLastName" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname">
					</div>
					<div class="col-md-12">
						<label for="inputEmail" class="form-label">Username</label>
						<input type="text" class="form-control" name="uname">
					</div>
					<div class="col-md-12">
						<label for="inputPassword" class="form-label">Phone Number</label>
						<input type="text" class="form-control" name="pnum">
					</div>
					
					<div class="col-12">
						<button type="submit" name="register" class="btn btn-primary px-5">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div></div>

<?php include 'includes/footer.php';?>
<?php 
	
	if (isset($_POST['register'])) {
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$uname = trim($_POST['uname']);
		$pnum = trim($_POST['pnum']);
		$password = password_hash('password', PASSWORD_DEFAULT);
		$role = 2;

		if (empty($fname) || empty($lname) || empty($uname) || empty($pnum)) {
			echo "<script>error_noti('All Fields Required ...')</script>";
			
		} else {
			$validateUser = $connect2db->prepare("SELECT username, phone FROM tbl_users WHERE username = ? OR phone = ?");
			$validateUser->execute([$uname, $pnum]);
			if ($validateUser->rowcount() > 0) {
				echo "<script>error_noti('Username or Phone Number Already Exist')</script>";
			} else {
				$createUser = $connect2db->prepare("INSERT INTO tbl_users (firstname, lastname, username, phone, password,role) VALUES (?, ?, ?, ?, ?, ?) ");
				if ($createUser->execute([$fname, $lname, $uname, $pnum, $password, $role])) {
					echo "<script>success_noti('Operation Successfully Completed ...');window.location='add_narrator';</script>";
				} else {
					echo "<script>error_noti('Error Occured ')</script>";
					
				}
				
			}
			
		}
	}
	

?>