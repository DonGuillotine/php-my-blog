<?php
if(isset($_GET['edit_user'])) {
    $the_id_man = escape($_GET['edit_user']);

    $query = "SELECT * FROM users WHERE user_id = $the_id_man ";
    $user_result = mysqli_query($connection, $query);
    if (!$user_result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($user_result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }


    if (isset($_POST['edit_user'])) {
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


        if (!empty($user_password)) {
            $password_query = "SELECT user_password FROM users WHERE user_id = '$the_id_man'";
            $password_result = mysqli_query($connection, $password_query);
            if (!$password_result) {
                die("PASSWORD QUERY FAILED" . mysqli_error($connection));
            }
            $password_row = mysqli_fetch_array($password_result);
            $db_user_password = $password_row['user_password'];
        }

        if ($db_user_password != $user_password) {
            $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }


        $update_query = "UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_role='{$user_role}', username='{$username}', user_email='{$user_email}', user_password='{$hash_password}' WHERE user_id = {$the_id_man}";
        $edit_user_result = mysqli_query($connection, $update_query);
        if (!$edit_user_result) {
            die("QUERY UNSUCCESSFUL" . mysqli_error($connection));
        }
    }
}
else{
    header("Location: index.php");
}

?>
<div class="card">
    <div class="card-body" style="width: 100%">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label class="col-form-label for="user_role">User Role</label>
        <select class="custom-select" name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            }
            else{
                echo "<option value='admin'>admin</option>";
            }
            ?>


        </select>
    </div>



    <!--    <div class="form-group">-->
    <!--        <label for="post_image">Post Image</label>-->
    <!--        <input type="file" name="image">-->
    <!--    </div>-->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>
    </div>
</div>