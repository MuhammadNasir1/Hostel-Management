<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Block";
include("./includes/header.php");


if (isset($_POST['submit'])) {
    $id = $_POST['updateID'];
    $block_name = $_POST['block_name'];
    $gender = $_POST['gender'];
    $block_status = $_POST['block_status'];
    $block_description = $_POST['block_description'];

    if (empty($id)) {
        $insert = "INSERT INTO `blocks`(`block_name`, `gender`, `block_status`, `block_descriptipn`) VALUES ('$block_name','$gender','$block_status','$block_description')";
        $query = mysqli_query($conn, $insert);
        if ($insert) {
            header('location: blocks.php');
        }
    } else {
        $update = "UPDATE `blocks` SET `block_name`='$block_name',`gender`='$gender',`block_status`='$block_status',`block_descriptipn`='$block_description' WHERE id = $id";
        $updateQuery = mysqli_query($conn, $update);
        if ($updateQuery) {
            header('location: blocks.php');
        }
    }
}

$get_data = "SELECT * FROM `blocks`";
$result = mysqli_query($conn, $get_data);

if (isset($_REQUEST['del'])) {
    $id = $_REQUEST['del'];
    $delete = "DELETE FROM `blocks` WHERE id = $id";
    $query = mysqli_query($conn, $delete);

    if ($query) {
        header('location: blocks.php');
    } else {
        echo 'Data Not Added';
    }
}


if (isset($_REQUEST['edit'])) {
?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
<?php
    $id = $_REQUEST['edit'];
    $sql = "SELECT * FROM `blocks` WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($res);
}
?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Blocks</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Blocks List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Block</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Block Name</th>
                    <th class="bg-primary text-white">Gender</th>
                    <th class="bg-primary text-white">Block Status</th>
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
                        <td><?= $row['block_name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['block_status'] ?></td>
                        <td>
                            <a href="blocks.php?edit=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Edit</button></a>
                            <a href="blocks.php?del=<?= $row['id'] ?>"><button class="btn bg-primary text-white btn-sm">Delete</button></a>
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
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Block</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label for="block_name" class="form-label text-primary">Block Name</label>
                                <input type="text" name="block_name" required placeholder="Enter Block Name" id="block_name" class="form-control" value="<?= @$updateData['block_name'] ?>">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="gender" class="form-label text-primary">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option <?= (@$updateData['gender'] == 'Male') ? 'selected' : ''; ?> value="Male">Male</option>
                                    <option <?= (@$updateData['gender'] == 'Female') ? 'selected' : ''; ?> value="Female">Female</option>
                                    <option <?= (@$updateData['gender'] == 'others') ? 'selected' : ''; ?> value="others">others</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="block_status" class="form-label text-primary">Status</label>
                                <select name="block_status" id="block_status" class="form-select">
                                    <option <?= (@$updateData['block_status'] == 'Active') ? 'selected' : ''; ?> value="Active">Active</option>
                                    <option <?= (@$updateData['block_status'] == 'InActive') ? 'selected' : ''; ?> value="InActive">InActive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 pe-0">
                            <div class="col-12 pe-0">
                                <label for="block_description" class="form-label text-primary">Description</label>
                                <textarea placeholder="Enter Block Description" required name="block_description" id="block_description" rows="3" class="form-control"><?= @$updateData['block_descriptipn'] ?></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class=" modal-footer">
                <button type="submit" name="submit" class="btn bg-primary text-white px-3 py-2 fw-semibold">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php")
?>