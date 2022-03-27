<?php include '../includes/header.php';?>
<!--start page wrapper -->
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
		<div class="card radius-10 border-start border-0 border-3 border-success">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Country Visited</p>
					   <h4 class="my-1 text-success">34.6%</h4>
					   <p class="mb-0 font-13">visited so far</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
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

	
	 <div class="card radius-10">
             <div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Recent Tour Story</h6>
					</div>
				</div>
			 <div class="table-responsive">
			   <table class="table align-middle mb-0">
				<thead class="table-light">
				 <tr>
				   <th>SN</th>
				   <th>Title</th>
				   <th>Description</th>
				   <th>Country</th>
				   <th>State</th>
				   <th>City</th>
				   <th>Date</th>
				 </tr>
				 </thead>
				 <tbody>
				 	<?php 

		$getStories = $connect2db->prepare("SELECT s.*, co.name AS country, st.name AS state, ct.name AS city, u.firstname, u.lastname FROM tbl_tour_story AS s JOIN tbl_users AS u ON s.user_id = u.id JOIN countries AS co ON s.country_id = co.id JOIN states AS st ON s.state_id = st.id JOIN cities AS ct ON s.cities_id = ct.id WHERE s.user_id = ? order by s.id DESC LIMIT 10");
		$getStories->execute([$id]);
		if ($getStories->rowcount() > 0) {
			$i = 1;
			
			while ($story = $getStories->fetch()) {
				$color = ['primary', 'danger', 'success', 'warning'];
				$i = rand(0, 3);
					$status = ($story['status']==1) ? ['Published', 'bg-success'] : ['Unpublised', 'bg-danger'] ;

					$getImage = $connect2db->prepare("SELECT media FROM tbl_media_file WHERE story_id = ?");
					$getImage->execute([$story['id']]);
					$img = $getImage->fetch()['media'];

					$username = $connect2db->prepare("SELECT username FROM tbl_users WHERE id = ?");
					$username->execute([$id]);
					$user = $username->fetch()['username'];
				?>
				 	<tr>
					  <td>1</td>
					  <td> <?php echo $story['tour_title'] ?> </td>
					  <td><?php echo substr($story['tour_description'], 0,200) .'...';?></td>
					  <td><?php echo $story['country'] ?></td>
					  <td><?php echo $story['state_id'] ?></td>
					  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100"><?php echo $story['city'] ?></span></td>
					  <td><?php echo date('F g, Y', strtotime($story['created'])); ?></td>
				 	</tr>
				 <?php }} ?>
			    </tbody>
			  </table>
			  </div>
			 </div>
		</div>


</div>
</div>
<!--end page wrapper -->
<?php include '../includes/footer2.php';?>	