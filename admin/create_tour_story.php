<?php include 'includes/adm-header.php';


// Function get country
	function country(){
		include 'includes/connection.php';
		$output = '';
		$getCat = $connect2db->prepare("SELECT * FROM countries");
		$getCat->execute();
		while ($cats = $getCat->fetch() ) {
			$output .= '<option value="'.$cats['id'].'">'.$cats['name'].'</option>';
		}

		return $output;
	}

		// Getting Data For Updating  ...

	if (isset($_GET['categ_unit']) && $_GET['categ_unit'] != "" ) {
			$slug = $_GET['categ_unit'];
			$getID = $connect2db->prepare("SELECT s.*, co.name AS country, st.name AS state, ct.name AS city, u.firstname, u.lastname FROM tbl_tour_story AS s JOIN tbl_users AS u ON s.user_id = u.id JOIN countries AS co ON s.country_id = co.id JOIN states AS st ON s.state_id = st.id JOIN cities AS ct ON s.cities_id = ct.id WHERE s.category_unit = ?");
			$getID->execute([$slug]);
			if ($getID->rowcount() > 0) {
				$features = '';
				$story_details = $getID->fetch();
				$story_id = $story_details['id'];
				$title = $story_details['tour_title'];
				$date = $story_details['created'];
				$category = $story_details['category_unit'];
				$category_id = $story_details['category_unit'];
				$desc = $story_details['tour_description'];
				$author = $story_details['firstname']." ".$story_details['lastname'];
				$country = $story_details['country']; 
				$country_id = $story_details['country_id'];
				$state = $story_details['state'];
				$state_id = $story_details['state_id'];
				$city = $story_details['city'];
				$city_id = $story_details['cities_id'];
				$status = ($story_details['status']==1) ? ['Published', 'Unpublish'] : ['Unpublised', 'Publish'] ;
				
				$getFeatures = $connect2db->prepare("SELECT features FROM tbl_story_features WHERE story_id = ?");
				$getFeatures->execute([$story_id]);
				while ($fea = $getFeatures->fetch()) {
					$features .= $fea['features'].",";
				}
				echo $features;
			} else {
				echo "<script>window.location='404'</script>";
			}
		
	} 

?>

<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-xl-9 mx-auto">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							 <div><!--<i class="bx bxs-user me-1 font-22 text-primary"></i> -->
							</div>
							<h5 class="mb-0 text-primary uppercase">Create New Tour Story</h5>
						</div>
						<hr>
						<form class="row g-3" method="post"action="" enctype="multipart/form-data">
							<div class="col-md-12">
								<label for="title" class="form-label">Title</label>
								<input type="text" class="form-control" name="title" placeholder="enter title" value="<?php echo (isset($_GET['categ_unit'])) ? $title : ""?>" required>
							</div>

							<input type="hidden" name="slug" value="<?php echo (isset($_GET['categ_unit'])) ? $slug : ""?>" class="form-control" id="slug" readonly>

							<div class="col-md-12">
								<div class="mb-3">
									<label for="description" class="form-label">Description</label>
									<textarea required class="form-control" name="description" id="description" rows="3"><?php echo (isset($_GET['categ_unit'])) ? $desc : ""?></textarea>
									<script>
					                    CKEDITOR.replace( 'description' );
					                </script>
								  </div>
							</div>

							<!-- Count State and City -->
								<div class="col-md-4 mb-3">
									<label for="inputProductTitle" class="form-label">Country</label>
									<select required name="country" onchange="getState(this.value)" class="form-control form-select">
										<option <?php echo (!isset($_GET['categ_unit'])) ? 'selected' : ""?> disabled value=""> -- Select Country -- </option>
										<?php
											if (isset($_GET['categ_unit'])){?>
													<option selected  value="<?php echo $country_id?>"><?php echo $country?></option>
										<?php	}
										?>
										<?php echo country();?>
									</select>
							  </div>

							  <div class="col-md-4 mb-3">
									<label for="inputProductTitle" class="form-label">State</label>
									<select required name="state" id="state" onchange="getCity(this.value)" class="form-control form-select">
										<option <?php echo (!isset($_GET['categ_unit'])) ? 'selected' : ""?> disabled > 
											-- Select State -- 
										</option>
										<?php
											if (isset($_GET['categ_unit'])){?>
													<option selected value="<?php echo $state_id?>"><?php echo $state?></option>
										<?php	}
										?>
									</select>
								  </div>

								  <div class="col-md-4 mb-3">
										<label for="inputProductTitle" class="form-label">City</label>
										<select required name="city" id="city" class="form-control form-select">
											<option <?php echo (!isset($_GET['categ_unit'])) ? 'selected' : ""?> disabled value=""> -- Select City -- </option>
											<?php
												if (isset($_GET['categ_unit'])){?>
														<option selected value="<?php echo $city_id?>"><?php echo $city?></option>
											<?php	}
											?>
											
										</select>
									  </div>

							<!-- Ends Here .. -->

							<div class="col-md-12">
								<label class="form-label">Features ( <small>to be separated by commas </small>)</label>
								<input type="text" required value="<?php echo (isset($_GET['categ_unit'])) ? $features : ""?>" name="features" data-role="tagsinput" class="form-control">
							</div>
							<?php 
					  	if (!isset($_GET['categ_unit'])) {?>
					  		<div class="mb-3">
									<label for="image-uploadify" class="form-label">Images</label>
									<input required id="image-uploadify" name="file[]" type="file" accept="image/*,video/*" multiple>
								  </div>
								 <?php 
								 		}
					  ?>
							
							
							<div class="col-12">
								<button type="submit" name="<?php echo (isset($_GET['categ_unit'])) ? 'update' : "submit"?>" class="btn btn-primary"><?php echo (isset($_GET['categ_unit'])) ? 'Update ' : 'Submit'?></button>
							</div>
						</form>

						<?php if (isset($_GET['categ_unit'])) {?>
			    	<div class="row">
			    		<?php 
			    	$getImages = $connect2db->prepare("SELECT * FROM tbl_media_file WHERE story_id = ?");
			    	$getImages->execute([$story_id]);
			    	while ($img = $getImages->fetch()) {?>
			    		<div class="col-md-3">
			    			<img width="90%" height="90%" src="story_files/<?php echo $img['media']?>">
			    			<form method="post" enctype="multipart/form-data">
			    				<input type="file" name="image">
			    				<input type="hidden" name="id" value="<?php echo $img['id']?>">
			    				<input type="submit" name="changeImage" value="Change" class="btn btn-inverse-primary">
			    			</form>
			    		</div>
			    <?php 
				    	}?>
				    </div>
				  <?php
				    }
			    ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'includes/footer.php';?>
