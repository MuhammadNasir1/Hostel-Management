<?php
include("../includes/dbconn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email  = $_POST['email'];
    $password  = md5($_POST['password']);

    $emailCheckSql = "SELECT * FROM `users` WHERE email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckSql);

    if (mysqli_num_rows($emailCheckResult) > 0) {
        $passwordCheckSql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
        $passwordCheckResult = mysqli_query($conn, $passwordCheckSql);

        if (mysqli_num_rows($passwordCheckResult) == 1) {
            $row = mysqli_fetch_assoc($passwordCheckResult);
            $_SESSION['login'] =  true;
            $_SESSION['user_id'] =  $row['user_id'];
            $_SESSION['user_name'] =  $row['user_name'];
            $_SESSION['email'] =  $row['email'];
            $_SESSION['role'] =  $row['role'];
            $_SESSION['user_image'] =  $row['user_image'];
            echo "success";
        } else {
            echo "<p style='color:#f44336;'>Invalid Password</p>";
        }
    } else {
        echo "<p style='color:#f44336;'>Invalid Email</p>";
    }
}
