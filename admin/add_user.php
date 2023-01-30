<?php
if (isset($_POST['create_user'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);

//    $post_image = $_FILES['image'] ['name'];
//    $post_image_temp = $_FILES['image'] ['tmp_name'];

//    $upload_dir = '../images/';
//    $upload_file = $upload_dir . basename($_FILES['image'] ['name']);
//
//    if (move_uploaded_file($_FILES['image'] ['tmp_name'], $upload_file)){
//        echo "<div style='color: green'>Successfully Uploaded</div>";
//    }
//    else{
//        echo "Upload failed";
//    }


    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
//    $post_date = date('y-m-d');
//    $post_comment_count = 4;

//    move_uploaded_file($post_image_temp, "../images/$post_image" );
//    if(!move_uploaded_file($post_image_temp, "../images/$post_image")){
//        echo "THERE'S A PROBLEM SOMEWHERE";
//    }

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

    $add_query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}') ";
    $add_result = mysqli_query($connection, $add_query);
    if(!$add_result){
        die("QUERY FAILED " . mysqli_error($connection));
    }

    echo "<div style='color: green'>User created <a href='users.php'>View here</a></div>";
}


?>
<div class="card">
    <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label class="col-form-label" for="category">User Role</label>
        <select class="custom-select" name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>



<!--    <div class="form-group">-->
<!--        <label for="post_image">Post Image</label>-->
<!--        <input type="file" name="image">-->
<!--    </div>-->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>
    </div>
</div>