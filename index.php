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
    <?php include 'partials/_carousel.php'; ?>

    <!-- Categories Cards -->
    <div class="container my-5">
        <h2 class="text-center my-4">Welcome to PHP Forum</h2>
        <div class="row">
            
            <?php
            // Fetching all the categories

            $sql = "Select * from `categories`";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){ // Loop to iterate all of our categories on front end.
                $category_ID = $row['category_id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];
                echo '<div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/500x500/?' . $category_name . ',coding" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/php/forum/threadList.php?catid='. $category_ID .' style="text-decoration: none;" ">' . $category_name . '</a></h5>
                                    <p class="card-text">' . substr($category_description, 0, 155) .'...</p>
                                    <!--  Using substring function to trim description. -->
                                    <a href="/php/forum/threadList.php?catid='. $category_ID .'" style="text-decoration: none;" class="btn btn-primary">View Threads</a>
                                </div>
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