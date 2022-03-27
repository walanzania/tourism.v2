<?php include 'includes/header.php';
    if (isset($_GET['id'])) {
        $story_id = $_GET['id'];
        $getDetails = $connect2db->prepare("SELECT ts.*, u.firstname, u.lastname FROM tbl_tour_story AS ts JOIN tbl_users AS u ON ts.user_id = u.id WHERE ts.id = ?");
        $getDetails->execute([$story_id]);
        $blog = $getDetails->fetch();

        $getImage = $connect2db->prepare("SELECT media FROM tbl_media_file WHERE story_id = ?");
        $getImage->execute([$story_id]);
        $img = $getImage->fetch();

        $comment = $connect2db->prepare("SELECT COUNT(comment) AS comment FROM comment WHERE story_id = ?");
        $comment->execute([$story_id]);
        $com_num = $comment->fetch()['comment'];
    }

    if (isset($_POST['comment'])) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $message = trim($_POST['message']);
        $date = date('Y-m-d H:i:s');
        $id = $_POST['id'];
        if (empty($name) || empty($phone) || empty($message)) {
            echo "<script>alert('All Fields Are Required')</script>";
        }else{
            $insert = $connect2db->prepare("INSERT INTO comment (name, mobile, story_id, comment, created_at)VALUES(?,?,?,?,?)");
            $insert->execute([$name, $phone, $id, $message, $date]);
            if ($insert) {
                echo "<script>alert('Submitted');window.location='blog-details?id=$id'</script>";
            } else {
                echo "<script>alert('Error Submitting Comment');window.location='blog-details?id=$id'</script>";
            }
            
        }
    }
?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="breadcrumb-wrap">
                    <h2>Blog Details</h2>

                    <ul class="breadcrumb-links">
                    
                    <li>
                        <a href="index-2.html">Home</a>
                        <i class="bx bx-chevron-right"></i>
                    </li>
                    
                    <li>Blog Details</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="package-details-wrapper blog-details pt-120">
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
            <div class="package-details">
                <div class="package-thumb">
                    <img style="height: 500px" src="admin/story_files/<?php echo $img['media']?>" alt="">
                </div>
                
                <div class="package-header">
                    <div class="package-title">
                        <h3><?php echo $blog['tour_title']?></h3>
                        <strong><i class="flaticon-arrival"></i>
                            <?php echo $blog['firstname']." ".$blog['lastname']?>
                        </strong>
                    </div>
                </div>
            
            <div class="package-tab">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="flaticon-info"></i>
                    Information</button>
                    </li>

                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"> <i class="flaticon-gallery"></i>
                    Our Gallary</button>
                    </li>
                </ul>
            <div class="tab-content p-tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content-1">
                                <div class="p-overview">
                                    <h5>Overview</h5>
                                    <?php echo $blog['tour_description'] ;?>

                                    <div class="blog-details-wrapper">
                                        <div class="row">
                                            <div class="blog-bottom">
                                        <div class="blog-tags">
                                        <h5>tags:</h5>
                                        <ul>
                                        <li><a href="#">Trip</a></li>
                                        <li><a href="#">Travel Forest</a></li>
                                        <li><a href="#">Tourist</a></li>
                                        </ul>
                                        </div>


                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="tab-contant-2">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="package-grid-one">
                                <div class="single-grid mt-24">
                                    <?php 
                                        $i = 1;
                                        $getImage = $connect2db->prepare("SELECT media FROM tbl_media_file WHERE story_id = ?");
                                          $getImage->execute([$story_id]);
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
        </div>
    </div>
</div>

    <div class="blog-comments">
    <h5><?php echo $com_num; ?> Comments</h5>
        <ul>
            <?php 
                $comments = $connect2db->prepare("SELECT * FROM comment WHERE story_id = ?");
                $comments->execute([$story_id]);
                while ($comm = $comments->fetch()) {
                    $date = explode(' ', $comm['created_at']);
                    ?>
                    <li>
                        <div class="commentor">
                            <div class="commentotor-img"><img src="assets/images/blog/c-1.png" alt=""></div>
                            <div class="commentor-id">
                            <strong><?php echo $comm['name']?></strong>
                            <p><span><?php echo $date[0]?></span><span><?php echo $date[1]?></span></p>
                            </div>
                        </div>
                        <p class="comment"><?php echo $comm['comment']?></p>
                    </li>
            <?php 
               }
            ?>
            

        </ul>
    </div>

    <div class="blog-reply">
        <form method="post">
            <h5>Leave A Comment</h5>
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $story_id?>">
                <div class="col-lg-6">
                    <input type="text" name="name" placeholder="Full Name">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="phone" placeholder="Phone Number">
                </div>
                
                <div class="col-lg-12">
                    <textarea name="message" cols="30" rows="7" placeholder="Write Message"></textarea>
                </div>
                <div class="col-lg-12">
                    <input type="submit" name="comment" value="Submit Now">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="col-lg-4">
<div class="blog-sidebar">
<div class="row">
<!-- <div class="col-lg-12 col-md-6">
    <div class="blog-categorie mt-40">
        <h5 class="categorie-head">Categories</h5>
        <ul>
            <?php 
        // $getRecent = $connect2db->prepare("SELECT * FROM tbl_category ");
        // $getRecent->execute();
        // if ($getRecent->rowcount() < 1) {?>
            <h1>Category Not Available</h1>
    <?php  
      // }else{ 
      //   while ($info = $getRecent->fetch()) {
        ?>
        <li><a href="blog?slug=<?php // echo $info['slug']?>"><i class='bx bxs-chevrons-right'></i> <?php // echo $info['category']?></a></li>
        <?php
      //   } 
      // }
    ?>
        </ul>
    </div>
</div> -->


<div class="col-lg-12 col-md-6">
    <div class="blog-popular mt-40">
        <h5 class="categorie-head">Recent Stories</h5>
        <ul class="package-cards">
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
            <li class="package-card-sm">
                <div class="p-sm-img">
                    <img style="height: 100px;width: 100px;" src="admin/story_files/<?php echo $img['media']?>" alt="">
                </div>
                <div class="package-info">
                    <div class="package-date-sm">
                        <strong><i class="flaticon-calendar"></i><?php echo $info['created']?></strong>
                    </div>
                    <h3><i class="flaticon-arrival"></i>
                        <a href="blog-details?id=<?php echo $info['id']?>"><?php echo $info['tour_title']?></a>
                    </h3>
                </div>
            </li>
        <?php
        } 
      }
    ?>
        </ul>
    </div>
</div>




</div>
</div>
</div>
</div>
</div>
</div>





<?php include 'includes/footer.php';?>