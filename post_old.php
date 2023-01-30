<?php include "includes/db.php"?>
<?php include "includes/header.php"?>

<!-- Navigation -->
<?php include "includes/navigation.php"?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
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

            $query = "SELECT * FROM posts WHERE post_id='{$Post_id}'";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die("CONNECTION FAILED" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($result)){
                $holder1 = $row['post_title'];
                $holder2 = $row['post_author'];
                $holder3 = $row['post_date'];
                $holder4 = $row['post_image'];
                $holder5 = $row['post_content'];
                ?>



                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $holder1 ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $holder2 ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $holder3 ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $holder4?>" alt="">
                <hr>
                <p><?php echo $holder5 ?></p>

            <?php }
            }
            else{
                header("Location: index.php");
            }
            ?>

            <hr>
            <!-- Comments Form -->
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
                    }


                }
                else{
                    echo "<script>alert('The fields should not be empty')</script>";
                }


            }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

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

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $display_comment_author ?>
                        <small><?php echo $display_comment_date ?></small>
                    </h4>
                   <?php echo $display_comment_content ?>
                </div>
            </div>


          <?php } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>








        <!-- /.row -->





<?php include "includes/footer.php"?>