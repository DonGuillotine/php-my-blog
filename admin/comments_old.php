<?php include "includes/admin_header.php"?>
<div id="wrapper">

    <?php include "includes/admin_navigation.php"?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin Donald
                        <small>Donald</small>
                    </h1>

                <?php
                if(isset($_GET['source'])){
                    $getter = $_GET['source'];
                }
                else{
                    $getter = '';
                }
                switch ($getter){
                    case "add_post":
                        include "add_post.php";
                        break;
                    case "edit_post":
                        include "edit_post.php";
                        break;
                    case 150:
                        echo "PAGE 150";
                        break;

                    default:
                        include "view_all_comments.php";
                        break;
                }
                ?>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>

