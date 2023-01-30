<?php include "includes/admin_header_old.php"?>


       <?php include "includes/admin_navigation_old.php"?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $post_query = "SELECT * FROM posts";
                                $post_result = mysqli_query($connection, $post_query);
                                $post_count = mysqli_num_rows($post_result);
                                echo "<div class='h4'>$post_count</div>"
                                ?>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Posts</div>
                                <a href="posts.php"><div class=" mb-0 font-weight-bold text-gray-800">View details</div></a>
                            </div>
                            <div class="col-auto">
                                <i class="ti-files fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $comment_query = "SELECT * FROM comments";
                                $comment_result = mysqli_query($connection, $comment_query);
                                $comment_count = mysqli_num_rows($comment_result);
                                echo "<div class='h4'>$comment_count</div>";
                                ?>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Comments</div>
                                <a href="comments.php"><div class="mb-0 font-weight-bold text-gray-800">View Details</div></a>
                            </div>
                            <div class="col-auto">
                                <i class="ti-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $user_query = "SELECT * FROM users";
                                $user_result = mysqli_query($connection, $user_query);
                                $user_count = mysqli_num_rows($user_result);
                                echo "<div class='h4'>$user_count</div>";
                                ?>
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                                <a href="users.php"><div class="mb-0 font-weight-bold text-gray-800">View Details</div></a>
                            </div>
                            <div class="col-auto">
                                <i class="ti-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $category_query = "SELECT * FROM categories";
                                $category_result = mysqli_query($connection, $category_query);
                                $category_count = mysqli_num_rows($category_result);
                                echo "<div class='h4'>$category_count</div>";
                                ?>
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Categories</div>
                                <a href="categories.php"><div class="mb-0 font-weight-bold text-gray-800">View Details</div></a>
                            </div>
                            <div class="col-auto">
                                <i class="ti-menu-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<!--        <div id="page-wrapper">-->

            <div class="container-fluid">



                <?php
                $publish_query = "SELECT * FROM posts WHERE post_status = 'published'";
                $publish_result = mysqli_query($connection, $publish_query);
                $publish_count = mysqli_num_rows($publish_result);

                $draft_query = "SELECT * FROM posts WHERE post_status = 'draft'";
                $draft_result = mysqli_query($connection, $draft_query);
                $draft_count = mysqli_num_rows($draft_result);

                $pending_query = "SELECT * FROM comments WHERE comment_status = 'declined'";
                $pending_result = mysqli_query($connection, $pending_query);
                $pending_count = mysqli_num_rows($pending_result);

                $sub_query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
                $sub_result = mysqli_query($connection, $sub_query);
                $sub_count = mysqli_num_rows($sub_result);
                ?>
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                $data = ['All Posts','Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                                $counter = [$post_count, $publish_count, $draft_count, $comment_count, $pending_count, $user_count, $sub_count, $category_count];

                                for ($i=0; $i < 8; $i++){
                                    echo "['{$data[$i]}'" . "," . "{$counter[$i]}],";
                                }
                                ?>

                                // ['Posts', 1000],
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div class="col-xl-12 card">
                    <div class="card-body">
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                    </div>
                    </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

<!--        </div>-->
        <!-- /#page-wrapper -->
    </div>

<?php include "includes/admin_footer_old.php"?>