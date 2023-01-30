<?php include "includes/db.php"?>
<?php include "includes/header.php"?>

<!-- Navigation -->
<?php include "includes/navigation.php"?>

    <section class="gray-bg no-top-padding-sec" id="sec1">
    <div class="container">
    <div class="post-container fl-wrap">
    <div class="row">
        <!-- blog content-->
        <div class="col-md-8">
            <?php
            if(isset($_GET['p_id'])){
                $Post_id = $_GET['p_id'];
                $Author = $_GET['author'];
            }

            $query = "SELECT * FROM posts WHERE post_author='{$Author}'";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die("CONNECTION FAILED" . mysqli_error($connection));
            }
//            TO DISPLAY THE SPECIFIC AUTHOR POST
            $post_author = mysqli_fetch_assoc($result);
            $post_author_name = $post_author['post_author'];
            echo "<h1 style='text-align: center; padding-bottom: 20px'>All posts by {$post_author_name}</h1>";
//            TO DISPLAY THE SPECIFIC AUTHOR POST

            while($row = mysqli_fetch_assoc($result)){
                $holder0 = $row['post_id'];
                $holder1 = $row['post_title'];
                $holder2 = $row['post_author'];
                $holder3 = $row['post_date'];
                $holder4 = $row['post_image'];
                $holder5 =  $holder5 = substr($row['post_content'], 0, 200) ;
                $holder7 = $row['post_tags'];
                $holder8 = $row['post_views_count'];
                ?>
                <!-- article> -->
                <article class="post-article">
                    <div class="list-single-main-media fl-wrap">
                        <img src="images/<?php echo $holder4?>" class="respimg" alt="">
                    </div>
                    <div class="list-single-main-item fl-wrap block_box">
                        <h2 class="post-opt-title"><a href="post.php?p_id=<?php echo $holder0?>"><?php echo $holder1 ?></a></h2>
                        <p><?php echo $holder5 ?></p>
                        <p><?php echo $holder5 ?></p>
                        <span class="fw-separator"></span>
                        <div class="post-author"><a href="author_posts.php?author=<?php echo $holder2 ?>&p_id=<?php echo $holder0 ?>"><img src="images/avatar/5.jpg" alt=""><span>By , <?php echo $holder2 ?></span></a></div>
                        <div class="post-opt">
                            <ul class="no-list-style">
                                <li><i class="fal fa-calendar"></i> <span><?php echo $holder3 ?></span></li>
                                <li><i class="fal fa-eye"></i> <span><?php echo $holder8 ?></span></li>
                                <li><i class="fal fa-tags"></i> <a href="#"><?php echo $holder7 . "," ?></a></li>
                            </ul>
                        </div>
                        <a href="post.php?p_id=<?php echo $holder0?>" class="btn  color2-bg float-btn" style="color: white">Read more<i class="fal fa-angle-right"></i></a>
                    </div>
                </article>
                <!-- article end -->

            <?php } ?>

        </div>
        <!-- blog conten end-->
        <?php include "includes/sidebar.php"?>
    </div>
    </div>
    </div>
    </section>










        <!-- /.row -->





<?php include "includes/footer.php"?>