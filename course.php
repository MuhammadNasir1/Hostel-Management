<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Courses";
include("./includes/header.php");


if (isset($_POST['submit'])) {
    $id = $_POST['updateID'];
    $course_name = $_POST['course_name'];
    $no_of_year = $_POST['no_of_year'];
    $course_status = $_POST['course_status'];

    if (empty($id)) {
        $insert = "INSERT INTO `course`(`course_name`, `no_of_year`, `course_status`) VALUES ('$course_name','$no_of_year','$course_status')";
        $query = mysqli_query($conn, $insert);
        if ($insert) {
            header('location: course.php');
        }
    } else {
        $update = "UPDATE `course` SET `course_name`='$course_name',`no_of_year`='$no_of_year',`course_status`='$course_status' WHERE id = $id";
        $updateQuery = mysqli_query($conn, $update);

        if ($updateQuery) {
            header('location: course.php');
        }
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

if (isset($_REQUEST['edit'])) {
?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
<?php
    $id = $_REQUEST['edit'];
    $sql = "SELECT * FROM `course` WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($res);
}

?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Courses</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Courses List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span>+</span> Add Course</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Course Name</th>
                    <th class="bg-primary text-white">Year</th>
                    <th class="bg-primary text-white">Course Status</th>
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
            <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Course</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label for="course_name" class="form-label text-primary">Course Name</label>
                                <input type="text" name="course_name" placeholder="Enter Course Name" id="course_name" class="form-control" value="<?= @$updateData['course_name'] ?>">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="no_of_year" class="form-label text-primary">No Of Year</label>
                                <input type="number" min="1" name="no_of_year" id="no_of_year" placeholder="No Of Year" class="form-control" value="<?= @$updateData['no_of_year'] ?>">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="course_status" class="form-label text-primary">Status</label>
                                <select name="course_status" id="course_status" class="form-select">
                                    <option <?= (@$updateData['course_status'] == 'Active') ? 'selected' : ''; ?> value="Active">Active</option>
                                    <option <?= (@$updateData['course_status'] == 'InActive') ? 'selected' : ''; ?> value="InActive">InActive</option>
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