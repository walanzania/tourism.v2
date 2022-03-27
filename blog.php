<?php include 'includes/header.php'; ?>


<div class="breadcrumb-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="breadcrumb-wrap">
<h2>Blog</h2>
<ul class="breadcrumb-links">
<li>
<a href="index-2.html">Home</a>
<i class="bx bx-chevron-right"></i>
</li>
<li>Blog</li>
</ul>
</div>
</div>
</div>
</div>
</div>


<div class="blog-wrapper pt-90">
<div class="container">
<div class="row">
    <?php 
        // if (isset($_GET['slug'])) {
        //     $category_id = $connect2db->prepare("SELECT id FROM tbl_category WHERE slug = ?");
        //     $category_id->execute([$_GET['slug']]);
        //     $cat_id = $category_id->fetch()['id'];

        //     $query = "SELECT ts.*, u.firstname, u.lastname FROM tbl_tour_story AS ts JOIN tbl_users AS u ON ts.user_id = u.id ORDER BY id WHERE ts.category_unit = '$cat_id' "
        // }
        $getRecent = $connect2db->prepare("SELECT ts.*, u.firstname, u.lastname FROM tbl_tour_story AS ts JOIN tbl_users AS u ON ts.user_id = u.id ORDER BY id DESC");
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
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="blog-card">
                <div class="blog-img">
                    <img src="admin/story_files/<?php echo $img['media']?>" style="height: 400px;" class="img-fluid">
                    <div class="blog-date"><i class="flaticon-calendar"></i> 
                        <?php echo($info['created'])?>
                    </div>
                </div>
            <div class="blog-details">
                <div class="blog-info">
                <a class="blog-writer" href="#"><i class="flaticon-user"></i>
                    <?php echo $info['firstname']." ".$info['lastname'] ?>
                </a>
                <a class="blog-comment" href="#"><i class="flaticon-comment"></i><span>(3)</span>Comment</a>
                </div>
            <a href="blog-details?id=<?php echo $info['id']?>" class="blog-title"><?php echo $info['tour_title']?>.</a>
            <div class="blog-btn">
                <a href="blog-details?id=<?php echo $info['id']?>" class="btn-common-sm">Read More</a>
            </div>
            </div>
            </div>
        </div>

    <?php
        } 
      }
    ?>


</div>
<div class="row">
 <div class="col-lg-12">
<div class="pagination mt-50">
<a href="#"><i class="bx bx-chevron-left"></i></a>
<a href="#" class="active">1</a>
<a href="#">2</a>
<a href="#">3</a>
<a href="#">4</a>
<a href="#"><i class="bx bx-chevron-right"></i></a>
</div>
</div>
</div>
</div>
</div>



<div class="footer-area">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-12">
<div class="footer-info">
<div class="footer-logo">
<img src="assets/images/logo-2.png" alt="" class="img-fluid">
</div>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid maxime aut ut voluptate
dolorum nisi ducimus ratione</p>
<div class="footer-social-icons">
<h5>Follow Us:</h5>
<ul>
<li><a href="#"><i class='bx bxl-facebook'></i></a></li>
<li><a href="#"><i class='bx bxl-instagram'></i></a></li>
<li><a href="#"><i class='bx bxl-twitter'></i></a></li>
<li><a href="#"><i class='bx bxl-dribbble'></i></a></li>
</ul>
</div>
</div>
</div>
<div class="col-lg-8 col-md-12">
<div class="row">
<div class="col-lg-5 col-md-5 col-sm-7">
<div class="footer-links">
<h5 class="widget-title">Contact us</h5>
<div class="contact-box">
<span><i class="bx bx-phone"></i></span>
<div>
<a href="tel:+01852-1265122">+01852-1265122</a>
<a href="tel:+01852-1265122">+01852-1265122</a>
</div>
</div>
<div class="contact-box">
<span><i class="bx bx-mail-send"></i></span>
<div>
<a href="https://demo.egenslab.com/cdn-cgi/l/email-protection#731a1d151c33160b121e031f165d101c1e"><span class="__cf_email__" data-cfemail="8de4e3ebe2cde8f5ece0fde1e8a3eee2e0">[email&#160;protected]</span></a>
<a href="https://demo.egenslab.com/cdn-cgi/l/email-protection#64171114140b161024011c05091408014a070b09"><span class="__cf_email__" data-cfemail="04777174746b767044617c65697468612a676b69">[email&#160;protected]</span></a>
 </div>
</div>
<div class="contact-box">
<span><i class="bx bx-location-plus"></i></span>
<div>
<a href="#">2752 Willison Street <br>
Eagan, United State</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-5">
<div class="footer-links">
<h5 class="widget-title">support</h5>
<div class="category-list">
<ul>
<li><a href="contact.html">Contact us</a></li>
<li><a href="about.html">About us</a></li>
<li><a href="#">Services</a></li>
<li><a href="blog.html">our Blogs</a></li>
<li><a href="#">terms and conditions</a></li>
</ul>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4">
<div class="footer-links payment-links">
<h5 class="widget-title">We Accepts:</h5>
<div class="payment-cards">
<img src="assets/images/payment/payment-card-2.png" alt="" class="img-fluid">
<img src="assets/images/payment/payment-card-1.png" alt="" class="img-fluid">
<img src="assets/images/payment/payment-card-3.png" alt="" class="img-fluid">
<img src="assets/images/payment/payment-card-4.png" alt="" class="img-fluid">
<img src="assets/images/payment/payment-card-5.png" alt="" class="img-fluid">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="copyrigth-area">
<p>Copyright 2021 <a href="#">TourX</a> | Design By <a href="#">Egens Lab</a></p>
</div>
</div>
</div>
</div>
</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/typed.js"></script>

<script src="assets/js/main.js"></script>
</body>

<!-- Mirrored from demo.egenslab.com/html/tourx/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 19 Mar 2022 02:39:58 GMT -->
</html>