<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Book Room";

if (isset($_POST['submit'])) {
    $id = $_POST['updateID'];
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];
    $join_date = $_POST['join_date'];
    $fee_pay_date = $_POST['fee_pay_date'];
    $food_type = $_POST['food_type'];
    $total_fee = $_POST['total_fee'];


    if (empty($id)) {
        $insert = "INSERT INTO `room_registration`(`student_id`, `room_id`, `join_date`, `fee_pay_date`, `food_type`, `total_fee`) VALUES ('$student_id','$room_id','$join_date','$fee_pay_date','$food_type','$total_fee')";
        $query = mysqli_query($conn, $insert);
        if ($insert) {
            header('location: book-room.php');
        }
    } else {
        $update = "UPDATE `room_registration` SET `student_id`='$student_id',`room_id`='$room_id',`join_date`='$join_date',`fee_pay_date`='$fee_pay_date',`food_type`='$food_type',`total_fee`='$total_fee' WHERE id = $id";
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
    }
}
include("./includes/header.php");
if (@isset($_REQUEST['edit'])) {
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
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span>+</span> Register Room</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Join Date</th>
                    <th class="bg-primary text-white">Fee pay Date</th>
                    <th class="bg-primary text-white">Food Type</th>
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
                        <td><?= $row['fee_pay_date'] ?></td>
                        <td><?= $row['food_type'] ?></td>
                        <td>
                            <a href="book-room.php?edit=<?= $row['id'] ?>"><button class="bg-primary text-white rounded-circle px-2 py-1"><i class="fa-regular fa-pen-to-square"></i></button></a>
                            <a href="book-room.php?del=<?= $row['id'] ?>"><button class="bg-primary text-white rounded-circle px-2 py-1"><i class="fa-solid fa-trash-can"></i></button></a>
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
                                        <option <?= (@$updateData['student_id'] == $row['id']) ? 'selected' : ''; ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-3">
                                <label for="room" class="form-label">Room</label>
                                <select name="room_id" id="room" class="form-select">
                                    <option selected disabled>Select Room</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($re)) :
                                    ?>
                                        <option <?= (@$updateData['room_id'] == $row['id']) ? 'selected' : ''; ?> value="<?= $row['id'] ?>" room-fees="<?= $row['room_fee'] ?>"><?= $row['room_no'] ?></option>
                                    <?php
                                    endwhile;


                                    ?>
                                </select>
                                <p id="availabilityMessage"></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="join_date" class="form-label">Join Date</label>
                                <input type="date" name="join_date" id="join_date" class="form-control" value="<?= @$updateData['join_date'] ?>">
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-3">
                                <label for="fee_pay_date" class="form-label">Fee pay Date </label>
                                <input type="date" name="fee_pay_date" id="fee_pay_date" class="form-control" value="<?= @$updateData['fee_pay_date'] ?>">
                                <div class="form-text text-danger">Pay fees on this date every month</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="food_type" class="form-label">Food Status (Extra 2000Pkr)</label>
                                <select name="food_type" id="food_type" class="form-select">
                                    <option selected disabled>Select Food Status</option>
                                    <option food-price="2000" <?= (@$updateData['food_type'] == 'With Food') ? 'selected' : ''; ?> value="With Food">With Food</option>
                                    <option food-price="0" <?= (@$updateData['food_type'] == 'Without Food') ? 'selected' : ''; ?> value="Without Food">Without Food</option>
                                </select>
                            </div>
                            <div class="col-lg-6 ">
                                <label for="totalFee" class="form-label">Total Fees Per Month (readOnly)</label>
                                <input type="text" name="total_fee" id="totalFee" class="form-control" value="<?= @$updateData['total_fee'] ?>">
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
// if (!isset($_REQUEST['edit'])) {


?>
<script>
    $(document).ready(function() {
        function updateTotalFee() {
            var selectedRoom = $('#room').find('option:selected');
            var roomFee = parseFloat(selectedRoom.attr('room-fees')) || 0;

            var selectedFood = $('#food_type').find('option:selected');
            var foodPrice = parseFloat(selectedFood.attr('food-price')) || 0;

            var totalFee = roomFee + foodPrice;
            $('#totalFee').val(totalFee);
        }

        $('#room, #food_type').change(updateTotalFee);

        updateTotalFee();
    });


    $(document).ready(function() {
        $('#room').change(function() {
            var roomId = $(this).val();
            console.log(roomId);
            if (roomId) {
                $.ajax({
                    url: './phpAction/check_availability.php',
                    type: 'GET',
                    data: {
                        room_id: roomId
                    },
                    success: function(response) {
                        $('#availabilityMessage').html(response);
                    },
                    error: function() {
                        $('#availabilityMessage').html('Error checking room availability.');
                    }
                });
            } else {
                $('#availabilityMessage').html('');
            }
        });
    });
</script>
<?php

// }
?>
<?php
include("./includes/footer.php")
?>