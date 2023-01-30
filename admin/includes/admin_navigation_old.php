<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <a href="index.html">MY CMS ADMIN</a>
            </div>
        </div>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-files"></i><span>Posts
                                    </span></a>
                            <ul class="collapse">
                                <li><a href="posts.php">View All Posts</a></li>
                                <li><a href="posts.php?source=add_post">Add Post</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="categories.php" aria-expanded="true"><i class="ti-pie-chart"></i><span>Categories</span></a>
                        </li>
                        <li>
                            <a href="comments.php" aria-expanded="true"><i class="ti-comments"></i><span>Comments</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Users</span></a>
                            <ul class="collapse">
                                <li><a href="users.php">View All Users</a></li>
                                <li><a href="users.php?source=add_user">Add User</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="profile.php" aria-expanded="true"><i class="fa fa-table"></i>
                                <span>Profile</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- sidebar menu area end -->

        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><a style="color: white" href="#">Users Online: <span class="usersonline"></span></a></li>
                            <li><a style="color: white" href="../index.php">Home</a></li>
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>




            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">
                                <?php
                                /* This sets the $time variable to the current hour in the 24 hour clock format */
                                $time = date("H");
                                /* Set the $timezone variable to become the current timezone */
                                $timezone = date("e");
                                /* If the time is less than 1200 hours, show good morning */
                                if ($time < "12") {
                                    echo "Good Morning";
                                } else
                                    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                                    if ($time >= "12" && $time < "17") {
                                        echo "Good Afternoon";
                                    } else
                                        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                                        if ($time >= "17" && $time < "19") {
                                            echo "Good Evening";
                                        } else
                                            /* Finally, show good night if the time is greater than or equal to 1900 hours */
                                            if ($time >= "19") {
                                                echo "Good Night";
                                            }
                                ?>
                                <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}  ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span><?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
foreach($crumbs as $crumb){
    echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ');
} ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../images/avatar/avatar-bg.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $_SESSION['username'] ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <a class="dropdown-item" href="../includes/logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->



