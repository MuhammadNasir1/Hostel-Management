<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Student";
include("./includes/header.php");


if (isset($_POST['save'])) {
    $id = $_POST['updateID'];
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $father_name = $_POST['father_name'];
    $contact_no = $_POST['contact_no'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];
    $stu_email = $_POST['stu_email'];
    $stu_password = md5($_POST['stu_password']);
    $stu_username = $_POST['stu_username'];
    $address = $_POST['address'];



    if (empty($id)) {

        $insert = "INSERT INTO `students`(`name`, `roll_no`, `father_name`, `contact_no`, `course`, `gender`, `stu_email`, `stu_password`, `stu_cpassword`, `address`) VALUES ('$name','$roll_no','$father_name','$contact_no','$course','$gender','$stu_email','$stu_password','$stu_username','$address')";

        $user_insert = "INSERT INTO `users`(`user_name`, `email`, `password`, `role`) VALUES ('$stu_username','$stu_email','$stu_password','Student')";
        $query = mysqli_query($conn, $insert);
        $query2 = mysqli_query($conn, $user_insert);
        if ($query && $query2) {
            echo 'Data Added';

            header('location: student.php');
        }
    } else {
        $update = "UPDATE `students` SET `name`='$name',`roll_no`='$roll_no',`father_name`='$father_name',`contact_no`='$contact_no',`course`='$course',`gender`='$gender',`address`='$address' WHERE id = $id";
        $updateQuery = mysqli_query($conn, $update);
        if ($updateQuery) {
            echo 'Data Added';

            header('location: student.php');
        }
    }
}

if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `students` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: student.php');
    } else {
        echo 'Data Not Added';
    }
}

$get = "SELECT * FROM `students`";
$result = mysqli_query($conn, $get);

$course = "SELECT * FROM `course`";
$re = mysqli_query($conn, $course);

if (isset($_REQUEST['edit'])) {
?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
<?php
    $id = $_REQUEST['edit'];
    $sql = "SELECT * FROM `students` WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($res);
}
?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Students</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Students List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Student</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Student Name</th>
                    <th class="bg-primary text-white">Roll No</th>
                    <th class="bg-primary text-white">Father Name</th>
                    <th class="bg-primary text-white">Course</th>
                    <th class="bg-primary text-white">Gender</th>
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
                        <td><?= $row['name'] ?> </td>
                        <td><?= $row['roll_no'] ?></td>
                        <td><?= $row['father_name'] ?></td>
                        <td><?= $row['course'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td>
                            <a href="student.php?edit=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Edit</button></a>
                            <a href="student.php?del=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Delete</button></a>
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
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Student</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">

                        <form action="#" method="post" class="form">
                            <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <label for="name" class="form-label text-primary">Name</label>
                                    <input type="text" placeholder="Enter Name" required name="name" id="name" class="form-control" value="<?= @$updateData['name'] ?>">
                                </div>
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="roll_no" class="form-label text-primary">Roll No</label>
                                    <input type="number" min="0" placeholder="Enter Roll No" required name="roll_no" id="roll_no" class="form-control" value="<?= @$updateData['roll_no'] ?>">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="father_name" class="form-label text-primary">Father Name</label>
                                    <input type="text" placeholder="Enter Father Name" required name="father_name" id="father_name" class="form-control" value="<?= @$updateData['father_name'] ?>">
                                </div>
                            </div>

                            <div class="row mt-3 ">

                                <div class="col-md-4 col-12">
                                    <label for="contact_no" class="form-label text-primary">Contact No</label>
                                    <input type="number" min="0" placeholder="Enter Contact No" required name="contact_no" id="contact_no" class="form-control" value="<?= @$updateData['contact_no'] ?>">
                                </div>
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="course" class="form-label text-primary">Course</label>
                                    <select class="form-select" required name="course" id="course" aria-label="Default select example">
                                        <option selected>Select Course</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($re)) {
                                        ?>
                                            <option <?= (@$updateData['course'] == $row['course_name']) ? 'selected' : ''; ?> value="<?= $row['course_name'] ?>"><?= $row['course_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="gender" class="form-label text-primary">Gender</label>
                                    <select class="form-select" name="gender" required id="gender" aria-label="Default select example">
                                        <option>Select Gender</option>
                                        <option <?= (@$updateData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option <?= (@$updateData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                        <option <?= (@$updateData['gender'] == 'others') ? 'selected' : ''; ?>>others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 ">
                                <div class="row  pe-0">
                                    <div class="col-12 pe-0">
                                        <label for="address" class="form-label text-primary">Address</label>
                                        <textarea placeholder="Enter Your Address" required name="address" id="address" rows="3" class="form-control"><?= @$updateData['address'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3 <?php if ($id) { ?> d-none <?php } ?> ">
                                <h1 class="modal-title fs-5 fw-bold">Login Credentials</h1>

                                <div class="col-lg-4 ">
                                    <label for="stu_username" class="form-label text-primary">Username</label>
                                    <input type="text" name="stu_username" placeholder="Enter Username" id="stu_username" class="form-control">
                                </div>

                                <div class="col-lg-4 mt-lg-0 mt-3">
                                    <label for="stu_email" class="form-label text-primary">Email</label>
                                    <input type="email" name="stu_email" placeholder="Enter Email Address" id="stu_email" class="form-control" value="<?= @$updateData['emp_email'] ?>">
                                </div>
                                <div class="col-lg-4 mt-lg-0 mt-3">
                                    <label for="stu_password" class="form-label text-primary">Login Password</label>
                                    <input type="password" name="stu_password" placeholder="Enter Login Password" id="stu_password" class="form-control">
                                </div>



                            </div>



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="save" class="btn bg-primary text-white px-3 py-2 fw-semibold">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php")
?>