<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Setting";




include("./includes/header.php");

?>
<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">Setting</h4>
    <div class=" shadow p-4 rounded-1">

        <div class="d-flex justify-content-center">
            <div class="setting-img-con rounded-circle border position-relative">
                <button class="bg-primary text-white rounded-circle px-2 py-1 position-absolute bottom-0 "><i class="fa-regular fa-pen-to-square"></i></button>
                <input id="user_image" type="file" class="position-absolute h-100 w-100 opacity-0  ">
                <img id="img_view" class="h-100 w-100 rounded-circle object-fit-contain" src="./img/Logo.png" alt="User">
            </div>
        </div>
        <div class="mt-5">
            <div class="row">
                <div class="col-md-6">
                    <label for="userName" class="form-label text-primary">User Name</label>
                    <input type="text" name="user_name" placeholder="Enter User Name" id="userName" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="phoneNumber" class="form-label text-primary">Phone Number</label>
                    <input type="text" name="phone_no" placeholder="Enter Phone Number" id="phoneNumber" class="form-control">
                </div>
                <div class="col-12 mt-4">
                    <label for="phoneNumber" class="form-label text-primary">Address</label>
                    <textarea name="" id="" class="form-control" placeholder="Enter Address"></textarea>
                </div>
                <div class="col-md-4 mt-4 ">
                    <label for="oldPassword" class="form-label text-primary">Old Password</label>
                    <input type="password" name="old_password" placeholder="Enter old password" id="oldPassword" class="form-control">
                </div>
                <div class="col-md-4 mt-4">
                    <label for="newPassword" class="form-label text-primary">New Password</label>
                    <input type="password" name="new_password" placeholder="Enter new password" id="newPassword" class="form-control">
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
</script>
<?php
include("./includes/footer.php")
?>