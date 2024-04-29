<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "STUDENT";
include("./includes/header.php");


if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $contact_no = $_POST['contact_no'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_no = $_POST['parent_no'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $status = $_POST['status'];
    $address = $_POST['address'];

    $insert = "INSERT INTO `students`(`name`, `roll_no`, `father_name`, `mother_name`, `contact_no`, `date_of_birth`, `parent_no`, `course`, `gender`, `blood_group`, `status`, `address`) VALUES ('$name','$roll_no','$father_name','$mother_name','$contact_no','$date_of_birth','$parent_no','$course','$gender','$blood_group','$status','$address')";
    $query = mysqli_query($conn, $insert);

    if ($query) {
        echo 'Data Added';

        header('location: student.php');
    } else {
        echo 'Data Not Added';
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
$res = mysqli_query($conn, $course);

if (isset($_REQUEST['edit'])) {

?>

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
                    <th>Sno.</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Gender</th>
                    <th>Dob</th>
                    <th>Status</th>
                    <th>Action</th>
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
                        <td><?= $row['father_name'] ?></td>
                        <td><?= $row['course'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['date_of_birth'] ?></td>
                        <td><?= $row['status'] ?></td>
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
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">

                        <form action="#" method="post" class="form">
                            <input type="text" name="updateID" value="<?= $updateData['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <label for="name" class="form-label text-primary">Name</label>
                                    <input type="text" placeholder="Enter Name" required name="name" id="name" class="form-control">
                                </div>
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="roll_no" class="form-label text-primary">Roll No</label>
                                    <input type="number" min="0" placeholder="Enter Roll No" required name="roll_no" id="roll_no" class="form-control">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="father_name" class="form-label text-primary">Father Name</label>
                                    <input type="text" placeholder="Enter Father Name" required name="father_name" id="father_name" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3 ">
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="mother_name" class="form-label text-primary">Mother Name</label>
                                    <input type="text" placeholder="Enter Mother Name" required name="mother_name" id="mother_name" class="form-control">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="contact_no" class="form-label text-primary">Contact No</label>
                                    <input type="number" min="0" placeholder="Enter Contact No" required name="contact_no" id="contact_no" class="form-control">
                                </div>
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="date_of_birth" class="form-label text-primary">Date Of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" required class="form-control">
                                </div>
                            </div>


                            <div class="row mt-3 ">
                                <div class="col-md-4 col-12">
                                    <label for="parent_no" class="form-label text-primary">Parent No</label>
                                    <input type="number" min="0" required placeholder="Enter Parent No" name="parent_no" id="parent_no" class="form-control">
                                </div>
                                <div class="col-md-4 col-12 mt-md-0 mt-3">
                                    <label for="course" class="form-label text-primary">Course</label>
                                    <select class="form-select" required name="course" id="course" aria-label="Default select example">
                                        <option selected>Select Course</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?= $row['course_name'] ?>"><?= $row['course_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="gender" class="form-label text-primary">Gender</label>
                                    <select class="form-select" name="gender" required id="gender" aria-label="Default select example">
                                        <option selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="others">others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3 ">

                                <div class="col-md-6 col-12 mt-md-0 mt-3">
                                    <label for="blood_group" class="form-label text-primary">Blood Group</label>
                                    <select class="form-select" required name="blood_group" id="blood_group" aria-label="Default select example">
                                        <option selected>Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mt-md-0 mt-3">
                                    <label for="status" class="form-label text-primary">Status</label>
                                    <select class="form-select" required name="status" id="status" aria-label="Default select example">
                                        <option selected>Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                                <div class="row mt-3 pe-0">
                                    <div class="col-12 pe-0">
                                        <label for="address" class="form-label text-primary">Address</label>
                                        <textarea placeholder="Enter Your Address" required name="address" id="address" rows="3" class="form-control"></textarea>
                                    </div>
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
<script>
    $('#exampleModal').modal('show');
</script>