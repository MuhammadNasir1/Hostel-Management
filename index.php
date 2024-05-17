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
?>

<div class="dashboard-heading">
    <h1>Dashboard</h1>
</div>
<div class="row row-cols-1 row-cols-md-4 g-3 mt-2 dashboard">
    <div class="col">
        <div class="card text-white rounded-3 py-3 px-5" style="background-color: #1a759f;">
            <div class="d-flex gap-2 justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Orders</p>
                    <h2 class="h2 font-weight-semibold mt-1"><?= $studentsCount ?></h2>
                </div>
                <div class="ms-auto">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card text-white  rounded-3 py-3 px-5" style="background-color: #ffba08;">
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

    <div class="col">
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
    </div>
</div>