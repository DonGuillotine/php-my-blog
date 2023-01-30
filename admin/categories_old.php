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
                    <div class="col-xs-6">
<!--                        INSERTING CATEGORIES TO THE DATABASE-->
                        <?php
                        insert_categories();
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
<!--                        UPDATING THE CATEGORIES TABLE-->
                      <?php
                      if(isset($_GET['update'])){
                          $cat_id = $_GET['update'];
                          include "update_categories.php";
                      }
                      ?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            CATEGORIES TABLE-->
                            <?php
                            categories_table();
                            ?>
<!--                            DELETING VALUES TABLE-->
                            <?php
                            deleting_categories();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>
