<?php
$server_name = "localhost";
$username  = "root";
$password = "";
$database = "hostal_management";
$conn = mysqli_connect($server_name, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "" . mysqli_connect_error();
}
