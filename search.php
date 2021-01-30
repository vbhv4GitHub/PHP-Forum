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

    $search_query = $_GET['search'];
    $sql = "Select * from threads where match (`thread_title`,`thread_desc`) against ('$search_query')";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    $id=false;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $title = $row['thread_title'];
        $id = $row['thread_id'];
        $description = $row['thread_desc'];

        // Search Results code starts here
        echo '<div class="container my-5">
            <h1>Search result for "'. $title .'"</h1>
            <div class="results">
                <h3 class="py-2"><a href="/php/forum/thread.php?threadid='.$id.'" class="text-decoration-none text-dark"> "' . $title . '" </a></h3>
                <p class="my-2">' . $description . '</p>
            </div>
        </div>';
    }
    
    if($noResult){
        echo '<div class="container my-5">
            <h1>Search result for "'. $_GET['search'] .'"</h1>
            <div class="results">
                <h3 class="py-2"><a href="#" class="text-decoration-none text-dark"> No Result Found </a></h3>
                <p class="my-2"> <ul>
                <li> Make sure you\'ve spelled the query correctly </li>
                <li> Try different keywords. </li>
                <li> Try to use more generalized terms. </li>
                </ul></p>
            </div>
        </div>';
    }
    ?> 

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