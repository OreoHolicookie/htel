<?php

$server = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password
$database = "hotel";

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn){
    die("<script>alert('connection Failed.')</script>");
}
?>