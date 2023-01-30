<?php
function escape($string){
    global $connection;
        return mysqli_real_escape_string($connection, trim($string));
}

function users_online(){

    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include ("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_in_sec = 05;
            $total_time = $time - $time_in_sec;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("SESSION QUERY FAILED" . mysqli_error($connection));
            }
            $count = mysqli_num_rows($result);

            if($count == NULL){
                $session_query = "INSERT INTO users_online(session, time) VALUES ('$session','$time')";
                $session_result = mysqli_query($connection, $session_query);
                if(!$session_result){
                    die("SESSION QUERY FAILED" . mysqli_error($connection));
                }
            }
            else{
                $session_query2 = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
                if(!$session_query2){
                    die("SESSION QUERY FAILED" . mysqli_error($connection));
                }
            }

            $final_session_query = "SELECT * FROM users_online WHERE time < '$total_time'";
            $final_session_result = mysqli_query($connection, $final_session_query);
            if(!$final_session_result){
                die("SESSION QUERY FAILED" . mysqli_error($connection));
            }
            echo $final_count = mysqli_num_rows($final_session_result);
        }
    }


}
users_online();

function insert_categories(){
    global $connection;
if(isset($_POST['submit'])){
    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
        echo "<div style='color: red'>This field shouldn't be empty</div>";
    }
    else{
        $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("QUERY NOT SUCCESSFUL" . mysqli_error($connection));
        }
    }
}
}

function categories_table(){
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("<h1>YOUR QUERY WAS NOT PROCESSED</h1>");
    }

    while ($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function deleting_categories(){
    global $connection;
    if(isset($_GET['delete'])){
        $deleter = $_GET['delete'];
        $deleteQuery = "DELETE FROM categories WHERE cat_id = {$deleter}";
        $result = mysqli_query($connection, $deleteQuery);
        header("location: categories.php");
        if(!$result){
            die("THERE'S AN ERROR" . mysqli_error($connection));
        }
    }
}