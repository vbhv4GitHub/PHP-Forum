<?php

include '_dbconnect.php';
$userExists = false;
$passwordMatch = true;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$username = $_POST['signupEmail'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

//  Check whether username exists already.

$existSql = "Select * from `users` where username = '$username'";
$result = mysqli_query($conn, $existSql);
$numRows = mysqli_num_rows($result);

if($numRows > 0){
    $userExists = true;
    $message = "Email already exists.";
    $alertType = "danger";
    header("location: /php/forum/index.php?signup=false&message=$message&alertType=$alertType");
    exit();
}
else{    
    // Check whether password match or not.
    if($password == $cpassword){
        $passwordMatch = true;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        //After everything is alright we store the user login credential into database.
        $sql = "insert into `users` (`username`,`password`) values ('$username','$hash')";
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $message = "Account created successfuly.";
            $alertType = "success";
            header("location: /php/forum/index.php?signup=true&message=$message&alertType=$alertType");
            exit();
        }
        else{
            $message = "Some unknown error occured. Try again after some time.";
            $alertType = "danger"; 
            header("location: /php/forum/index.php?signup=false&message=$message&alertType=$alertType");
            exit();
        }
    }
    else{
        $passwordMatch = false;
        $alertType = "danger";
        $message = "Passwords don't match.";
        header("location: /php/forum/index.php?signup=false&message=$message&alertType=$alertType");
        exit();
    }

    }
}
?>