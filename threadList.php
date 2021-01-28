<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    $id = $_GET['catid'];
    $sql = "Select * from `categories` where `category_id`='$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    // This php block is to add data to database from our submit topic form.
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // Insert the topic details in your Database
        $thTitle = $_POST['threadTitle'];
        $thDescription = $_POST['threadDescription'];
        $thUserID = 0;
        // todo: need to fix sql query generating error. probably need to make all text to varchar.
        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_user_id`, `thread_category_id`, `tstamp`) VALUES (NULL, '$thTitle', '$thDescription', '0', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your topic has been added to the forum successfully. Please wait for communit to respond to your topic.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> ERROR:</strong> Your topic couldn\'t be added to forum. We apologize for inconvinience.'. mysqli_error($conn) .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } 
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This forum is for people to have discussions over knoweledgeable topics.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
        <div class="container">
        <h2 class="py-2"> Start a discussion</h2>
        <form class="my-5" action="<?php $_SERVER['REQUEST_URI'];?>" method="POST">
        <!-- $_SERVER['REQUEST_URI'] & $_SERVER['PHP_SELF'] are often used to redirect a form to the same page, but request URI method submits along with the get parameters, where as PHP self method submits a form with get parameters if there's any previous parameters you've provided to that particular page.-->
            <div class="form-group">
                <label for="threadTitle"> Title</label>
                <input type="text" class="form-control" id="threadTitle" name="threadTitle" aria-describedby="threadTitle">
                <small id="threadTitle1" class="form-text text-muted">Keep your title as crisp as possible.</small>
            </div>
            <div class="form-group">
                <label for="threadDescription">Description</label>
                <textarea class="form-control" id="threadDescription" name="threadDescription" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-3">Post</button>
        </form>
        </div>

    <div class="container my-5">
        <h2 class="py-2"> Browse topics</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "Select * from `threads` where `thread_category_id`='$id'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $username = $row['thread_user_id'];
            $description = $row['thread_desc'];
            $time = $row['tstamp'];
            echo '<div class="media-body my-3">
            <img src="img/userdefault.png" width="55px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark" href="/php/forum/thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                <p>' . $description . '</p>
                <p class="my-0"><strong> Anonymous User </strong>'. $time .' </p>
            </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No Topics Were Found.</p>
                    <p class="lead">Be the first one to start a topic.</p>
                    </div>
                </div>';
        }
        ?>
        
    </div>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>