<?php include "includes/admin_header_old.php"?>
<div id="wrapper">

    <?php include "includes/admin_navigation_old.php"?>




        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div style="padding-top: 100px;" class="col-lg-12">


                <?php
                if(isset($_GET['source'])){
                    $getter = $_GET['source'];
                }
                else{
                    $getter = '';
                }
                switch ($getter){
                    case "add_user":
                        include "add_user.php";
                        break;
                    case "edit_user":
                        include "edit_user.php";
                        break;
                    case 150:
                        echo "PAGE 150";
                        break;

                    default:
                        include "view_all_users.php";
                        break;
                }
                ?>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->



    <?php include "includes/admin_footer_old.php"?>

