<?php

include '_dbconnect.php';
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/php/forum/index.php">PHP Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/php/forum/index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                // Block that will generate list of categories on dropdown of navbar.
                $sql = "Select * from `categories`";
                $result = mysqli_query($conn, $sql);

                while($row=mysqli_fetch_assoc($result)){
                    $catName = $row['category_name'];
                    $catID = $row['category_id'];
                    echo    '<li><a class="dropdown-item" href="/php/forum/threadlist.php?catid='. $catID .'">'. $catName .'</a></li>';
                }
                echo '</ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/php/forum/about.php" tabindex="-1">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/php/forum/contact.php" tabindex="-1">Contact</a>
            </li>
        </ul>
        
        <form class="d-flex" action="/php/forum/search.php" action="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div><p class="text-light mx-2 my-0"> Welcome '. $_SESSION['username'] . ' </p></div>
            <div class="mx-2">            
            <a class="btn btn-outline-success" href="/php/forum/partials/_logout.php">Logout</a>
            </div>
            </div>
            </div>
            </nav>';
        }
        else{
            echo '<div class="mx-2">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal"> Login </button>
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal"> SignUp </button>
            </div>
            </div>
            </div>
            </nav>';
        }
            
include '_loginModal.php';
include '_signupModal.php';


// The line of code will generate alert during signup process.
if((isset($_GET['signup']))){
    if($_GET['signup']=="true"){
    $alertType = $_GET['alertType'];
    $message = $_GET['message'];
    echo '<div class="alert alert-'. $alertType . ' alert-dismissible fade show my-0" role="alert">
            <strong> '. $message .' </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </button>
         </div>';
    }
    else{
    $alertType = $_GET['alertType'];
    $message = $_GET['message'];
    echo '<div class="alert alert-'. $alertType . ' alert-dismissible fade show my-0" role="alert">
            <strong> '. $message .' </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </button> 
        </div>';
    }
}

// The line of code will generate alert during login process if there's invalid login credentials.
if((isset($_GET['login'])) && $_GET['login'] == "false" ){
    $message = $_GET['message'];
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong> '. $message .' </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </button>
         </div>';
}
?>
