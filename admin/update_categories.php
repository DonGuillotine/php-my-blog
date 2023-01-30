<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        <?php
        if (isset($_GET['update'])){
            $updater = escape($_GET['update']);
            $updateQuery = "SELECT * FROM categories WHERE cat_id = $updater";
            $result = mysqli_query($connection, $updateQuery);

            while($row = mysqli_fetch_assoc($result)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                ?>


                <input value="<?php if(isset($cat_title)) echo $cat_title; ?>" type="text" class="form-control" name="cate_title">
                <?php
            }
        }
        ?>

        <?php
        if(isset($_POST['update_category'])){
            $updater_two = escape($_POST['cate_title']);
            $my_update_query = "UPDATE categories SET cat_title = '{$updater_two}' WHERE cat_id = {$cat_id} ";
            $catUpdate = mysqli_query($connection, $my_update_query);
            if (!$catUpdate){
                die("THERE'S AN ERROR" .mysqli_error($connection));
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>

