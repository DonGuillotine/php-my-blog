<?php
if(isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $checkBoxValue){
       $bulk_options = $_POST['bulk_options'];

       switch ($bulk_options){
           case "Published":
               $bulk_query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$checkBoxValue}";
               $bulk_result = mysqli_query($connection, $bulk_query);
               if(!$bulk_result){
                   die("BULK QUERY FAILED" . mysqli_error($connection));
               }
               break;

           case "Draft":
               $bulk_query2 = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$checkBoxValue}";
               $bulk_result2 = mysqli_query($connection, $bulk_query2);
               if(!$bulk_result2){
                   die("BULK QUERY FAILED" . mysqli_error($connection));
               }
               break;

           case "Delete":
               $bulk_query3 = "DELETE FROM posts WHERE post_id={$checkBoxValue}";
               $bulk_result3 = mysqli_query($connection, $bulk_query3);
               if(!$bulk_result3){
                   die("BULK QUERY FAILED " . mysqli_error($connection));
               }
               break;

           case "Clone":
               $bulk_query4 = "SELECT * FROM posts WHERE post_id={$checkBoxValue}";
               $bulk_result4 = mysqli_query($connection, $bulk_query4);
               if(!$bulk_result4){
                   die("BULK CLONE QUERY FAILED " . mysqli_error($connection));
               }

               while ($bulk_row = mysqli_fetch_array($bulk_result4)){
                   $post_author = $bulk_row['post_author'];
                   $post_title = $bulk_row['post_title'];
                   $post_category_id = $bulk_row['post_category_id'];
                   $post_status = $bulk_row['post_status'];
                   $post_image = $bulk_row['post_image'];
                   $post_tags = $bulk_row['post_tags'];
                   $post_date = $bulk_row['post_date'];
                   $post_content = $bulk_row['post_content'];
               }

               $clone_query = "INSERT INTO posts(post_author, post_title, post_category_id, post_status, post_image, post_tags, post_date, post_content) VALUES ('{$post_author}', '{$post_title}', '{$post_category_id}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_date}', '{$post_content}' ) ";
               $clone_result = mysqli_query($connection, $clone_query);
               if(!$clone_result){
                   die("CLONE QUERY FAILED " . mysqli_error($connection));
               }
               break;

           case "Reset":
               $bulk_query5 = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $checkBoxValue) . " ";
               $bulk_result5 = mysqli_query($connection, $bulk_query5);
               if(!$bulk_result5){
                   die("BULK QUERY FAILED " . mysqli_error($connection));
               }
               break;

       }
    }
}
?>

<form action="" method="post">
    <div class="card">
        <div class="card-body">
<table class="table table-bordered table-hover">
    <div style="padding-bottom: 15px;" id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
            <option value="Delete">Delete</option>
            <option value="Clone">Clone</option>
            <option value="Reset">Reset Post Views</option>
        </select>
    </div>
    <div class="col-xs-4" style="padding-bottom: 15px">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
    <thead>
    <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Users</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Views</th>
    </tr>
    </thead>
    <tbody>


    <?php
    $query = "SELECT * FROM posts ORDER BY post_id DESC ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($result)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];

        echo "<tr>";
        ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>;
        <?php
        echo "<td>{$post_id}</td>";

        if(isset($post_author) || !empty($post_author)){
            echo "<td>{$post_author}</td>";
        }
        elseif(isset($post_user) || !empty($post_user)){
            echo "<td>{$post_user}</td>";
        }




        echo "<td>{$post_title}</td>";

        $cat_query = "SELECT * FROM CATEGORIES WHERE cat_id = '{$post_category_id}'";
        $cat_result = mysqli_query($connection, $cat_query);
        while($cat_row = mysqli_fetch_assoc($cat_result)){
            $category_id = $cat_row['cat_id'];
            $category_title = $cat_row['cat_title'];
        }

        echo "<td>{$category_title}</td>";




        echo "<td> {$post_status}</td>";
        echo "<td><img height='50px' width='90px' src='../images/$post_image'></td>";
        echo "<td>{$post_tags}</td>";

        $comment_query = "SELECT * FROM COMMENTS WHERE comment_post_id = $post_id";
        $comment_result = mysqli_query($connection, $comment_query);


        $comment_row = mysqli_fetch_array($comment_result);
        $comment_id = isset($comment_row['comment_id']);


        $comment_count = mysqli_num_rows($comment_result);

        echo "<td><a href='post_comment.php?id=$post_id'>{$comment_count}</a></td>";

        echo "<td>{$post_date}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "<td><a href='posts.php?reset=$post_id'>{$post_views_count}</a></td>";
        echo "</tr>";

    }
    ?>

    </tbody>
</table>
        </div>
    </div>
</form>

<?php


if (isset($_GET['delete'])){
    $deleter = escape($_GET['delete']);
    $deleteQuery = "DELETE FROM posts WHERE post_id=$deleter";
    $deleteResult = mysqli_query($connection, $deleteQuery);
    header("location: posts.php");
    if (!$deleteResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}

if (isset($_GET['reset'])){
    $views_reset = escape($_GET['reset']);
    $views_reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $views_reset_result = mysqli_query($connection, $views_reset_query);
    header("location: posts.php");
    if (!$views_reset_result){
        die("RESETTING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}


?>