<?php 
	include '../includes/header.php';
	if (isset($_GET['categ_unit']) && $_GET['categ_unit'] != "" ) {
		$slug = $_GET['categ_unit'];
		$getID = $connect2db->prepare("SELECT s.*, co.name AS country, st.name AS state, ct.name AS city, u.firstname, u.lastname FROM tbl_tour_story AS s JOIN tbl_users AS u ON s.user_id = u.id JOIN countries AS co ON s.country_id = co.id JOIN states AS st ON s.state_id = st.id JOIN cities AS ct ON s.cities_id = ct.id WHERE s.category_unit = ?");
		$getID->execute([$slug]);
		if ($getID->rowcount() > 0) {
			$story_details = $getID->fetch();
			$story_id = $story_details['id'];
			$title = $story_details['tour_title'];
			$date = $story_details['created'];
			$category = $story_details['category_unit'];
			$desc = $story_details['tour_description'];
			$author = $story_details['firstname']." ".$story_details['lastname'];
			$country = $story_details['country'];
			$state = $story_details['state'];
			$city = $story_details['city'];
			$status = ($story_details['status']==1) ? ['Published', 'Unpublish'] : ['Unpublised', 'Publish'] ;
			// echo $category;
		} else {
			echo "<script>window.location='404'</script>";
		}
		
	} 


?>

<div class="page-wrapper">
	<div class="page-content">
		<div class="card">
			<div class="row g-0">
			  <div class="col-md-6">
				<div class="card">
			<div class="card-body">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php 
							$getImages = $connect2db->prepare("SELECT media FROM tbl_media_file WHERE story_id = ? and media_type != ?");
							$getImages->execute([$story_id, 'video']);
							$i = 1;
							while ($file = $getImages->fetch()) {?>
								<div class="carousel-item <?php echo ($i==1) ? 'active' : '' ;?> ">
									<img height="500px" width="500px" src="../story_files/<?php echo $file['media']?>" class="d-block w-100" alt="...">
								</div>
						
						<?php	
							$i = $i + 1;
							}
						?>
						
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</a>
				</div>
				<hr>

				<div class="d-flex align-items-center gap-2">
					<a href="?publish=<?php echo $story_id?>" class="btn btn-inverse-primary"><i class='bx bx-star'></i><?php echo $status[1];?></a>
					<a href="?delete=<?php echo $story_id?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class='bx bxs-trash' ></i>Delete</a>
				</div>

			</div>
		</div>
			  </div>
			  <div class="col-md-6">
				<div class="card-body">
				  <h4 class="card-title"><?php echo $title;?></h4>
				  <div class="d-flex gap-1 py-1">
					  <div>Status: </div>
					  <div class="text-success"><span class="badge bg-gradient-blooker">
					  	<?php echo $status[0];?>
					  </span></div>
				  </div>

				  <div class="d-flex gap-1 py-1">
					  <div>Added On: </div>
					  <div class="text-success"> <?php echo date('F g, Y', strtotime($date));?></div>
				  </div>

				  <div class="d-flex gap-1 py-1">
					  <div>Added By: </div>
					  <div class="text-danger"> <?php echo $author;?></div>
				  </div>
				  <div class="d-flex gap-1 py-1">
					  <div>Location: </div>
					  <div class="text-primary"> <?php echo $country;?> <i class="bx bxs-arrow-to-right text-danger"></i>
					    <?php echo $state;?> <i class="bx bxs-arrow-to-right text-danger"></i>
					     <?php echo $city;?></div>
				  </div>
				  <!-- <div class="mb-3"> 
					<span class="price h4">$149.00</span> 
					<span class="text-muted">/per kg</span> 
				</div> -->
				  <p class="card-text fs-6">
				  	<?php echo $desc;?>
				  </p>
				  <strong>Available Features</strong>
				  <hr>
				  <dl class="row"> 
				  	<?php 
				  		$getFeatures = $connect2db->prepare("SELECT features FROM tbl_story_features WHERE story_id = ?");
				  		$getFeatures->execute([$story_id]);
				  		while ($fea = $getFeatures->fetch()) {?>
				  			<dt class="text-uppercase col-sm-9 pb-2"> <i class='bx bxs-certification text-success'></i> <?php echo $fea['features']?></dt>
				  	<?php	
				  		}
				  	?>
					
				  </dl>
				  <hr>
				  
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
	


<?php include '../includes/footer2.php';

	if (isset($_GET['publish'])) {
		$story_id = $_GET['publish'];
		$getStatus = $connect2db->prepare("SELECT status, category_unit FROM tbl_tour_story WHERE id = ?");
		$getStatus->execute([$story_id]);
		$sta = $getStatus->fetch();
		$status = $sta['status'];
		$slug = $sta['category_unit'];
		
		$action = ($status == 1) ? 0 : 1 ;

		$updStatus = $connect2db->prepare("UPDATE tbl_tour_story SET status = ? WHERE id = ?");
		$updStatus->execute([$action, $story_id]);
		if ($updStatus) {
			echo "<script>success_noti('Updated Successfully ...');window.location='tour_story_details?categ_unit=$slug'</script>";
		}else{
			echo "<script>error_noti('Error Updating !!!')</script>";
		}

	}

?>

