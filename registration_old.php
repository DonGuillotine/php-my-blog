<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if(!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

//        $salt_query = "SELECT randSalt FROM users";
//        $salt_result = mysqli_query($connection, $salt_query);
//        if(!$salt_result){
//            die("QUERY FAILED" . mysqli_error($connection));
//        }

//        $salt_row = mysqli_fetch_array($salt_result);
//        $salt_getter = $salt_row['randSalt'];
//        $password = crypt($password, $salt_getter);

        $query = "INSERT INTO users(username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("QUERY FAILED" . mysqli_error($connection));
        }
        echo "<p class='bg-success text-center'>Registration Successful</p> ";
    }
    else{
        echo "<script>alert('The fields should not be empty')</script>";
    }


}
?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
