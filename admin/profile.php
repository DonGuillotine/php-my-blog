<?php include "includes/admin_header_old.php"?>
<?php
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '{$username}'";
$result = mysqli_query($connection, $query);
if(!$result){
    die("QUERY FAILED " . mysqli_error($connection));
}
while ($row = mysqli_fetch_array($result)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}
}
?>

<?php
if(isset($_POST['edit_user'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);


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

    $update_query = "UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', username='{$username}', user_email='{$user_email}', user_password='{$user_password}' WHERE username = '{$username}'";
    $edit_user_result = mysqli_query($connection, $update_query);
    if(!$edit_user_result){
        die("QUERY UNSUCCESSFUL" . mysqli_error($connection));
    }
}
?>


<div id="wrapper">

    <?php include "includes/admin_navigation_old.php"?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div style="padding-top: 100px;" class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">First Name</label>
                            <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Last Name</label>
                            <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
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
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>
                    </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer_old.php"?>

