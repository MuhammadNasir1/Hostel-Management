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
    $sql = "SELECT * FROM `rooms` WHERE id = $id";
    $resu = mysqli_query($conn, $sql);
    $updateData  = mysqli_fetch_assoc($resu);
}

?>

<div class="container-fluid mt-4">
    <h4 class="text-primary fw-semibold">All Students</h4>
    <div class=" shadow p-4 rounded-1">
        <div class="d-flex justify-content-between  mb-5">
            <h5 class="text-primary ">Student List</h5>
        </div>
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Sno.</th>
                    <th class="bg-primary text-white">Student Name</th>
                    <th class="bg-primary text-white">Roll No</th>
                    <th class="bg-primary text-white">Joining Date</th>
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
                    <td>200Pkr</td>
                    <td><button class="btn bg-danger text-white px-3 py-2 fw-semibold">
                            <span></span> Pending</button></< /td>
                    <td> <button class="btn bg-primary text-white px-3 py-2 fw-semibold">
                            <span></span> Change Status</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>





<?php
include("./includes/footer.php")
?>