<?php
include('../includes/dbconn.php');

$registerId = $_REQUEST['student'];
$result = mysqli_query($conn, "SELECT * FROM `room_registration` WHERE id   = $registerId");
$reg_data =  mysqli_fetch_assoc($result);
$studentId = $reg_data['student_id'];
$res = mysqli_query($conn, "SELECT * FROM `students` WHERE id   = $studentId");
$std_data =  mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details .left,
        .invoice-details .right {
            width: 50%;
        }

        .invoice-items {
            border-collapse: collapse;
            width: 100%;
        }

        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .invoice-items th {
            background-color: #f0f0f0;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
            <img height="120px" src="../img/Logo.png" alt="logo">
        </div>
        <div class="invoice-details">
            <div class="left">
                <p><strong>Hostel Name:</strong> Agosh</p>
                <p><strong>Address:</strong> Faisalabad, Pubjab , Pakistan</p>
                <p><strong>Date:</strong> <?= date("F j, Y") ?></p>
            </div>
            <div class="right">
                <p><strong>Student Name:</strong> <?= $std_data['name'] ?></p>
                <p><strong>Roll No:</strong><?= $std_data['roll_no'] ?> </p>
            </div>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fees</td>
                    <td><?= $reg_data['total_fee'] ?>Pkr</td>
                </tr>`
                <tr>
                    <td>Others</td>
                    <td>0 Pkr</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-total">
            <p><strong>Total:</strong> <?= $reg_data['total_fee'] ?>Pkr</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>