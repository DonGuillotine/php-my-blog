<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php";?>
<?php
if(!isset($_SESSION['user_role'])){
        header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>
    <link href="css/loader.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/sb-admin.css" rel="stylesheet">


    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/ckeditor5-build-classic/ckeditor.js"></script>





    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


</head>

<body>

