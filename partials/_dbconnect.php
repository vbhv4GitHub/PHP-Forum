<?php

// File to connect database

$server = "localhost";
$user = "root";
$password = "";
$database = "phpforum";

$conn = mysqli_connect($server, $user, $password, $database);

if(!$conn){
    die("Failed to connect with database: ". mysqli_connect_error());
}
else{
    // echo "Connection successful.";
}

?>