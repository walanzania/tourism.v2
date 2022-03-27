<?php include 'includes/header.php';?>


<div class="breadcrumb-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="breadcrumb-wrap">
<h2>Gallary</h2>
<ul class="breadcrumb-links">
<li>
<a href="index-2.html">Home</a>
<i class="bx bx-chevron-right"></i>
</li>
<li>Gallary</li>
</ul>
</div>
</div>
</div>
</div>
</div>



<div class="gallary-wrapper pt-120">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="gallary-colom-one">
<div class="gallary-grid">
    <?php 
        $i = 1;
        $getImage = $connect2db->prepare("SELECT media FROM tbl_media_file");
          $getImage->execute();
          while ($img = $getImage->fetch()) {
            if (($i % 2) == 0) {
                $class = 'g-img-sm-2';
            }elseif (($i % 3) == 0) {
                $class = 'g-img-md';
            }else{
                $class = 'g-img-sm-1';
            }
            ?>
              <a class="<?php echo $class; ?> main-gallary" href="admin/story_files/<?php echo $img['media']?>">
                <img src="admin/story_files/<?php echo $img['media']?>" alt="">
            </a>
    <?php 
        $i = $i + 1;
         }
    ?>

</div>
</div>
</div>



</div>
</div>
</div>

<?php include 'includes/footer.php';?>