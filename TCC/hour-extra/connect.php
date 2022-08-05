<?php 
 
$localhost = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "extra_hour"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
 
// check connection 
if($connect->connect_error) {
    echo"erro ao conectar no banco";
    die("connection failed : " . $connect->connect_error);
} 
 
?>