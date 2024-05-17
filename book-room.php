<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Rooms";
include("./includes/header.php");


if (isset($_POST['submit'])) {
    $id = $_POST['updateID'];
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];
    $join_date = $_POST['join_date'];
    $end_date = $_POST['end_date'];
    $food_type = $_POST['food_type'];
    $beverage_type = $_POST['beverage_type'];
    $status = $_POST['status'];


    if (empty($id)) {
        $insert = "INSERT INTO `room_registration`(`student_id`, `room_id`, `join_date`, `end_date`, `food_type`, `beverage_type`, `status`) VALUES ('0','0','$join_date','$end_date','$food_type','$beverage_type','$status')";
        $query = mysqli_query($conn, $insert);
        if ($insert) {
            header('location: book-room.php');
        }
    } else {
        $update = "UPDATE `room_registration` SET `student_id`='0',`room_id`='0',`join_date`='$join_date',`end_date`='$end_date',`food_type`='$food_type',`beverage_type`='$beverage_type',`status`='$status' WHERE id = $id";
        $updateQuery = mysqli_query($conn, $update);
        if ($updateQuery) {
            header('location: book-room.php');
        }
    }
}


$get_data = "SELECT * FROM `room_registration`";
$result = mysqli_query($conn, $get_data);

$student_data = "SELECT * FROM `students`";
$res = mysqli_query($conn, $student_data);

$rooms_data = "SELECT * FROM `rooms`";
$re = mysqli_query($conn, $rooms_data);


if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `room_registration` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: book-room.php');
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
    $sql = "SELECT * FROM `room_registration` WHERE id = $id";
    $resu = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($resu);
}


?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Rooms</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Rooms List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Register Room</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Join Date</th>
                    <th class="bg-primary text-white">End Date</th>
                    <th class="bg-primary text-white">Food Type</th>
                    <th class="bg-primary text-white">Beverage Type</th>
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
                        <td><?= $row['join_date'] ?></td>
                        <td><?= $row['end_date'] ?></td>
                        <td><?= $row['food_type'] ?></td>
                        <td><?= $row['beverage_type'] ?></td>
                        <td>
                            <a href="room_registration.php?edit=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Edit</button></a>
                            <a href="room_registration.php?del=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Delete</button></a>
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
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Room Registration</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="student_id" class="form-label">Student</label>
                                <select name="student_id" id="student_id" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <option <?= (@$updateData['student_id'] == $row['name']) ? 'selected' : ''; ?> value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-3">
                                <label for="room_id" class="form-label">Room</label>
                                <select name="room_id" id="room_id" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($re)) {
                                    ?>
                                        <option <?= (@$updateData['room_id'] == $row['room_no']) ? 'selected' : ''; ?> value="<?= $row['room_no'] ?>"><?= $row['room_no'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="join_date" class="form-label">Join Date</label>
                                <input type="date" name="join_date" id="join_date" class="form-control" value="<?= @$updateData['join_date'] ?>">
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="<?= @$updateData['end_date'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="food_type" class="form-label">Food Type</label>
                                <select name="food_type" id="food_type" class="form-select">
                                    <option <?= (@$updateData['food_type'] == 'With Food') ? 'selected' : ''; ?> value="With Food">With Food</option>
                                    <option <?= (@$updateData['food_type'] == 'Without Food') ? 'selected' : ''; ?> value="Without Food">Without Food</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-3">
                                <label for="beverage_type" class="form-label">Beverage Type</label>
                                <input type="text" name="beverage_type" id="beverage_type" class="form-control" value="<?= @$updateData['beverage_type'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option <?= (@$updateData['status'] == 'Active') ? 'selected' : ''; ?> value="Active">Active</option>
                                    <option <?= (@$updateData['status'] == 'InActive') ? 'selected' : ''; ?> value="InActive">InActive</option>
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