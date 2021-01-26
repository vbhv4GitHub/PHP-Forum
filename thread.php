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
        }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $threadTitle; ?> </h1>
            <p class="lead"><?php echo $threadDescription; ?></p>
            <hr class="my-4">
            <p>This forum is for people to have discussions over knoweledgeable topics.</p>
            <p><strong>Posted by: Harrison Ford</strong></p>
        </div>
    </div>
    <div class="container my-5">
        <h2 class="py-2"> Discussions</h2>
        <!-- <?php
        $id = $_GET['catid'];
        $sql = "Select * from `threads` where `thread_category_id`='$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $username = $row['thread_user_id'];
            $description = $row['thread_desc'];
            echo '<div class="media-body my-3">
            <img src="img/userdefault.png" width="55px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"> <a href="/php/forum/thread.php" class="text-dark">' . $title . '</a></h5>
                <p>' . $description . '</p>
            </div>';
        }
        ?> -->
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