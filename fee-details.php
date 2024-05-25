<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}


$title = "Fee Details";



include("./includes/header.php");
if (isset($_REQUEST['edit'])) {
?>
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
<?php
    $id = $_REQUEST['edit'];
    $sql = "SELECT * FROM `employes` WHERE id = $id";
    $resu = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($resu);
}




?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Students</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Students List</h5>

        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Student Name</th>
                    <th class="bg-primary text-white">Roll No</th>
                    <th class="bg-primary text-white">Fee per Month</th>
                    <th class="bg-primary text-white">Fee Type (this month)</th>
                    <th class="bg-primary text-white">Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Peter</td>
                    <td>1234567</td>
                    <td>200Pkr</td>
                    <td><button class="btn bg-danger text-white px-3 py-2 fw-semibold">
                            <span></span> Pending</button></< /td>
                    <td> <button class="btn bg-primary text-white px-3 py-2 fw-semibold">
                            <span></span> Pay This Month</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Employe Registration</h1>
                <span type="button" class="pt-1" data-bs-dismiss="modal" aria-label="Close"><span class="text-white"><i class="fa-solid fa-xmark fs-4"></i></span></span>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" class="form">
                        <input type="hidden" name="updateID" value="<?= @$updateData['id'] ?>">


                        <div class="row mt-3">

                            <div class="col-lg-4">
                                <label for="emp_type" class="form-label text-primary">Employe Type</label>
                                <input type="text" name="emp_type" placeholder="Enter Employe Type" id="emp_type" class="form-control" value="<?= @$updateData['emp_type'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="emp_name" class="form-label text-primary">Employe Name</label>
                                <input type="text" name="emp_name" placeholder="Enter Employe Name" id="emp_name" class="form-control" value="<?= @$updateData['emp_name'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="block_id" class="form-label text-primary">Block</label>
                                <select name="block_id" id="block_id" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <option value="<?= $row['block_name'] ?>"><?= $row['block_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <label for="emp_gender" class="form-label text-primary">Gender</label>
                                <select name="emp_gender" id="emp_gender" class="form-select">
                                    <option selected disabled>Select Gender</option>
                                    <option <?= (@$updateData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option <?= (@$updateData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>

                                </select>
                            </div>
                            <div class="col-lg-4  mt-lg-0 mt-3">
                                <label for="emp_dob" class="form-label text-primary">Date Of Birth</label>
                                <input type="date" name="emp_dob" id="emp_dob" class="form-control" value="<?= @$updateData['date_of_birth'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="emp_doj" class="form-label text-primary">Date Of Joining</label>
                                <input type="date" name="emp_doj" id="emp_doj" class="form-control" value="<?= @$updateData['date_of_join'] ?>">
                            </div>

                        </div>

                        <div class="row mt-3 <?php if ($id) { ?> d-none <?php } ?>">
                            <h1 class="modal-title fs-5 fw-bold">Login Credentials</h1>

                            <div class="col-lg-4 ">
                                <label for="emp_username" class="form-label text-primary">Username</label>
                                <input type="text" name="emp_username" placeholder="Enter Username" id="emp_username" class="form-control">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="email_id" class="form-label text-primary">Email</label>
                                <input type="email" name="email_id" placeholder="Enter Email Address" id="email_id" class="form-control" value="<?= @$updateData['emp_email'] ?>">
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label for="emp_password" class="form-label text-primary">Login Password</label>
                                <input type="password" name="emp_password" placeholder="Enter Login Password" id="emp_password" class="form-control">
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