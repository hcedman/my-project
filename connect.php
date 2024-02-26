<?php
#Server..
// $host = '';
// $user = '';
// $pass = '';
// $database = '';
#Test..
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'benz_online';

$conn = new mysqli($host,$user,$pass,$database);
if($conn->connect_error){
    die($conn->connect_error);
}
