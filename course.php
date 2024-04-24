<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Couses";
include("./includes/header.php");


if (isset($_POST['submit'])) {
    $course_name = $_POST['course_name'];
    $no_of_year = $_POST['no_of_year'];
    $course_status = $_POST['course_status'];

    $insert = "INSERT INTO `course`(`course_name`, `no_of_year`, `course_status`) VALUES ('$course_name','$no_of_year','$course_status')";
    $query = mysqli_query($conn, $insert);

    if ($insert) {
        header('location: course.php');
    } else {
        echo "Data Not Added";
    }
}

$get_data = "SELECT * FROM `course`";
$result = mysqli_query($conn, $get_data);

if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `course` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: course.php');
    } else {
        echo 'Data Not Added';
    }
}

?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Courses</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Courses List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Course</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Course Name</th>
                    <th>Year</th>
                    <th>Course Status</th>
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
                        <td><?= $row['course_name'] ?></td>
                        <td><?= $row['no_of_year'] ?></td>
                        <td><?= $row['course_status'] ?></td>
                        <td>
                            <a href="course.php?edit=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Edit</button></a>
                            <a href="course.php?del=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Delete</button></a>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label for="course_name" class="form-label text-primary">Course Name</label>
                                <input type="text" name="course_name" placeholder="Enter Course Name" id="course_name" class="form-control">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="no_of_year" class="form-label text-primary">No Of Year</label>
                                <input type="number" min="1" name="no_of_year" id="no_of_year" placeholder="No Of Year" class="form-control">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="course_status" class="form-label text-primary">Status</label>
                                <select name="course_status" id="course_status" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
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