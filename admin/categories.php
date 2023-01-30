<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" defer></script>
<?php include "includes/admin_header_old.php"?>


    <?php include "includes/admin_navigation_old.php"?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div style="padding-top: 100px" class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                                <th>Update</th>
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
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    </div>
</div>

    <?php include "includes/admin_footer_old.php"?>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>