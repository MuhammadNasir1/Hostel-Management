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

<div class="container dashboard-heading">
    <h1>Dashboard</h1>
</div>
<div class="container d-flex justify-content-center gap-5 dashboard flex-wrap">
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Students</div>
            <div class="number"><?= $studentsCount ?></div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Rooms</div>
            <div class="number"><?= $roomsCount ?></div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-bed-pulse"></i>
        </div>
    </div>
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Employes</div>
            <div class="number"><?= $employesCount ?></div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-users-line"></i>
        </div>
    </div>
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Revenue</div>
            <div class="number">03</div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-sack-dollar"></i>
        </div>
    </div>
</div>


<?php
include("./includes/footer.php")
?>