<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->


<?php 
	if (isset($_POST['submit'])) {
		// $features = explode(',', $_POST['features']);
		$tmp_dir = $_FILES['file']['tmp_name'];
		$imgFile = $_FILES['file']['name'];
		$file_type = $_FILES['file']['type'];
		$cat_unit = substr($_POST['description'],0,20); //$_POST['description'];
		$title = $_POST['title'];
		$desc = $_POST['description'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$features = explode(',', $_POST['features']);
		$status = 1;
		if (!is_dir('story_files')) {
            mkdir('story_files');
        }
		$upload_dir = 'story_files/';

		$sql = $connect2db->prepare("SELECT id FROM tbl_tour_story WHERE tour_title=? and tour_description=?");
		$sql->execute([$title,$desc]);
		if($sql->rowcount() > 0){
			echo "<script>error_noti('Already Exist !!!')</script>";
		}else{
					$createStory = $connect2db->prepare("INSERT INTO tbl_tour_story (tour_title, tour_description, country_id,state_id, cities_id, status, category_unit, user_id)VALUES(?,?,?,?,?,?,?,?)");
				$createStory->execute([$title, $desc, $country, $state, $city, $status, $cat_unit, $id]);
				if ($createStory) {
					$story_id = $connect2db->lastInsertId();
					foreach ($features as $i => $feature) {
						$insertFeatures = $connect2db->prepare("INSERT INTO tbl_story_features (story_id, features)VALUES(?,?)");
						$insertFeatures->execute([$story_id, $feature]);
					}

					
					foreach ($tmp_dir as $i => $file) {
						$file_ext = strtolower(pathinfo($imgFile[$i], PATHINFO_EXTENSION));
						// echo "<script>alert('$file);</script>";
						$newName = rand(00000000, 99999999);
						$newFile = $newName.'.'.$file_ext;
						$newFile_type = explode('/', $file_type[$i])[0];
						move_uploaded_file($file, $upload_dir.$newFile);
						$insertFile = $connect2db->prepare("INSERT INTO tbl_media_file (story_id,media,media_type) VALUES (?,?,?)");
						$insertFile->execute([$story_id, $newFile, $newFile_type]);
					}
					echo "<script>success_noti('Operation Succeeded ...')</script>";
				} else {
					echo "<script>error_noti('Error Occured !!!')</script>";
				}
		}
	
	}


	// Updating
		if (isset($_POST['update'])) {
		$title = $_POST['title'];
		$desc = $_POST['description'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$features = explode(',', $_POST['features']);
		$status = 1;
		$slug = $_POST['slug'];
		$updated = date('Y:M:D H:i:s');

		$updStory = $connect2db->prepare("UPDATE tbl_tour_story SET tour_title = ?, tour_description = ?, country_id = ?, state_id = ?, cities_id = ?, status = ?, updated_at = ? WHERE id = ? ");
		$updStory->execute([$title,$desc,$country,$state,$city,$status,$updated,$story_id]);
		if ($updStory) {
			$cleanDB = $connect2db->prepare("DELETE FROM tbl_story_features WHERE story_id = ?");
			$cleanDB->execute([$story_id]);
			if ($cleanDB) {
				foreach ($features as $i => $feature) {
					$insertFeatures = $connect2db->prepare("INSERT INTO tbl_story_features (story_id, features)VALUES(?,?)");
					$insertFeatures->execute([$story_id, $feature]);
				}
			}
			echo "<script>success_noti('Operation Succeeded ...')</script>";
		}else {
			echo "<script>error_noti('Error Occured !!!')</script>";
		}
	}

	if (isset($_POST['changeImage'])) {
		$tmp_dir = $_FILES['image']['tmp_name'];
		$imgFile = $_FILES['image']['name'];
		$file_type = $_FILES['image']['type'];
		$file_id = $_POST['id']; 

		$upload_dir = 'story_files/';
		$file_ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
		$newName = rand(00000000, 99999999);
		$newFile = $newName.'.'.$file_ext;
		// $newFile_type = explode('/', $file_type)[0];
		if (move_uploaded_file($tmp_dir, $upload_dir.$newFile)) {
			$updImg = $connect2db->prepare("UPDATE tbl_media_file SET media = ? WHERE id = ?");
			$updImg->execute([$newFile, $file_id]);
			if ($updImg) {
				echo "<script>success_noti('Operation Succeeded ...')</script>";
			}else{
				echo "<script>error_noti('Error Occured !!!')</script>";
			}
		}
	}

	?>

