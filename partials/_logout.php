<?php

session_start();

echo "Logging you out please wait!!!";

session_destroy();
header("location: /php/forum/index.php");
exit();

?>