<?php include 'includes/adm-header.php';?>
<!--start page wrapper -->
<!-- <div class="page-wrapper">
<div class="page-content"> -->
<div class="page-wrapper">
<div class="page-content">

	<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col-4">
		 <div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Total Post</p>
						<h4 class="my-1 text-info">15000</h4>
						<p class="mb-0 font-13">posts and updates</p>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-folder'></i>
					</div>
				</div>
			</div>
		 </div>
	   </div>
	   <div class="col-4">
		<div class="card radius-10 border-start border-0 border-3 border-danger">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total User</p>
					   <h4 class="my-1 text-danger">$84,245</h4>
					   <p class="mb-0 font-13">total user till date</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-user'></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	  <div class="col-4">
		<div class="card radius-10 border-start border-0 border-3 border-warning">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total Storyteller</p>
					   <h4 class="my-1 text-warning">8.4K</h4>
					   <p class="mb-0 font-13">team of storyteller</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 
	</div><!--end row-->

	<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	 	<div class="col-6">
	 		<div class="card mr-3">
             <div class="card-body">
				<div class="card-header">
					<h6 class="card-title">Narrator</h6>			
				</div>
				 <div class="table-responsive">
				   <table class="table align-middle mb-0">
					<thead class="table-light">
					 <tr>
					   <th>SN</th>
					   <th>Full Name</th>
					   <th>Username</th>
					   <th>Email</th>
					   <th>Telephone</th>
					   <th>Status</th>
					   <th>Date</th>
					 </tr>
					 </thead>
					 <tbody>
					 	<?php
							$category = $connect2db->prepare("SELECT * FROM tbl_users WHERE role = ? ORDER BY id DESC");
							$category->execute([2]);
							
							$i = 0;
							while ($cat = $category->fetch()) {
								$i++
							?>
					 	<tr>
					  <td><?php echo $i; ?></td>
					  <td><?php echo $cat['firstname']." ".$cat['firstname']?></td>
					  <td><?php echo $cat['username']?></td>
					  <td><?php echo $cat['email']?></td>
					  <td><?php echo $cat['phone']?></td>
					  <td>
					  	<div class="">
								<?php 
									$status = ($cat['status']==1) ? ['Active', 'bg-success'] : ['Inactive', 'bg-danger'] ;
								?>
								<span class="badge <?php echo $status[1]?>"><?php echo $status[0]?></span>
							</div>
						</td>
					  <td><?php echo date('F g, Y', strtotime($cat['created'])); ?></td>
					 </tr>
					 	<?php } ?>
				    </tbody>
				  </table>
				</div>
			 </div>
		   </div>
		</div>
		<div class="col-6">
			<div class="card ml-3">
              <div class="card-body">
				<div class="card-header">
					<h6 class="card-title">Users</h6>			
				</div>
				 <div class="table-responsive">
				   <table class="table align-middle mb-0">
					<thead class="table-light">
					 <tr>
					   <th>SN</th>
					   <th>Full Name</th>
					   <th>Username</th>
					   <th>Email</th>
					   <th>Telephone</th>
					   <th>Status</th>
					   <th>Date</th>
					 </tr>
					 </thead>
					 <tbody>
					 	<?php
							$category = $connect2db->prepare("SELECT * FROM tbl_users WHERE role = ? ORDER BY id DESC");
							$category->execute([1]);
							
							$i = 0;
							while ($cat = $category->fetch()) {
								$i++
							?>
					 	<tr>
					  <td><?php echo $i; ?></td>
					  <td><?php echo $cat['firstname']." ".$cat['firstname']?></td>
					  <td><?php echo $cat['username']?></td>
					  <td><?php echo $cat['email']?></td>
					  <td><?php echo $cat['phone']?></td>
					  <td>
					  	<div class="">
								<?php 
									$status = ($cat['status']==1) ? ['Active', 'bg-success'] : ['Inactive', 'bg-danger'] ;
								?>
								<span class="badge <?php echo $status[1]?>"><?php echo $status[0]?></span>
							</div>
						</td>
					  <td><?php echo date('F g, Y', strtotime($cat['created'])); ?></td>
					 </tr>
					<?php } ?>

				    </tbody>
				  </table>
				</div>
			 </div>
			</div>
		</div>

	</div>
</div>
</div>

<!-- </div>
</div> -->
<!--end page wrapper -->
<?php include 'includes/adm-footer.php';?>	