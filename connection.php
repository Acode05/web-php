<?php
/*
$hostName = "localhost";
$dbUser = "root";
$dbPassword = " ";
$dbName = "petstore";
*/

$conn = mysqli_connect("localhost" , "root" , "" , "petstore");
if (!$conn){
    die("Connection failed : " . mysqli_connect_error());
}







?>