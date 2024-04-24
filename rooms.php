<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Couses";
include("./includes/header.php");


if (isset($_POST['submit'])) {
    $block = $_POST['block'];
    $no_of_beds = $_POST['no_of_beds'];
    $room_status = $_POST['room_status'];
    $room_no = $_POST['room_no'];
    $room_description = $_POST['room_description'];

    $insert = "INSERT INTO `rooms`(`block`, `no_of_beds`, `room_status`, `room_no`, `room_description`) VALUES ('$block','$no_of_beds','$room_status','$room_no','$room_description')";
    $query = mysqli_query($conn, $insert);

    if ($insert) {
        header('location: rooms.php');
    } else {
        echo "Data Not Added";
    }
}

$get_data = "SELECT * FROM `rooms`";
$result = mysqli_query($conn, $get_data);

$block = "SELECT * FROM `blocks`";
$res = mysqli_query($conn, $block);

if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `rooms` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: rooms.php');
    } else {
        echo 'Data Not Added';
    }
}

?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Rooms</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Rooms List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Room</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Room No</th>
                    <th>Block</th>
                    <th>No Of Beds</th>
                    <th>Status</th>
                    <th>Action</th>

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
                        <td><?= $row['room_no'] ?></td>
                        <td><?= $row['block'] ?></td>
                        <td><?= $row['no_of_beds'] ?></td>
                        <td><?= $row['room_status'] ?></td>
                        <td>
                            <a href="rooms.php?edit=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Edit</button></a>
                            <a href="rooms.php?del=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Delete</button></a>
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
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Room</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="block" class="form-label text-primary">Block</label>
                                <select name="block" id="block" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <option value="<?= $row['block_name'] ?>"><?= $row['block_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="no_of_beds" class="form-label text-primary">No Of Beds</label>
                                <select name="no_of_beds" id="no_of_beds" class="form-select">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 col-12">
                                <label for="room_status" class="form-label text-primary">Status</label>
                                <select name="room_status" id="room_status" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="room_no" class="form-label text-primary">Room No</label>
                                <input type="number" min="0" required name="room_no" id="room_no" class="form-control" placeholder="Enter Room No">
                            </div>

                        </div>

                        <div class="row mt-3 pe-0">
                            <div class="col-12 pe-0">
                                <label for="room_description" class="form-label text-primary">Description</label>
                                <textarea placeholder="Enter Room Description" required name="room_description" id="room_description" rows="3" class="form-control"></textarea>
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