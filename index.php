<?php include "includes/db.php"?>
<?php include "includes/header.php"?>







    <!-- wrapper-->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <!--  section  -->
            <section class="parallax-section single-par" data-scrollax-parent="true">
                <div class="bg par-elem " style="background-image: url(images/bg/1.jpg)"  data-scrollax="properties: { translateY: '30%' }"></div>
                <div class="overlay op7"></div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Welcome to my Blog</span></h2>
                        <span class="section-separator"></span>
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
                    </div>
                </div>
                <div id="arrow" class="header-sec-link">
                    <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down bounce"></i></a>
                </div>
            </section>
            <!--  section  end-->
            <section class="gray-bg no-top-padding-sec" id="sec1">
                <div class="container">
                    <div class="post-container fl-wrap">
                        <div class="row">
                            <!-- blog content-->
                            <div class="col-md-8">

                                <!--                THIS IS THE CODE TO MAKE PAGINATION-->
                                <?php
                                $per_page = 4;
                                $count_query = "SELECT * FROM posts WHERE post_status='published'";
                                $count_result = mysqli_query($connection, $count_query);
                                if(!$count_result){
                                    die("COUNT QUERY FAILED" . mysqli_error($connection));
                                }
                                $total_count = mysqli_num_rows($count_result);

                                if($total_count < 1){
                                    echo "<h1 style='color: white; text-align: center'>NO POSTS</h1>";
                                }else{

                                $count = ceil($total_count/$per_page);


                                if(isset($_GET['page'])){
                                    $page = $_GET['page'];
                                }
                                else{
                                    $page = "";
                                }

                                if($page == "" || $page == 1){
                                    $page_1 = 0;
                                }
                                else{
                                    $page_1 = ($page * $per_page) - $per_page;
                                }


                                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                                $result = mysqli_query($connection, $query);
                                if (!$result){
                                    die("CONNECTION FAILED" . mysqli_error($connection));
                                }
                                while($row = mysqli_fetch_assoc($result)) {
                                $holder0 = $row['post_id'];
                                $holder1 = $row['post_title'];
                                $holder2 = $row['post_author'];
                                $holder3 = $row['post_date'];
                                $holder4 = $row['post_image'];
                                $holder5 = substr($row['post_content'], 0, 200) ;
                                $holder7 = $row['post_tags'];
                                $holder8 = $row['post_views_count'];
                                                    $holder6 = $row['post_status'];



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
                                <?php }  } ?>
                                <!-- article end -->



                                <div class="pagination">
                                    <?php
                                    for ($i=1; $i<=$count; $i++){
                                        if($i == $page){
                                            echo "<a class='current-page' href='index.php?page={$i}'>$i</a>";
                                        }
                                        else{
                                            echo "<a href='index.php?page={$i}'>$i</a>";
                                        }
                                    }
                                    ?>
                                </div>


                            </div>
                            <!-- blog conten end-->
                           <?php include "includes/sidebar.php"?>
                        </div>
                    </div>
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
        </div>
        <!--content end-->
    </div>
    <!-- wrapper end-->


<?php include "includes/navigation.php"?>

<a class="to-top"><i class="fas fa-caret-up"></i></a>

<?php include "includes/footer.php"?>


