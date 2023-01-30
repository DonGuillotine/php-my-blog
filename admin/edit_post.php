<?php
if (isset($_GET['p_id'])){
    $get_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id=$get_post_id";
$edit_result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($edit_result)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])){
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_author = escape($_POST['author']);
    $post_status = escape($_POST['post_status']);
    $post_image          =  escape($_FILES['image']['name']);
    $post_image_temp     =  escape($_FILES['image']['tmp_name']);
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $image_query = "SELECT * FROM posts WHERE post_id = $get_post_id";
        $image_result = mysqli_query($connection, $image_query);
        while($image_row = mysqli_fetch_array($image_result)){
            $image_replacer = $image_row['post_image'];
        }
    }
    $post_content = escape($_POST['post_content']);
    $post_tags = escape($_POST['post_tags']);

    $update_query = "UPDATE posts SET post_category_id='{$post_category_id}', post_title='{$post_title}', post_author='{$post_author}', post_date='{$post_date}', post_image='{$post_image}', post_content='{$post_content}', post_tags='{$post_tags}', post_comment_count='{$post_comment_count}', post_status='{$post_status}' WHERE post_id = {$get_post_id}";
    $update_result = mysqli_query($connection, $update_query);
    if (!$update_query){
        die("<div style='color: red'>QUERY FAILED</div>");
    }
    echo "<p class='bg-success'>POST UPDATED SUCCESSFULLY <a href='../post.php?p_id={$get_post_id}'>VIEW HERE</a> or <a href='posts.php'>EDIT MORE POSTS</a></p>";
}

?>

<div class="card">
    <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label class="col-form-label" for="category">Post Category</label>
        <select class="custom-select" name="post_category" id="">
            <?php
            $query_option = "SELECT * FROM categories";
            $result_option = mysqli_query($connection, $query_option);
            if (!$result_option){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($result_option)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>$cat_title</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="author">Post Author</label>
        <select class="custom-select" name="author" id="">
            <?php
            echo "<option value='{$post_author}'>{$post_author}</option>";
            $users_query_option = "SELECT * FROM users";
            $users_result_option = mysqli_query($connection, $users_query_option);
            if (!$users_result_option){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while ($users_row = mysqli_fetch_array($users_result_option)){
                $user_id = $users_row['user_id'];
                $username = $users_row['username'];

                echo "<option value='{$username}'>{$username}</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label class="col-form-label" for="author">Post Status</label>
    <select class="custom-select" name="post_status" id="">
        <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
        <?php
        if($post_status == 'published'){
            echo "<option value='draft'>Draft</option>";
        }
        else{
            echo "<option value='published'>Published</option>";
        }
        ?>
    </select>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="author">Post Image</label>
        <img style="padding-bottom: 10px" width="100" src="../images/<?php echo $post_image ?>">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image">
            <label class="custom-file-label" for="post_image">Choose file</label>
        </div>
    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"><?php echo $post_content?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>
    </div>
</div>

