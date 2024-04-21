<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logins</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    include("./includes/dbconn.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email  = $_POST['email'];
        $password  = md5($_POST['password']);
        $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['login'] =  true;
            $_SESSION['email'] =  $row['email'];
            $_SESSION['role'] =  $row['role'];
            header("Location: index.php");
        } else {
            $error = " <p style='color:#f44336;'>Invalid Email and Password</p>";
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

</body>

</html>