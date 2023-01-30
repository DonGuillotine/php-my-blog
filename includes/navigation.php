<!-- --><?php //session_start(); ?>
<div id="main">
<!-- header -->
<header class="main-header">
    <!-- logo-->
    <a href="index.php" class="logo-holder"><img src="images/logo.png" alt=""></a>
    <!-- logo end-->
    <!-- header opt -->
    <a href="#" class="add-list color-bg">Welcome <span><i class="fal fa-layer-plus"></i></span></a>
    <div class="show-reg-form modal-open avatar-img" data-srcav="images/avatar/3.jpg"><i class="fal fa-user"></i>Sign In</div>
    <!-- header opt end-->
    <!-- nav-button-wrap-->
    <div class="nav-button-wrap color-bg">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    <!-- nav-button-wrap end-->
    <!--  navigation -->
    <div class="nav-holder main-menu">
        <nav>
            <ul class="no-list-style">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="admin\index.php">Admin</a>
                </li>
                <li>
                    <a href="index.php">Blog</a>
                </li>
                <li>
                    <a href="contact.php">Contact me</a>
                </li>
                <?php
                if(isset($_SESSION['user_role'])){
                    if(isset($_GET['p_id'])){
                        $the_actual_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_actual_id}'>Edit Post</a></li>";
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
    <!-- navigation  end -->

</header>
<!-- header end-->

</div>



<!--register form -->
<div class="main-register-wrap modal">
    <div class="reg-overlay"></div>
    <div class="main-register-holder tabs-act">
        <div class="main-register fl-wrap  modal_main">
            <div class="main-register_title">Welcome to <span><strong>Town</strong>Hub<strong>.</strong></span></div>
            <div class="close-reg"><i class="fal fa-times"></i></div>
            <ul class="tabs-menu fl-wrap no-list-style">
                <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Register</a></li>
            </ul>
            <!--tabs -->
            <div class="tabs-container">
                <div class="tab">
                    <!--tab -->
                    <div id="tab-1" class="tab-content first-tab">
                        <div class="custom-form">
                            <form action="includes/login.php" method="post">
                                <label>Username or Email Address <span>*</span> </label>
                                <input name="username" type="text">
                                <label >Password <span>*</span> </label>
                                <input name="password" type="password" >
                                <button type="submit"  class="btn float-btn color2-bg" style="color: white;" name="login"> Log In <i class="fas fa-caret-right"></i></button>
                                <div class="clearfix"></div>
                                <div class="filter-tags">
                                    <input id="check-a3" type="checkbox" name="check">
                                    <label for="check-a3">Remember me</label>
                                </div>
                            </form>
                            <div class="lost_password">
                                <a href="#">Lost Your Password?</a>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->



                    <?php
                    if(isset($_POST['register'])){
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];


                        if(!empty($username) && !empty($email) && !empty($password)){

                            $username = mysqli_real_escape_string($connection, $username);
                            $email = mysqli_real_escape_string($connection, $email);
                            $password = mysqli_real_escape_string($connection, $password);

                            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                            $query = "INSERT INTO users(username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
                            $result = mysqli_query($connection, $query);
                            if(!$result){
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
//                            echo "<script>alert('Registration Successful')</script>";
                        }
                        else{
                            echo "<script>alert('The fields should not be empty')</script>";
                        }


                    }
                    ?>


                    <!--tab -->
                    <div class="tab">
                        <div id="tab-2" class="tab-content">
                            <div class="custom-form">
                                <form role="form" action="index.php" method="post" class="main-register-form" id="login-form" autocomplete="off">
                                    <label >User Name <span>*</span> </label>
                                    <input type="text" name="username" id="username">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" name="email" id="email">
                                    <label >Password <span>*</span></label>
                                    <input type="password" name="password" id="key" >
                                    <div class="filter-tags ft-list">
                                        <input id="check-a2" type="checkbox" name="check">
                                        <label for="check-a2">I agree to the <a href="#">Privacy Policy</a></label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="filter-tags ft-list">
                                        <input id="check-a" type="checkbox" name="check">
                                        <label for="check-a">I agree to the <a href="#">Terms and Conditions</a></label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" name="register" class="btn float-btn color2-bg" style="color: white;"> Register  <i class="fas fa-caret-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->
                </div>
                <!--tabs end -->
                <div class="log-separator fl-wrap"><span>or</span></div>
                <div class="soc-log fl-wrap">
                    <p>For faster login or register use your social account.</p>
                    <a href="#" class="facebook-log"> Facebook</a>
                </div>
                <div class="wave-bg">
                    <div class='wave -one'></div>
                    <div class='wave -two'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->