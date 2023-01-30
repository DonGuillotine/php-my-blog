<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<div class="card">
    <div class="card-body" style="width: 100%">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Admin</th>
        <th>Subscriber</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>


    <?php
    $query = "SELECT * FROM users";
    $user_result = mysqli_query($connection, $query);
    if(!$user_result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($user_result)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";

//        $cat_query = "SELECT * FROM CATEGORIES WHERE cat_id = '{$post_category_id}'";
//        $cat_result = mysqli_query($connection, $cat_query);
//        while($cat_row = mysqli_fetch_assoc($cat_result)){
//            $category_id = $cat_row['cat_id'];
//            $category_title = $cat_row['cat_title'];
//        }
//
//        echo "<td>{$category_title}</td>";




        echo "<td> {$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";

//        $relationQuery = "SELECT * FROM posts WHERE post_id = $comment_post_id";
//        $relationResult = mysqli_query($connection, $relationQuery);
//        while($relation_row = mysqli_fetch_assoc($relationResult)){
//            $post_id = $relation_row['post_id'];
//            $post_title = $relation_row['post_title'];
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//        }



        echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
        echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";

    }
    ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Admin</th>
        <th>Subscriber</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </tfoot>
</table>
    </div>
</div>

<?php

if (isset($_GET['change_to_admin'])){
    $adminApprove = escape($_GET['change_to_admin']);
    $adminApproveQuery = "UPDATE users SET user_role = 'Admin' WHERE user_id = $adminApprove";
    $adminApproveResult = mysqli_query($connection, $adminApproveQuery);
    header("location: users.php");
    if (!$adminApproveResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}



if (isset($_GET['change_to_sub'])){
    $sub_id = escape($_GET['change_to_sub']);
    $subQuery = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $sub_id";
    $subResult = mysqli_query($connection, $subQuery);
    header("location: users.php");
    if (!$subResult){
        die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
    }
}


if (isset($_GET['delete'])){

    if(isset($_SESSION['user_role'])) {


        if(isset($_SESSION['user_role']) == 'admin') {
            $userDeleter = mysqli_real_escape_string($connection,  $_GET['delete']);


            $userDeleteQuery = "DELETE FROM users WHERE user_id=$userDeleter";
            $userDeleteResult = mysqli_query($connection, $userDeleteQuery);
            header("location: users.php");
            if (!$userDeleteResult) {
                die("DELETING WAS'NT SUCCESSFUL" . mysqli_error($connection));
            }
        }
    }
}

?>