<?php include 'includes/header.php'; ?>


<div class="main-banner-2">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="main-banner-content-2">
<h2>Amazing Tour In <br>
<span class="element">Hampshire</span> </h2>
<h3>7 Days, 8 Night Tour</h3>
</div>
</div>
</div>
<!-- <div class="find-form-2">
<form class="findfrom-wrapper">
<div class="row">
<div class="col-lg-4">
<input type="text" placeholder="Where To...">
</div>

<div class="col-lg-4">
<div class="custom-select">
<select>
    <option selected disabled>Travel Category</option>
    <option value="1">City Tours</option>
    <option value="2">Vacation Tours</option>
    <option value="3">Couple Tours </option>
    <option value="4">Adventure Tours</option>
    <option value="5">Group Tours</option>
</select>
</div>
</div>
<div class="col-lg-4">
<div class="find-btn">
<a href="#" class="btn-second"><i class='bx bx-search-alt'></i> Find now</a>
</div>
</div>
</div>
</form>
</div> -->
</div>
</div>


<div class="offer-area pt-120">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="section-head pb-30">
<h5>Special offer</h5>
<h2>Our Most Recent Adventures</h2>
</div>
</div>
</div>
<div class="offer-slider dark-nav owl-carousel">
    <?php 
        $getRecent = $connect2db->prepare("SELECT * FROM tbl_tour_story ORDER BY id DESC LIMIT 0,3");
        $getRecent->execute();
        if ($getRecent->rowcount() < 1) {?>
            <h1>Storys Not Available</h1>
    <?php  
      }else{ 
        while ($info = $getRecent->fetch()) {
          $getImage = $connect2db->prepare("SELECT media FROM tbl_media_file WHERE story_id = ?");
          $getImage->execute([$info['id']]);
          $img = $getImage->fetch();
        ?>

        <div class="offer-card">
            <div class="offer-thumb">
                <img src="admin/story_files/<?php echo $img['media']?>" alt="" style="height: 500px;" class="img-fluid">
            </div>
            <div class="offer-details">
                <div class="offer-info">
                     <?php// echo substr($info['tour_description'], 0,150). '...'; ?>
                </div>
                <h3><i class="flaticon-arrival"></i>
                <a href="blog-details?id=<?php echo $info['id']?>"><?php echo $info['tour_title']?></a>
                </h3>
                
            </div>
        </div>

    <?php
        } 
      }
    ?>

    

</div>
</div>
</div>




<!-- 

<div class="destinations-area pt-120">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="section-head pb-30">
<h5>Popular Destinations</h5>
<h2>Select Our Best Popular Destinations</h2>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-3 col-md-3">
<div class="package-slider-wrap">
<img src="assets/images/destination/d-1.png" alt="" class="img-fluid">
<div class="pakage-overlay">
<strong>Spain</strong>
</div>
</div>
</div>
<div class="col-lg-9 col-md-9">
 <div class="row owl-carousel destinations-1">
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-4.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$145</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Paris Hill Tour</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-5.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$240</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Lake Garda, Spain</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-6.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$300</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Mount Dtna, Spain</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-7.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$120</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Amalfi Costa, Italy</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-9 col-md-9">
        <div class="row owl-carousel destinations-2">
        <div class="package-card">
        <div class="package-thumb">
        <img src="assets/images/destination/d-7.png" alt="" class="img-fluid">
        </div>
        <div class="package-details">
        <div class="package-info">
        <h5><span>$145</span>/Per Person</h5>
        </div>
        <h3><i class="flaticon-arrival"></i>
        <a href="package-details.html">Amalfi Costa, Italy</a>
        </h3>
        <div class="package-rating">
        <strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
        </div>
        </div>
        </div>
        <div class="package-card">
        <div class="package-thumb">
        <img src="assets/images/destination/d-8.png" alt="" class="img-fluid">
        </div>
        <div class="package-details">
        <div class="package-info">
        <h5><span>$240</span>/Per Person</h5>
        </div>
        <h3><i class="flaticon-arrival"></i>
        <a href="package-details.html">Fench Rivira, Italy</a>
        </h3>
        <div class="package-rating">
        <strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
        </div>
        </div>
        </div>
        <div class="package-card">
        <div class="package-thumb">
        <img src="assets/images/destination/d-9.png" alt="" class="img-fluid">
        </div>
        <div class="package-details">
        <div class="package-info">
        <h5><span>$300</span>/Per Person</h5>
        </div>
        <h3><i class="flaticon-arrival"></i>
        <a href="package-details.html">Amalfi Costa, Italy</a>
        </h3>
        <div class="package-rating">
        <strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
        </div>
        </div>
        </div>
        <div class="package-card">
        <div class="package-thumb">
        <img src="assets/images/destination/d-10.png" alt="" class="img-fluid">
        </div>
        <div class="package-details">
        <div class="package-info">
        <h5><span>$120</span>/Per Person</h5>
        </div>
        <h3><i class="flaticon-arrival"></i>
        <a href="package-details.html">Mount Dtna, Italyr</a>
        </h3>
        <div class="package-rating">
        <strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
        </div>
        </div>
        </div>
        </div>
    </div>

<div class="col-lg-3 col-md-3">
<div class="package-slider-wrap">
<img src="assets/images/destination/d-2.png" alt="" class="img-fluid">
<div class="pakage-overlay">
<strong>Italy</strong>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-3 col-md-3">
<div class="package-slider-wrap">
<img src="assets/images/destination/d-3.png" alt="" class="img-fluid">
<div class="pakage-overlay">
<strong>Dubai</strong>
</div>
</div>
</div>
<div class="col-lg-9 col-md-9">
<div class="row owl-carousel destinations-1">
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-11.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$145</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Amalfi Costa, Italy</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-5.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$240</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Maritime Heritage</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-9.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$300</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Souks of Deira</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
<div class="package-card">
<div class="package-thumb">
<img src="assets/images/destination/d-4.png" alt="" class="img-fluid">
</div>
<div class="package-details">
<div class="package-info">
<h5><span>$120</span>/Per Person</h5>
</div>
<h3><i class="flaticon-arrival"></i>
<a href="package-details.html">Jumeirah Mosque</a>
</h3>
<div class="package-rating">
<strong><i class='bx bxs-star'></i><span>8K+</span> Rating</strong>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> -->


<div class="review-area mt-120">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="section-head pb-40">
<h5>Our Traveller Say</h5>
<h2>What Oue Traveller Say About Us</h2>
</div>
</div>
</div>
    <div class="review-slider owl-carousel">
        <?php 
            $getFeedback = $connect2db->prepare("SELECT * FROM feedbacks WHERE status = ?");
            $getFeedback->execute([0]);
            if ($getFeedback->rowcount()< 1) {?>
                <h1>Feedback Not Available</h1>
        <?php  
          }else{
            while ($fb = $getFeedback->fetch()) { ?>
                <div class="review-card ">
            <div class="reviewer-img">
                <img src="assets/images/reviewer/reviewer-1.png" alt="" class="img-fluid">
            </div>
            <div class="reviewer-info">
                <h3><?php echo $fb['name']?></h3>
                <h5>Traveller</h5>
                <p><?php echo $fb['text']?></p>
            </div>
        </div>
        <?php  
             }
          }
        ?>
    </div>
</div>
</div>







<?php include 'includes/footer.php';?>