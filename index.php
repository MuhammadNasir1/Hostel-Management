<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Dashboard";
include("./includes/header.php");

function fetchDataAndCount($conn, $table)
{
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    return ($count < 10) ? "0$count" : "$count";
}

// Students Data
$studentsCount = fetchDataAndCount($conn, 'students');

// Rooms Data
$roomsCount = fetchDataAndCount($conn, 'rooms');

// Employes Data
$employesCount = fetchDataAndCount($conn, 'employes');

$sql_total_beds = "SELECT SUM(no_of_beds) as total_beds FROM rooms";
$result_total_beds = $conn->query($sql_total_beds);

if ($result_total_beds->num_rows > 0) {
    $row_total_beds = $result_total_beds->fetch_assoc();
    $total_beds = $row_total_beds['total_beds'];
} else {
    $total_beds = 0;
}

// Fetch the total number of booked beds across all rooms
$sql_booked_beds = "SELECT COUNT(*) as booked_beds FROM room_registration";
$result_booked_beds = $conn->query($sql_booked_beds);

if ($result_booked_beds->num_rows > 0) {
    $row_booked_beds = $result_booked_beds->fetch_assoc();
    $booked_beds = $row_booked_beds['booked_beds'];
} else {
    $booked_beds = 0;
}

// $conn->close();
?>

<div class="dashboard-heading">
    <h4 class="text-primary fw-semibold">Dashboard</h4>
</div>
<div class="row row-cols-1 row-cols-xxl-4  row-cols-lg-2 g-3 mt-2 dashboard ">
    <div class="col">
        <div class="card text-white rounded-3 py-3 px-5" style="background-color: #1a759f;">
            <div class="d-flex gap-2 justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Students</p>
                    <h2 class="h2 font-weight-semibold mt-1"><?= $studentsCount ?></h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card text-white  rounded-3he py-3 px-5" style="background-color: #ffba08;">
            <div class="d-flex gap-2 justify-content-between align-items-center ">
                <div>
                    <p class="mb-1">Total Rooms</p>
                    <h2 class="h2 font-weight-semibold "><?= $roomsCount ?></h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-bed-pulse"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white  rounded-3he py-3 px-5" style="background-color: #067928;">
            <div class="d-flex gap-2 justify-content-between align-items-center ">
                <div>
                    <p class="mb-1">Total Beds </p>
                    <h2 class="h2 font-weight-semibold "><?= $total_beds ?></h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-bed"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white  rounded-3he py-3 px-5" style="background-color: #796406;">
            <div class="d-flex gap-2 justify-content-between align-items-center ">
                <div>
                    <p class="mb-1">Booked Beds </p>
                    <h2 class="h2 font-weight-semibold "><?= $booked_beds ?></h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-bed-pulse"></i>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($_SESSION['role'] !== "student") {
    ?>
        <div class="col">
            <div class="card text-white rounded-3 py-3 px-5" style="background-color: #1b4332;">
                <div class="d-flex gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">Total Employes</p>
                        <h2 class="h2 font-weight-semibold mt-1"><?= $employesCount ?></h2>
                    </div>
                    <div class="ms-auto">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- <div class="col">
        <div class="card text-white rounded-3 py-3 px-5" style="background-color: #bc3908;">
            <div class="d-flex gap-2 justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Revenue</p>
                    <h2 class="h2 font-weight-semibold mt-1">10</h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
        </div>
    </div> -->
</div>
<?php
if ($_SESSION['role'] == "student") {
    $userId =  $_SESSION['user_id'];
?>
    <div>
        <table class="table table-responsive mt-5" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Student Name</th>
                    <th class="bg-primary text-white">Roll No</th>
                    <th class="bg-primary text-white">Joining Date (month start from)</th>
                    <th class="bg-primary text-white">Fee per Month</th>
                    <th class="bg-primary text-white">Fee Type (this month)</th>

                </tr>
            </thead>
            <tbody>
                <?php

                $reg_res = mysqli_query($conn, "SELECT * FROM `room_registration` WHERE student_id =  $userId ");
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

                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>

<?php
}
?>