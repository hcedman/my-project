<?php
//////////////////ON HOSTING INFINITY////////////////////
// $host = 'sql201.infinityfree.com';
// $user = 'if0_36149439';
// $pass = 'QVvrnjOZVgV0';
// $database = 'if0_36149439_benz_online';

//////////////////ON HOSTING 000////////////////////
$host = 'localhost';
$user = 'id21987958_preecha';
$pass = '03@2024Pcm';
$database = 'id21987958_benz_online';

//////////////////ON TESTING////////////////////
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $database = 'benz_online';

$conn = new mysqli($host, $user, $pass, $database);
if($conn->connect_error){
    die($conn->connect_error);
}else{
    mysqli_set_charset($conn,"utf8");
}