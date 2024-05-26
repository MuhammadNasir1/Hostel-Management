<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - Aghosh</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./DataTables/datatables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="./img/Logo-white.png" type="image/x-icon">
</head>

<body>

  <div class="main-container d-flex bg-primary">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <a class="mx-auto" href="./"> <img height="130px" class="rounded mx-auto" src="./img/Logo-white.png" alt="Logo"></a>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
      </div>

      <ul class="list-unstyled px-2">
        <li class="active mt-2"><a href="index.php" class="text-decoration-none p-2 d-flex align-items-center">
            <svg width="24" height="20" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0.5 7.33333C0.5 7.88562 0.947715 8.33333 1.5 8.33333H6.16667C6.71895 8.33333 7.16667 7.88562 7.16667 7.33333V1C7.16667 0.447715 6.71895 0 6.16667 0H1.5C0.947714 0 0.5 0.447715 0.5 1V7.33333ZM0.5 14C0.5 14.5523 0.947715 15 1.5 15H6.16667C6.71895 15 7.16667 14.5523 7.16667 14V11C7.16667 10.4477 6.71895 10 6.16667 10H1.5C0.947714 10 0.5 10.4477 0.5 11V14ZM8.83333 14C8.83333 14.5523 9.28105 15 9.83333 15H14.5C15.0523 15 15.5 14.5523 15.5 14V7.66667C15.5 7.11438 15.0523 6.66667 14.5 6.66667H9.83333C9.28105 6.66667 8.83333 7.11438 8.83333 7.66667V14ZM9.83333 0C9.28105 0 8.83333 0.447715 8.83333 1V4C8.83333 4.55228 9.28105 5 9.83333 5H14.5C15.0523 5 15.5 4.55228 15.5 4V1C15.5 0.447715 15.0523 0 14.5 0H9.83333Z" fill="#FFFFFF" />
            </svg>
            <span class="ms-3">Dashboard</span>
          </a></li>
        <li class="mt-2">
          <a href="./fee-details.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-comments-dollar fs-5"></i></span>
            <span class="ms-3">Fees</span>
          </a>
        </li>
        <li class="mt-2"><a href="./student.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-graduation-cap fs-5"></i></span>
            <span class="ms-3 ">Students</span>
          </a>
        </li>
        <li class="mt-2"><a href="./course.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-book fs-5"></i></span>
            <span class="ms-4">Courses</span>
          </a>
        </li>
        <li class="mt-2"><a href="./rooms.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-bed-pulse fs-5"></i></span>
            <span class="ms-3">Rooms</span>
          </a>
        </li>

        <li class="mt-2"><a href="./book-room.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-check-to-slot fs-5"></i></span>
            <span class="ms-3">Book Room</span>
          </a>
        </li>

        <?php
        if ($_SESSION['role'] == "admin") {
        ?>
          <li class="mt-2"><a href="./employes.php" class="text-decoration-none p-2 d-flex align-items-center">
              <span><i class="fa-solid fa-users-line fs-5"></i></span>
              <span class="ms-3">Employes</span></a></li>
        <?php
        }

        ?>

        <li class="mt-2"><a href="./blocks.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-table-cells-large fs-4"></i></span>
            <span class="ms-3">Blocks</span>
          </a></li>
        <li class="mt-2"><a href="./setting.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><i class="fa-solid fa-gear fs-4"></i></span>
            <span class="ms-3">Settings</span></a></li>
      </ul>

      <ul class="list-unstyled px-2">
        <li class="position-absolute bottom-0 mb-4"><a href="./logout.php" class="text-decoration-none p-2 d-flex align-items-center">
            <span><svg width="25" height="25" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.54545 8.18182H11.8182V10H4.54545V12.7273L0 9.09091L4.54545 5.45455V8.18182ZM3.63636 14.5455H6.09818C7.1479 15.4712 8.44244 16.0744 9.82648 16.2827C11.2105 16.4909 12.6252 16.2954 13.9009 15.7195C15.1766 15.1437 16.259 14.212 17.0182 13.0362C17.7775 11.8604 18.1814 10.4905 18.1814 9.09091C18.1814 7.69129 17.7775 6.3214 17.0182 5.14563C16.259 3.96985 15.1766 3.03813 13.9009 2.46227C12.6252 1.88642 11.2105 1.69089 9.82648 1.89915C8.44244 2.10741 7.1479 2.71061 6.09818 3.63637H3.63636C4.48242 2.50653 5.5803 1.58956 6.84279 0.958313C8.10528 0.327069 9.49759 -0.00105786 10.9091 2.56208e-06C15.93 2.56208e-06 20 4.07 20 9.09091C20 14.1118 15.93 18.1818 10.9091 18.1818C9.49759 18.1829 8.10528 17.8548 6.84279 17.2235C5.5803 16.5923 4.48242 15.6753 3.63636 14.5455Z" fill="white" />
              </svg></span>
            <span class="ms-3">Logout</span></a></li>

      </ul>

    </div>
    <div class="content  bg-white  rounded-start-5">
      <div class="dashboard-content">
        <div class="navbar d-flex justify-content-between py-3">
          <div>
            <!-- <h3>Hostel Management System</h3> -->
          </div>
          <div class="d-flex gap-2">
            <div class="text-end">
              <h5 class="m-0 fs-5"><?= $_SESSION['user_name'] ?></h5>
              <p class="p-0 m-0"><?= $_SESSION['role'] ?></p>
            </div>
            <!-- <img src="./img/user.png" alt="User" class="mt-1"> -->
            <?php
            $userImage = isset($_SESSION['user_image']) && !empty($_SESSION['user_image']) ? $_SESSION['user_image'] : 'img/user.png';
            ?>
            <img src="./<?= $userImage ?>" alt="User" class="mt-1">
          </div>
        </div>