<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "movilmad";

$conn  = mysqli_connect($servername,$username , $password, $dbname);

/* check connection */
if (!$conn ) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>