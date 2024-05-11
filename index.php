<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Dashboard";
include("./includes/header.php");
?>

<div class="container dashboard-heading">
    <h1>Dashboard</h1>
</div>
<div class="container d-flex justify-content-center gap-5 dashboard flex-wrap">
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Students</div>
            <div class="number">03</div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
    </div>
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Nurses</div>
            <div class="number">03</div>
        </div>
        <div class="mx-auto">
            <i class="fa-solid fa-bed-pulse"></i>
        </div>
    </div>
    <div class="box">
        <div class="d-flex align-items-center flex-column ps-2">
            <div class="card-heading">Total Employes</div>
            <div class="number">03</div>
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