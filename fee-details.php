<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Fee Details";

if (isset($_POST['submit'])) {
    $updateId = $_POST['updateId'];
    $status = $_POST['fee_status'];
    $result = mysqli_query($conn, "UPDATE room_registration SET fee_status = '$status' WHERE id = $updateId");
    if ($result) {
        header('location: ./fee-details.php');
    }
}
include("./includes/header.php");


?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Students</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Student List</h5>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Student Name</th>
                    <th class="bg-primary text-white">Roll No</th>
                    <th class="bg-primary text-white">Joining Date (month start from)</th>
                    <th class="bg-primary text-white">Fee per Month</th>
                    <th class="bg-primary text-white">Fee Type (this month)</th>
                    <th class="bg-primary text-white">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $reg_res = mysqli_query($conn, "SELECT * FROM `room_registration`");
                $i  = 0;
                while ($data = mysqli_fetch_assoc($reg_res)) :
                    $i++;
                    $student_id = $data['student_id'];

                    // Query to get student data based on student_id
                    $student_res = mysqli_query($conn, "SELECT * FROM `students` WHERE `id` = '$student_id'");
                    $student_data = mysqli_fetch_assoc($student_res);


                    $joinDate = new DateTime($data['fee_pay_date']);
                    $currentDate = new DateTime();
                    $interval = $joinDate->diff($currentDate);

                    // Determine if one month has passed since the join date    
                    $monthsPassed = $interval->m + ($interval->y * 12);
                    if ($monthsPassed >= 1) {
                        // Update the fee status to pending
                        if (@$data['fee_status'] == "pending") {
                            // Update the fee status to 'pending'
                            $feeStatus = 'pending';
                            // Update the database with the new fee status
                            $conn->query("UPDATE room_registration SET fee_status = 'pending' WHERE student_id = $student_id LIMIT 1");
                        } else {

                            $feeStatus = 'paid';
                            $conn->query("UPDATE room_registration SET fee_status = 'pending' WHERE student_id = $student_id LIMIT 1");
                        }
                    }

                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $student_data['name'] ?></td>
                        <td><?= $student_data['roll_no'] ?></td>
                        <td><?= $data['join_date'] ?></td>
                        <td><?= $data['total_fee'] ?></td>
                        <td><button class="btn <?= (isset($data['fee_status']) && $data['fee_status'] == "pending") ? "bg-danger" : "bg-success" ?>
 text-white px-3 py-2 fw-semibold">
                                <span></span> <?= $data['fee_status'] ?></button></< /td>
                        <td> <button userId="<?= $data['id'] ?>" class="btn bg-primary text-white px-3 py-2 fw-semibold statusChangeBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span></span> Change Status</button></td>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Fee Status</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" id="statusUpdateId" name="updateId" value="1">
                        <div class="col-12">
                            <label for="fee_status" class="form-label">Fee Status</label>
                            <select name="fee_status" id="fee_status" class="form-select">
                                <option selected disabled>Select Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn bg-primary text-white px-3 py-2 fw-semibold">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include("./includes/footer.php")
?>

<script>
    $('.statusChangeBtn').click(function() {
        var statusId = $(this).attr('userId');
        $('#statusUpdateId').val(statusId);
    });
</script>