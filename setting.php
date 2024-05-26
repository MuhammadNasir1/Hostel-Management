<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Setting";
$userId =  $_SESSION['user_id'];
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = $userId");
$data = mysqli_fetch_assoc($res);

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $con_password = $_POST['con_password'];
    $user_image = $_FILES['user_image']['name'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
    $user = mysqli_fetch_assoc($result);

    $update_query = "UPDATE users SET user_name = '$username', email = '$email'";
    if (!empty($old_password && !empty($new_password) && $new_password === $con_password)) {

        if (md5($old_password) == $user['password']) {
            $hashed_password = md5($new_password);
            $update_query .= ", password = '$hashed_password'";
        } else {
            $eror = "Incorrect old password";
        }
    }
    // Update user image if provided
    if (!empty($user_image)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($user_image);
        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file)) {
            $update_query .= ", user_image = '$target_file'";
            $_SESSION['user_image']  = $target_file;
        }
    }

    // Complete the query with the WHERE clause
    $update_query .= " WHERE user_id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['user_name'] =  $username;
        $_SESSION['email'] =  $email;
        header('location: ./setting.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $conn->close();
}




include("./includes/header.php");
$userImage = isset($_SESSION['user_image']) && !empty($_SESSION['user_image']) ? $_SESSION['user_image'] : 'img/Logo.png';
?>
<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">Setting</h4>
    <div class=" shadow p-4 rounded-1">

        <form action="#" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <div class="setting-img-con rounded-circle border position-relative">
                    <button class="bg-primary text-white rounded-circle px-2 py-1 position-absolute bottom-0 "><i class="fa-regular fa-pen-to-square"></i></button>
                    <input id="user_image" type="file" name="user_image" class="position-absolute h-100 w-100 opacity-0  ">
                    <img id="img_view" class="h-100 w-100 rounded-circle object-fit-contain" src="./<?= $userImage ?>" alt="User">
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <label for="userName" class="form-label text-primary">User Name</label>
                        <input type="text" name="user_name" placeholder="Enter User Name" id="userName" class="form-control" value="<?= $data['user_name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label text-primary">Email</label>
                        <input type="email" name="email" placeholder="Enter new email " id="email" class="form-control" value="<?= $data['email'] ?>">
                    </div>
                    <div class="col-md-4 mt-4 ">
                        <label for="oldPassword" class="form-label text-primary">Old Password</label>
                        <input type="password" name="old_password" placeholder="Enter old password" id="oldPassword" class="form-control">
                        <p class="text-danger"><?= @$eror ?></p>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="password" class="form-label text-primary">New Password</label>
                        <input type="password" name="new_password" placeholder="Enter new password" id="password" class="form-control">
                        <div id="message" class="invalid">Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>

                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="conPassword" class="form-label text-primary">Confirm Password</label>
                        <input type="password" name="con_password" placeholder="Enter confirm password" id="conPassword" class="form-control">
                    </div>
                    <div class="mt-5 d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn bg-primary text-white px-3 py-2 fw-semibold">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    let fileInput = document.getElementById('user_image');
    let imageView = document.getElementById('img_view');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        const reader = new FileReader();
        console.log(reader);
        reader.onload = function() {
            imageView.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    function validatePassword(password) {
        const minLength = 8;
        const hasUpperCase = /[A-Z]/;
        const hasLowerCase = /[a-z]/;
        const hasNumber = /[0-9]/;
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

        if (password.length < minLength) {
            return {
                valid: false,
                message: "Password must be at least 8 characters long."
            };
        }
        if (!hasUpperCase.test(password)) {
            return {
                valid: false,
                message: "Password must contain at least one uppercase letter."
            };
        }
        if (!hasLowerCase.test(password)) {
            return {
                valid: false,
                message: "Password must contain at least one lowercase letter."
            };
        }
        if (!hasNumber.test(password)) {
            return {
                valid: false,
                message: "Password must contain at least one number."
            };
        }
        if (!hasSpecialChar.test(password)) {
            return {
                valid: false,
                message: "Password must contain at least one special character."
            };
        }

        return {
            valid: true,
            message: "Password is strong."
        };
    }

    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const result = validatePassword(password);
        const messageDiv = document.getElementById('message');

        if (result.valid) {
            messageDiv.textContent = result.message;
            messageDiv.className = 'valid';
        } else {
            messageDiv.textContent = result.message;
            messageDiv.className = 'invalid';
        }
    });
</script>
<?php
include("./includes/footer.php")
?>