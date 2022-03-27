<?php include 'includes/adm-header.php';?>


<div class="page-wrapper">
	<div class="page-content">
		<div class="card">
		  <div class="card-body p-4">
			  <h5 class="card-title"> Story Administrators</h5>
			  <hr/>
               <div class="form-body mt-4">
			    <div class="row">
				   <div class="col-lg-12">
                   <div class="table-responsive">
					<table class="table mb-0">
						<thead class="table-light">
							<tr>
								<th>#</th>
								<th>Fullname</th>
								<th>Username</th>
								<th>Phone Number</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$category = $connect2db->prepare("SELECT * FROM tbl_users WHERE role = ? ORDER BY id DESC");
								$category->execute([1]);
								
								$i = 1;
								while ($cat = $category->fetch()) {
								?>

							<tr>
								<td><?php echo $i; ?></td>
								<td>
									<div class="d-flex align-items-center">
										<div class="ms-2 text-uppercase">
											<h6 class="mb-0 font-14">
												<?php echo $cat['firstname']." ".$cat['firstname']?>
											</h6>
										</div>
									</div>
								</td>
								<td>
									<div class="">
										<?php echo $cat['username']?>
									</div>
								</td>
								<td>
									<div class="">
										<?php echo $cat['phone']?>
									</div>
								</td>
								<td>
									<div class="">
										<?php 
											$status = ($cat['status']==1) ? ['Active', 'bg-success'] : ['Inactive', 'bg-danger'] ;
										?>
										<span class="badge <?php echo $status[1]?>"><?php echo $status[0]?></span>
									</div>
								</td>
								<td width="15%">
									<div class="d-flex order-actions text-center">
										<a href="edit?id=<?php echo $cat['id']?>" class=""><i class='bx bxs-edit text-success'></i></a>

										<?php 
											$icon = ($cat['status']==1) ? 'user-x' : 'user-check' ;
										?>

										

										<a href="?disable=<?php echo $cat['id']?>" class="bg-warning ms-3"><i class='bx bxs-<?php echo $icon?> text-white'></i></a>

										<a href="?delete=<?php echo $cat['id']?>" class="bg-danger ms-3" onclick="return confirm('Are you sure to delete?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class='bx bxs-trash text-white'></i></a>
									</div>
								</td>
							</tr>

							<?php 
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
				   </div>
				   
			   </div><!--end row-->
			</div>
		  </div>
	  </div>
	</div>
</div>
<?php include 'includes/footer.php';?>
<?php  
	if (isset($_GET['delete'])) {
		$user_id = $_GET['delete'];
		$deleteUser = $connect2db->prepare("DELETE FROM tbl_users WHERE id = ?");
		$deleteUser->execute([$user_id]);
		if ($deleteUser) {
			echo "<script>error_noti('DELETED');window.location='manage_narrator'</script>";
		} else{
			echo "<script>error_noti('Error Deleting User ');window.location='manage_narrator'</script>";
		}
	}

	if (isset($_GET['disable'])) {
		$user_id = $_GET['disable'];
		$getStatus = $connect2db->prepare("SELECT status FROM tbl_users WHERE id = ?");
		$getStatus->execute([$user_id]);
		$status = $getStatus->fetch()['status'];
		$newStatus = ($status==1) ? 0 : 1 ;
		$updateUser = $connect2db->prepare("UPDATE tbl_users SET status = ? WHERE id = ?");
		$updateUser->execute([$newStatus, $user_id]);
		if ($updateUser) {
			echo "<script>success_noti('UPDATED ...');window.location='manage_narrator';</script>";
		} else{
			echo "<script>error_noti('Error Updating User');window.location='manage_narrator'</script>";
		}
	}
?>