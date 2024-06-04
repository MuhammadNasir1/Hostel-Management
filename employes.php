<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}
if ($_SESSION['role'] !== "admin") {
    header("Location: login.php");
}

$title = "Rooms";



if (isset($_POST['submit'])) {
    $id = $_POST['updateID'];
    $email_id = $_POST['email_id'];
    $emp_password = md5($_POST['emp_password']);
    $block_id = $_POST['block_id'];
    $emp_type = $_POST['emp_type'];
    $emp_name = $_POST['emp_name'];
    $emp_gender = $_POST['emp_gender'];
    $emp_dob = $_POST['emp_dob'];
    $emp_doj = $_POST['emp_doj'];
    $emp_username = $_POST['emp_username'];

    if (empty($id)) {
        $insert = "INSERT INTO `employes`(`emp_email`, `block_id`, `emp_type`, `emp_name`, `gender`, `date_of_birth`, `date_of_join`) VALUES ('$email_id','$block_id','$emp_type','$emp_name','$emp_gender','$emp_dob','$emp_doj')";

        $user = "INSERT INTO `users`(`user_name`, `email`, `password`, `role`) VALUES ('$emp_username','$email_id','$emp_password','employe')";

        $query = mysqli_query($conn, $user);
        $query = mysqli_query($conn, $insert);
        if ($insert) {
            header('location: employes.php');
        }
        if ($user) {
            header('location: employes.php');
        }
    } else {
        $update = "UPDATE `employes` SET `block_id`='$block_id',`emp_type`='$emp_type',`emp_name`='$emp_name',`gender`='$emp_gender',`date_of_birth`='$emp_dob',`date_of_join`='$emp_doj' WHERE id = $id";
        $updateQuery = mysqli_query($conn, $update);
        if ($updateQuery) {
            header('location: employes.php');
        }
    }
}


$get_data = "SELECT * FROM `employes`";
$result = mysqli_query($conn, $get_data);

$emp_data = "SELECT * FROM `blocks`";
$res = mysqli_query($conn, $emp_data);

$user_data = "SELECT * FROM `users`";
$re = mysqli_query($conn, $user_data);
$fetch = mysqli_fetch_assoc($re);


if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `employes` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: employes.php');
    } else {
        echo 'Data Not Added';
    }
}
include("./includes/header.php");
if (isset($_REQUEST['edit'])) {
?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
<?php
    $id = $_REQUEST['edit'];
    $sql = "SELECT * FROM `employes` WHERE id = $id";
    $resu = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($resu);
}




?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Employes</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Employes List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span>+</span> Add Employe</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Employe Name</th>
                    <th class="bg-primary text-white">Email</th>
                    <th class="bg-primary text-white">Emaploye Type</th>
                    <th class="bg-primary text-white">DOJ</th>
                    <th class="bg-primary text-white">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $a = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $a++;
                ?>
                    <tr>
                        <td><?= $a ?></td>
                        <td><?= $row['emp_name'] ?></td>
                        <td><?= $row['emp_email'] ?></td>
                        <td><?= $row['emp_type'] ?></td>
                        <td><?= $row['date_of_join'] ?></td>
                        <td>
                            <a href="employes.php?edit=<?= $row['id'] ?>"><button class="bg-primary text-white rounded-circle px-2 py-1"><i class="fa-regular fa-pen-to-square"></i></button></a>
                            <a href="employes.php?del=<?= $row['id'] ?>"><button class="bg-primary text-white rounded-circle px-2 py-1"><i class="fa-solid fa-trash-can"></i></button></a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Employe Registration</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">


                        <div class="row mt-3">

                            <div class="col-lg-4">
                                <label for="emp_type" class="form-label text-primary">Employe Type <span class="text-danger">* </span></label>
                                <input type="text" name="emp_type" placeholder="Enter Employe Type" required id="emp_type" class="form-control" value="<?= @$updateData['emp_type'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="emp_name" class="form-label text-primary">Employe Name <span class="text-danger">* </span></label>
                                <input type="text" name="emp_name" required placeholder="Enter Employe Name" id="emp_name" class="form-control" value="<?= @$updateData['emp_name'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="block_id" class="form-label text-primary">contact No <span class="text-danger">* </span></label>
                                <input type="number" name="block_id" required placeholder="Enter Phone Number" id="contact_no" class="form-control" value="<?= @$updateData['emp_name'] ?>">
                                <div id="numbereror" class="invalid"></div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <label for="emp_gender" class="form-label text-primary">Gender <span class="text-danger">* </span></label>
                                <select name="emp_gender" id="emp_gender" class="form-select" required>
                                    <option selected disabled>Select Gender</option>
                                    <option <?= (@$updateData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option <?= (@$updateData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>

                                </select>
                            </div>
                            <div class="col-lg-4  mt-lg-0 mt-3">
                                <label for="emp_dob" class="form-label text-primary">Date Of Birth <span class="text-danger">* </span></label>
                                <input type="date" name="emp_dob" id="emp_dob" class="form-control" value="<?= @$updateData['date_of_birth'] ?>" required>
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="emp_doj" class="form-label text-primary">Date Of Joining <span class="text-danger">* </span></label>
                                <input type="date" name="emp_doj" id="emp_doj" class="form-control" value="<?= @$updateData['date_of_join'] ?>" required>
                            </div>

                        </div>

                        <div class="row mt-3 <?php if ($id) { ?> d-none <?php } ?>">
                            <h1 class="modal-title fs-5 fw-bold">Login Credentials</h1>

                            <div class="col-lg-4 ">
                                <label for="emp_username" class="form-label text-primary">Username <span class="text-danger">* </span></label>
                                <input type="text" name="emp_username" required placeholder="Enter Username" id="emp_username" class="form-control" required>
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="email_id" class="form-label text-primary">Email <span class="text-danger">* </span></label>
                                <input type="email" name="email_id" placeholder="Enter Email Address" id="email_id" class="form-control" value="<?= @$updateData['emp_email'] ?>" required>
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="password" class="form-label text-primary">Login Password <span class="text-danger">* </span></label>
                                <input type="password" name="emp_password" placeholder="Enter Login Password" id="password" class="form-control" required>
                                <div id="message" class="invalid">Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>

                            </div>



                        </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn bg-primary text-white px-3 py-2 fw-semibold">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php")
?>

<script>
    document.getElementById('contact_no').addEventListener('input', function() {
        const minLengtha = 11;
        const data = this.value;
        const numbereror = document.getElementById('numbereror');

        if (data.length < minLengtha) {
            numbereror.innerHTML = "number must be 11 degits";
        } else {
            numbereror.textContent = "";
            numbereror.className = 'invalid';
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