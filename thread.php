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
        $id = $_GET['threadid'];
        $sql = "Select * from `threads` where `thread_id`='$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $threadTitle = $row['thread_title'];
            $threadDescription = $row['thread_desc'];
            $threadTime = $row['tstamp'];
        }
    ?>

<?php
    // This php block is to add data to database from our submit topic form.
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // Insert the topic details in your Database
        $content = $_POST['comment'];
        $userID = 0; // todo: get user ID when user is logged in.
        // todo: need to fix sql query generating error.
        $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, '$content', '$id', '$userID', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added to the topic successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> ERROR:</strong> Your comment couldn\'t be added for some reason. We apologize for the inconvinience.'. mysqli_error($conn) .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } 
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $threadTitle; ?> </h1>
            <p class="lead"><?php echo $threadDescription; ?></p>
            <hr class="my-4">
            <p>This forum is for people to have discussions over knoweledgeable topics.</p>
            <p><strong>Posted by: Harrison Ford </strong><?php echo $threadTime; ?></p>
        </div>
    </div>

    <?php 
    //Start a discussion form
    // start_session();
    if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin']==true){
    echo ' <div class="container">
            <h2 class="py-2"> Add your comment to this topic</h2>
            <form class="my-5" action="' . $_SERVER['REQUEST_URI'] .'" method="POST">
            <div class="form-group">
                <label for="comment">Type your comment here:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-3">Post Comment</button>
            </form>
        </div>';
    }
    else{
        echo '<div class = "container">
            <p class="lead">
                You must be logged in to post a comment on this topic.
            </p>
            </div>';
    }
    ?>

    <div class="container my-5">
        <h2 class="py-2"> Comments</h2>
        
        <?php
        $id = $_GET['threadid'];
        $sql = "Select * from `comments` where `thread_id`='$id'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];

            echo '<div class="media-body my-3">
            <img src="img/userdefault.png" width="55px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="my-0"><strong> Anonymous User </strong>'. $time .' </p>
                <p>' . $content . '</p>
            </div>
            </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No Comments Were Found.</p>
                    <p class="lead">Be the first one to post a comment.</p>
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