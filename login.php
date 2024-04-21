<?php
include("./includes/dbconn.php");
$title = "Login";
include("./includes/header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email  = $_POST['email'];
    $password  = md5($_POST['password']);
    $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        header("Location: index.php");
    } else {
        $error = " <p class='text-danger'>Invalid Email and Password</p>";
    }
}

?>
<form action="#" class="login" method="POST">
    <h2>Welcome, User!</h2>
    <p>Please log in</p>
    <input type="email" placeholder="Email" name="email" />
    <input type="password" placeholder="Password" name="password" />
    <?php
    echo @$error;
    ?>
    <input type="submit" value="Log In" />

    <?php
    include("./includes/footer.php")
    ?>