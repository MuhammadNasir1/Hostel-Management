<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - Hostel Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./DataTables/datatables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

  <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="text-white">HMS</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
      </div>

      <ul class="list-unstyled px-2">
        <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Fees</a></li>
        <li class=""><a href="./student.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Students</a></li>
        <li class=""><a href="./course.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-envelope-open-text"></i> Courses</a></li>
        <li class=""><a href="./rooms.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
            Rooms</a></li>
      </ul>
      <hr class="h-color mx-2">

      <ul class="list-unstyled px-2">
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bars"></i>
            Settings</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bell"></i>
            Notifications</a></li>

      </ul>

    </div>
    <div class="content">
      <div class="dashboard-content px-3 pt-4">