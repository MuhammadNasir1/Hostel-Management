<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - Hostel Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./DataTables/datatables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

  <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="text-white ps-3">HMS</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
      </div>

      <ul class="list-unstyled px-2">
        <li class="active"><a href="index.php" class="text-decoration-none p-2 d-flex align-items-center">
            <svg width="24" height="20" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0.5 7.33333C0.5 7.88562 0.947715 8.33333 1.5 8.33333H6.16667C6.71895 8.33333 7.16667 7.88562 7.16667 7.33333V1C7.16667 0.447715 6.71895 0 6.16667 0H1.5C0.947714 0 0.5 0.447715 0.5 1V7.33333ZM0.5 14C0.5 14.5523 0.947715 15 1.5 15H6.16667C6.71895 15 7.16667 14.5523 7.16667 14V11C7.16667 10.4477 6.71895 10 6.16667 10H1.5C0.947714 10 0.5 10.4477 0.5 11V14ZM8.83333 14C8.83333 14.5523 9.28105 15 9.83333 15H14.5C15.0523 15 15.5 14.5523 15.5 14V7.66667C15.5 7.11438 15.0523 6.66667 14.5 6.66667H9.83333C9.28105 6.66667 8.83333 7.11438 8.83333 7.66667V14ZM9.83333 0C9.28105 0 8.83333 0.447715 8.83333 1V4C8.83333 4.55228 9.28105 5 9.83333 5H14.5C15.0523 5 15.5 4.55228 15.5 4V1C15.5 0.447715 15.0523 0 14.5 0H9.83333Z" fill="#FFFFFF" />
            </svg>
            <span class="ms-3">Dashboard</span>
          </a></li>
        <li class="">
          <a href="#" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-comments-dollar fs-5"></i></span>
            <span class="ms-3">Fees</span>
          </a>
        </li>
        <li class=""><a href="./student.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-graduation-cap fs-5"></i></span>
            <span class="ms-3 ">Students</span>
          </a>
        </li>
        <li class=""><a href="./course.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-book fs-5"></i></span>
            <span class="ms-4">Courses</span>
          </a>
        </li>
        <li class=""><a href="./rooms.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-bed-pulse fs-5"></i></span>
            <span class="ms-3">Rooms</span>
          </a>
        </li>

        <li class=""><a href="./book-room.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-check-to-slot fs-5"></i></span>
            <span class="ms-3">Book Room</span>
          </a>
        </li>
        <li class=""><a href="./employes.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-users-line fs-5"></i></span>
            <span class="ms-3">Employes</span></a></li>
        <li class=""><a href="./blocks.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-table-cells-large fs-4"></i></span>
            <span class="ms-3">Blocks</span>
          </a></li>
      </ul>
      <hr class="h-color mx-2">

      <ul class="list-unstyled px-2">
        <li class=""><a href="#" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-gear fs-5"></i></span>
            <span class="ms-3">Settings</span></a></li>
        <li class=""><a href="#" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-regular fa-bell fs-5"></i></span>
            <span class="ms-3">Notifications</span></a></li>

      </ul>

    </div>
    <div class="content">
      <div class="dashboard-content px-3 pt-4">