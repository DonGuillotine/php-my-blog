<?php
//THIS THE FIRST WAY TO CONNECT TO A DATABASE
//$connection = mysqli_connect('localhost', 'root', '','cms');
//if(!$connection){
//    die("CONNECTION FAILED");
//}

//SECOND WAY T0 CONNECT TO A DATABASE EDWIN'S METHOD
$db['host'] = 'localhost';
$db['user'] = 'root';
$db['password'] = '';
$db['database'] = 'cms';

foreach ($db as $key => $carrier){
    define(strtoupper($key), $carrier);//WE ARE CONVERTING THE VALUES IN THE ARRAY TO CONSTANTS
}
$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if(!$connection){
        die("NOT CONNECTED");
    }


