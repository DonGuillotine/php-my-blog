<?php session_start(); ?>
<?php include "includes/db.php"?>
<?php include "includes/header.php"?>


<!-- Navigation -->
<?php include "includes/navigation.php"?>
<div id="wrapper">
  <section class="gray-bg no-top-padding-sec" id="sec1">
      <div class="container">
          <div class="post-container fl-wrap">
              <div class="row">
                  <!-- blog content-->
                  <div class="col-md-8">
            <?php
            if(isset($_GET['p_id'])){
                $Post_id = $_GET['p_id'];
//                THIS IS A QUERY TO DISPLAY THE NUMBER OF TIMES A POST WAS VIEWED
                $view_query = "UPDATE posts SET post_views_count=post_views_count + 1 WHERE post_id=$Post_id";
                $view_result = mysqli_query($connection, $view_query);
                if(!$view_result){
                    die("VIEW QUERY FAILED" . mysqli_error($connection));
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {
                    $query = "SELECT * FROM posts WHERE post_id=$Post_id ";
                } else{
                    $query = "SELECT * FROM posts WHERE post_id=$Post_id AND post_status = 'published' ";
                }


            $result = mysqli_query($connection, $query);

//                if(mysqli_num_rows($result) < 1){
//                    echo "<h1 style='color: white; text-align: center'>NO POSTS AVAILABLE</h1>";
//                }else{


            while($row = mysqli_fetch_assoc($result)){
               $holder0 = $row['post_id'];
                $holder1 = $row['post_title'];
                $holder2 = $row['post_author'];
                $holder3 = $row['post_date'];
                $holder4 = $row['post_image'];
                $holder5 = $row['post_content'];
                $holder7 = $row['post_tags'];
                $holder8 = $row['post_views_count'];
                ?>



                <!-- article> -->
                <article class="post-article">
                    <div class="list-single-main-media fl-wrap">
                        <img src="images/<?php echo $holder4?>" class="respimg" alt="">
                    </div>
                    <div class="list-single-main-item fl-wrap block_box">

                        <h2 class="post-opt-title"><a href="#"><?php echo $holder1 ?></a></h2>

                        <div class="post-author"><a href="author_posts.php?author=<?php echo $holder2 ?>&p_id=<?php echo $holder0 ?>"><img src="images/avatar/5.jpg" alt=""><span>By , <?php echo $holder2 ?></span></a></div>
                        <div class="post-opt">
                            <ul class="no-list-style">
                                <li><i class="fal fa-calendar"></i> <span><?php echo $holder3 ?></span></li>
                                <li><i class="fal fa-eye"></i> <span><?php echo $holder8 ?></span></li>
                                <li><i class="fal fa-tags"></i> <a href="#"><?php echo $holder7 . "," ?></a></li>
                            </ul>
                        </div>
                        <span class="fw-separator"></span>

                        <p style="padding-top: 50px"><?php echo $holder5 ?></p>
                        <p><?php echo $holder5 ?></p>
                        <span class="fw-separator"></span>
                    </div>
                </article>
                <!-- article end -->

            <?php }

            ?>


            <!-- Posted Comments -->
                      <!-- list-single-main-item -->
                      <div class="list-single-main-item fl-wrap block_box">
                          <div class="list-single-main-item-title">
                            <?php
                              $comment_count_query = "SELECT * FROM comments WHERE comment_post_id = '{$holder0}'";
                              $comment_count_query_result = mysqli_query($connection, $comment_count_query);
                              if(!$comment_count_query_result){
                                  die("Comment count query failed " . mysqli_error($connection));
                              }
                              $comment_count = mysqli_num_rows($comment_count_query_result);

                             ?>
                             <h3>Post Comments -  <span> <?php echo $comment_count ?><!--</span></h3>-->
                          </div>
                          <div class="list-single-main-item_content fl-wrap">
                              <div class="reviews-comments-wrap">



            <!-- Comment -->
            <?php
            $display_Comments_Query = "SELECT * FROM comments WHERE comment_post_id = {$Post_id} AND comment_status = 'approved' ORDER BY comment_id DESC ";
            $display_result = mysqli_query($connection, $display_Comments_Query);
            if(!$display_Comments_Query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while ($display_row = mysqli_fetch_array($display_result)){
                $display_comment_date = $display_row['comment_date'];
                $display_comment_content = $display_row['comment_content'];
                $display_comment_author = $display_row['comment_author'];
             ?>
                <!-- reviews-comments-item -->
                            <div class="reviews-comments-item only-comments">
                                <div class="review-comments-avatar">
                                    <img src="images/avatar/avatar-bg.png" alt="">
                                </div>
                                <span class="tip tip-right"></span>
                                <div class="reviews-comments-item-text fl-wrap">
                                    <div class="reviews-comments-header fl-wrap">
                                        <h4><a style="color: white" href="#"><?php echo $display_comment_author ?></a></h4>
                                    </div>
                                    <p>" <?php echo $display_comment_content ?> "</p>
                                    <div class="reviews-comments-item-footer fl-wrap">
                                        <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i><?php echo $display_comment_date ?></span></div>
                                        <a href="#" class="reply-item">Reply</a>
                                    </div>
                                </div>
                            </div>
                <!--reviews-comments-item end-->

                              </div>
                          </div>
                      </div>
                      <!-- list-single-main-item end -->

            <?php   } }
            else{
                header("Location: index.php");
            } ?>



                      <?php
                      if(isset($_POST['create_comment'])){
                          $Post_id = $_GET['p_id'];

                          $comment_author = $_POST['comment_author'];
                          $comment_email = $_POST['comment_email'];
                          $comment_content = $_POST['comment_content'];

                          if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                              $comment_query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($Post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approved', now())";

                              $comment_query = mysqli_query($connection, $comment_query);
                              if(!$comment_query){
                                  die("QUERY FAILED" . mysqli_error($connection));
                              } else{
                                  header("Location: post.php?p_id=$Post_id");
                              }


                          }
                          else{
                              echo "<script>alert('The fields should not be empty')</script>";
                          }


                      }
                      ?>





<!--                      --><?php
//                        if(mysqli_num_rows($result) < 1){
//                            echo "<h1 style='color: white; text-align: center'></h1>";
//                            }else{
//                            ?>
<!--                      --><?php
//                      if(mysqli_num_rows($result) < 1){
//                          echo "<h1 style='color: white; text-align: center'></h1>";
//                      }else{
//                      ?>
                      <!-- list-single-main-item -->
                      <div class="list-single-main-item fl-wrap block_box">
                          <div class="list-single-main-item-title">
                              <h3>Add Comment</h3>
                          </div>
                          <div id="add-review" class="add-review-box">
                              <!-- Review Comment -->
                              <form action="" class="add-comment  custom-form" method="post" role="form" >
                                  <fieldset>
                                      <div class="list-single-main-item_content fl-wrap">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label><i class="fal fa-user"></i></label>
                                                  <input type="text" placeholder="Your Name *" name="comment_author"/>
                                              </div>
                                              <div class="col-md-6">
                                                  <label><i class="fal fa-envelope"></i>  </label>
                                                  <input type="email" placeholder="Email Address*" name="comment_email"/>
                                              </div>
                                          </div>
                                          <textarea  name="comment_content" cols="40" rows="3" placeholder="Your comment:"></textarea>
                                          <div class="clearfix"></div>
                                          <button type="submit" name="create_comment" class="btn  color2-bg  float-btn" style="margin-top:30px; color: white">Submit Comment <i class="fal fa-paper-plane"></i></button>
                                      </div>
                                  </fieldset>
                              </form>
                          </div>
                      </div>


                      <!-- list-single-main-item end -->

                  </div>


                  <!-- blog conten end-->


<!--                  --><?php //} ?>

              </div>

          </div>

<!--          --><?php //} ?>

      </div>
      <?php include "includes/sidebar.php"?>
  </section>

</div>

<!--    <a class="to-top"><i class="fas fa-caret-up"></i></a>-->

<?php include "includes/footer.php"?>

