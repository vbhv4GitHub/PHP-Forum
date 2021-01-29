<?php

$login = null;
$message = null;

include '_dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * from `users` where `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($result);

    if($numRows == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['sno'];
            header("location: /php/forum/index.php");
            exit();
        }
        else{
            $login = false;
            $message = "Incorrect password.";
            header("location: /php/forum/index.php?login=false&message=$message");
            exit();
        }
    }
    else{
        $login = false;
        $message = "Username not found.";
        header("location: /php/forum/index.php?login=false&message=$message");
        exit();
    }    
}
header("location: /php/forum/index.php");

?>