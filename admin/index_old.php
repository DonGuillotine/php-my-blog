<?php include "includes/admin_header.php"?>
    <div id="wrapper">

       <?php include "includes/admin_navigation.php"?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                       <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $post_query = "SELECT * FROM posts";
                                        $post_result = mysqli_query($connection, $post_query);
                                        $post_count = mysqli_num_rows($post_result);
                                        echo "<div class='huge'>$post_count</div>"
                                        ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $comment_query = "SELECT * FROM comments";
                                        $comment_result = mysqli_query($connection, $comment_query);
                                        $comment_count = mysqli_num_rows($comment_result);
                                        echo "<div class='huge'>$comment_count</div>";
                                        ?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $user_query = "SELECT * FROM users";
                                        $user_result = mysqli_query($connection, $user_query);
                                        $user_count = mysqli_num_rows($user_result);
                                        echo "<div class='huge'>$user_count</div>";
                                        ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $category_query = "SELECT * FROM categories";
                                        $category_result = mysqli_query($connection, $category_query);
                                        $category_count = mysqli_num_rows($category_result);
                                        echo "<div class='huge'>$category_count</div>";
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>