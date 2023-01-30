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
            if(isset($_GET['category'])){
                $post_category_id = $_GET['category'];
            }
            $query = "SELECT * FROM posts WHERE post_category_id='{$post_category_id}'";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die("CONNECTION FAILED" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($result)){
                $holder0 = $row['post_id'];
                $holder1 = $row['post_title'];
                $holder2 = $row['post_author'];
                $holder3 = $row['post_date'];
                $holder4 = $row['post_image'];
                $holder5 =  $holder5 = substr($row['post_content'], 0, 200) ;
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $holder0?>"><?php echo $holder1 ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $holder2 ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $holder3 ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $holder0?>">
                    <img class="img-responsive" src="images/<?php echo $holder4?>" alt="">
                </a>
                <hr>
                <p><?php echo $holder5 ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <?php } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"?>
