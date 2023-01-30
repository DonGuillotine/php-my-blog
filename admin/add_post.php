<?php
if (isset($_POST['create_post'])){
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_author = escape($_POST['author']);
    $post_status = escape($_POST['post_status']);

//    $post_image = $_FILES['image'] ['name'];
//    $post_image_temp = $_FILES['image'] ['tmp_name'];

    $upload_dir = '../images/';
    $upload_file = escape($upload_dir . basename($_FILES['image'] ['name']));

    if (move_uploaded_file($_FILES['image'] ['tmp_name'], $upload_file)){
        echo "<div style='color: green'>Successfully Uploaded</div>";
    }
    else{
        echo "Upload failed";
    }


    $post_content = escape($_POST['post_content']);
    $post_tags = escape($_POST['post_tags']);
    $post_date = escape(date('y-m-d'));
//    $post_comment_count = 4;

//    move_uploaded_file($post_image_temp, "../images/$post_image" );
//    if(!move_uploaded_file($post_image_temp, "../images/$post_image")){
//        echo "THERE'S A PROBLEM SOMEWHERE";
//    }

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ('{$post_category_id}','{$post_title}', '{$post_author}', '{$post_date}', '{$upload_file}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }
    $get_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>POST CREATED SUCCESSFULLY <a href='../post.php?p_id={$get_post_id}'>VIEW HERE</a> or <a href='posts.php'>EDIT MORE POSTS</a></p>";
}


?>
<div class="card">
    <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <label class="col-form-label" for="category">Post Author</label>
        <select class="custom-select" name="author" id="">
            <?php
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
        <label class="col-form-label" for="post_status">Post Status</label>
        <select class="custom-select" name="post_status" id="">
            <option value="draft">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="post_image">Post Image</label>-->
<!--        <input type="file" name="image">-->
<!--    </div>-->

    <label class="col-form-label" for="post_image">Post Image</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image">
            <label class="custom-file-label" for="post_image">Choose file</label>
        </div>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>
    </div>
</div>
