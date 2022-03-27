<?php include 'includes/adm-header.php';?>

<div class="page-wrapper">
<div class="page-content">
<div class="row">
	<div class="col-xl-9 mx-auto">
		<div class="card border-top border-0 border-4 border-primary">
			<div class="card-body p-5">
				<div class="card-title d-flex align-items-center">
					 <div><!--<i class="bx bxs-user me-1 font-22 text-primary"></i> -->
					</div>
					<h5 class="mb-0 text-primary uppercase">Add User</h5>
				</div>
				<hr>
				<form class="row g-3" method="post">
					<div class="col-md-12">
						<label for="inputFirstName" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname" placeholder="enter first name">
					</div>
					<div class="col-md-12">
						<label for="inputLastName" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname" placeholder="enter last name">
					</div>
					<div class="col-md-12">
						<label for="inputEmail" class="form-label">Username</label>
						<input type="text" class="form-control" name="uname" placeholder="enter username">
					</div>
					<div class="col-md-12">
						<label for="inputEmail" class="form-label">Email Address</label>
						<input type="text" class="form-control" name="email" placeholder="enter email address">
					</div>
					<div class="col-md-12">
						<label for="inputPassword" class="form-label">Phone Number</label>
						<input type="text" class="form-control" name="pnum" placeholder="enter phone number">
					</div>
					
					<div class="col-12">
						<button type="submit" name="register" class="btn btn-primary px-5">Submit</button>
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
		$email = trim($_POST['email']);
		$password = password_hash('password', PASSWORD_DEFAULT);
		$role = 1;

		if (empty($fname) || empty($lname) || empty($uname) || empty($email) || empty($pnum)) {
			echo "<script>error_noti('All Fields Are Required ...');window.location='add_user'</script>";
		} else {
			$validateUser = $connect2db->prepare("SELECT username, phone FROM tbl_users WHERE username = ? OR phone = ?");
			$validateUser->execute([$uname, $pnum]);
			if ($validateUser->rowcount() > 0) {
				echo "<script>error_noti('User Information Already Exist');window.location='add_user'</script>";
				
			} else {
				$createUser = $connect2db->prepare("INSERT INTO tbl_users (firstname, lastname, username, phone,email, password,role) VALUES (?, ?, ?, ?, ?, ?, ?) ");
				if ($createUser->execute([$fname, $lname, $uname, $pnum, $email, $password, $role])) {
					echo "<script>success_noti('Account Successfully Created');window.location='add_narrator';</script>";
					
				} else {
					echo "<script>error_noti('Error Creating Account');window.location='add_user'</script>";
					
				}
				
			}
			
		}
	}
	

?>