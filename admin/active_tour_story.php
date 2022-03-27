<?php include 'includes/adm-header.php';?>

<div class="page-wrapper">
<div class="page-content">
<h6 class="mb-0 text-uppercase">All Stories</h6>
<hr/>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
	<?php 
		$st =1;
		$getStories = $connect2db->prepare("SELECT * FROM tbl_tour_story WHERE status=?");
		$getStories->execute([$st]);
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
					$username->execute([$story['user_id']]);
					$user = $username->fetch()['username'];
				?>
				
				<div class="col">
					<div class="card border-<?php echo $color[$i];?> border-bottom border-3 border-0">
						<div class="card-body">
						<div class="card-title">
							<p class="card-title text-<?php echo $color[$i];?>">
										<strong><?php echo $story['tour_title'] ?></strong>
									</p>
						</div>
						<div class="row">
							<div class="col-md-6">
								<img width="100%" height="140px" src="story_files/<?php echo $img ?>" class="card-img-top" alt="...">
							</div>
							<div class="col-md-6">
									<p class="card-text">

										<span>Publised By: </span> <span class="badge bg-gradient-quepal"><?php echo $user?></span><br>

										<span>Publised On:</span> <span class="badge bg-gradient-quepal"><?php echo date('F g, Y', strtotime($story['created']))?></span> <br>

										<span>Status: <br></span> <span class="badge <?php echo $status[1]?>"><?php echo $status[0]?></span> <br>
									</p>
									<hr>
									<div class="d-flex align-items-center gap-2">
										<a href="create_tour_story?categ_unit=<?php echo $story['category_unit']?>" class="badge bg-success"><i class='bx bx-pen'></i></a>
										<a href="tour_story_details?categ_unit=<?php echo $story['category_unit']?>" class="badge bg-info"><i class='bx bx-analyse' ></i></a>
									</div>
								</div>
							</div>
						</div>
						</div>
					
				</div>
	<?php
				$i = $i + 1;
			}
		}else { ?>
			<div class="error-404 col-8 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="card py-5">
					<div class="row g-0">
						<div class="col col-xl-8">
							<div class="card-body p-4">
								<h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span class="text-success">4</span></h1>
								<h2 class="font-weight-bold display-4">Lost Record</h2>
								<p>You have reached the edge of the universe.
									<br>The page you requested could not be found.
									<br>Dont'worry and return to the previous page.</p>
								<div class="mt-5"> <a href="admin-dashboard" class="btn btn-primary btn-lg px-md-5 radius-30">Go Home</a>
									<a href="javascript:;" class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Back</a>
								</div>
							</div>
						</div>
						<div class="col-xl-7">
							<img src="../../../../cdn.searchenginejournal.com/wp-content/uploads/2019/03/shutterstock_1338315902.html" class="img-fluid" alt="">
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
	<?php 
		}
	?>
	
</div>
</div></div>
				<!--end row-->

<?php include 'includes/footer2.php';?>