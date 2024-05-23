<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logins</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    <div class="container login-page d-flex justify-content-center align-items-center">

        <div class="form-container d-flex">
            <div class="part-1 text-white d-flex justify-content-center align-items-center flex-column">
                <h3>Hello</h3>
                <h1 class="fw-bold">Welcome!</h1>
            </div>
            <div class="part-2 d-flex justify-content-center align-items-center flex-column ">
                <div>
                    <img src="./img/Logo.png" alt="logo">
                </div>
                <form action="#" method="POST" class="form d-flex flex-column justify-content-center gap-2">
                    <h2 class="text-center fw-bold">LOGIN</h2>
                    <div class="mt-2"><input type="email" placeholder="Email" name="email" class="form-control" /></div>
                    <div class="mt-2"> <input type="password" placeholder="Password" name="password" class="form-control" /></div>
                    <div class="text-center"> <?php
                                                echo @$error;
                                                ?></div>
                    <input type="submit" value="Log In" class="mt-2 py-2" />
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>