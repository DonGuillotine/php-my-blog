<?php session_start(); ?>

<?php include "db.php";

if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

   $username = mysqli_escape_string($connection, $username);
   $password = mysqli_escape_string($connection, $password);

   $query = "SELECT * FROM users WHERE username = '{$username}'";
   $result = mysqli_query($connection, $query);
   if(!$result){
       die("QUERY FAILED" . mysqli_error($connection));
   }

   while($row = mysqli_fetch_array ($result)){
       $user_id = $row['user_id'];
       $the_username = $row['username'];
       $the_password = $row['user_password'];
       $user_firstname = $row['user_firstname'];
       $user_lastname = $row['user_lastname'];
       $user_role = $row['user_role'];
 }

   if(password_verify($password, $the_password)){
       $_SESSION['username']=$the_username;
       $_SESSION['first_name']=$user_firstname;
       $_SESSION['last_name']=$user_lastname;
       $_SESSION['user_role']=$user_role;

       header("Location: ../admin");
   }

   else{
       header("Location: ../index.php");
   }
}