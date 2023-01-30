<?php include "includes/admin_header.php"?>
<div id="wrapper">

    <?php include "includes/admin_navigation.php"?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin Donald
                        <small>Donald</small>
                    </h1>


<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Decline</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>


    <?php
    $query = "SELECT * FROM comments WHERE comment_post_id=" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($result)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];

        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];


        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";

//        $cat_query = "SELECT * FROM CATEGORIES WHERE cat_id = '{$post_category_id}'";
//        $cat_result = mysqli_query($connection, $cat_query);
//        while($cat_row = mysqli_fetch_assoc($cat_result)){
//            $category_id = $cat_row['cat_id'];
//            $category_title = $cat_row['cat_title'];
//        }
//
//        echo "<td>{$category_title}</td>";




        echo "<td> {$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        $relationQuery = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $relationResult = mysqli_query($connection, $relationQuery);
        while($relation_row = mysqli_fetch_assoc($relationResult)){
            $post_id = $relation_row['post_id'];
            $post_title = $relation_row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }

        echo "<td>{$comment_date}</td>";

        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?decline=$comment_id'>Decline</a></td>";
        echo "<td><a href='post_comment.php?delete=$comment_id&id=" . $_GET['id'] ."'>Delete</a></td>";
        echo "</tr>";

    }
    ?>

    </tbody>
</table>

<?php

if (isset($_GET['approve'])){
    $commentApprove = $_GET['approve'];
    $commentApproveQuery = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $commentApprove";
    $commentApproveResult = mysqli_query($connection, $commentApproveQuery);
    header("location: comments.php");
    if (!$commentApproveResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}



if (isset($_GET['decline'])){
    $commentDecline = $_GET['decline'];
    $commentDeclineQuery = "UPDATE comments SET comment_status = 'declined' WHERE comment_id = $commentDecline";
    $commentDeclineResult = mysqli_query($connection, $commentDeclineQuery);
    header("location: comments.php");
    if (!$commentDeclineResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}


if (isset($_GET['delete'])){
    $commentDeleter = $_GET['delete'];
    $commentDeleteQuery = "DELETE FROM comments WHERE comment_id=$commentDeleter";
    $commentDeleteResult = mysqli_query($connection, $commentDeleteQuery);
    header("location: post_comment.php?id=". mysqli_real_escape_string($connection, $_GET['id']). " ");
    if (!$commentDeleteResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}

?>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>

