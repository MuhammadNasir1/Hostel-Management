<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "Couses";
include("./includes/header.php");
?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Courses</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Students List</h5>
            <button class="btn bg-primary text-white px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Student</button>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Corse Name</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>peter</td>
                    <td>peter@email.com</td>

                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 ">
            <div class="mb-3">
                <label for="studentName" class="formlabel mt-1 fs-6 text-primary">Student Name</label>
                <input type="text" class="form-control mt-1">
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 ">
                            <div class="mb-3">
                                <label for="studentName" class="formlabel mt-1 fs-6 text-primary">Student Name</label>
                                <input type="text" class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn bg-primary text-white px-3 py-2 fw-semibold">Save</button>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php")
?>