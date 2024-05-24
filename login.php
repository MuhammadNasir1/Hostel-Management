<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logins - Aghosh</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./img/Logo-white.png" type="image/x-icon">
</head>

<body>

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
                <form id="loginForm" method="POST" class="form d-flex flex-column justify-content-center gap-2">
                    <h2 class="text-center fw-bold">LOGIN</h2>
                    <div class="mt-2">
                        <input id="email" type="email" placeholder="Email" name="email" class="form-control" required />
                    </div>
                    <div class="mt-2">
                        <input id="password" type="password" placeholder="Password" name="password" class="form-control" required />
                    </div>
                    <div class="text-center " id="errorMessage"> </div>
                    <input type="submit" value="Log In" class="mt-2 py-2" />
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(e) {
                e.preventDefault();

                var email = $("#email").val();
                var password = $("#password").val();
                $.ajax({
                    url: './phpAction/login.php',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "./index.php";
                        } else {
                            $("#errorMessage").html(response);
                        }
                    },
                    error: function() {
                        alert("An error occurred");
                    }
                });
            });
        });
    </script>
</body>

</html>