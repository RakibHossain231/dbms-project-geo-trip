<?php
// DB কানেকশন
include('things/db_connect.php');

// NULL পেমেন্ট স্ট্যাটাসের বুকিং আনছি
$sql = "SELECT * FROM bookings WHERE payment_status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unverified Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #007bff; /* You can set the default color here */
            font-size: 36px; /* Increase font size */
            font-weight: bold;
            background: linear-gradient(to left,rgb(128, 6, 6),rgb(163, 8, 8)); /* Gradient effect */
            -webkit-background-clip: text; /* For text gradient effect */
            color: transparent; /* Makes the text gradient visible */
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow to make it pop */
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 7px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                font-size: 12px;
            }

            button {
                padding: 5px 10px;
            }
        }
    </style>
</head>
<?php include 'things/top.php'; ?>
<body>
    <?php include 'things/navbar.php'; ?>
    <h2>Unverified Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking Date</th>
                <th>Arrival Date</th>
                <th>People Count</th>
                <th>Cancellation ID</th>
                <th>Payment ID</th>
                <th>Admin ID</th>
                <th>Customer ID</th>
                <th>Package ID</th>
                <th>Check Out</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['booking_date'] ?></td>
                <td><?= $row['arrival_date'] ?></td>
                <td><?= $row['people_count'] ?></td>
                <td><?= $row['cancellation_id'] ?></td>
                <td><?= $row['payment_id'] ?></td>
                <td><?= $row['admin_id'] ?></td>
                <td><?= $row['customer_id'] ?></td>
                <td><?= $row['package_id'] ?></td>
                <td><?= $row['check_out'] ?></td>
                <td><?= $row['payment_status'] ?? 'NULL' ?></td>
                <td>
                    <form action="payment_verify.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Verify</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    
    <!-- Add Go Back Button with modified styling -->
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
        <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
            Go Back
        </button>
    </div>
</body>
<?php include 'things/footer.php'; ?>
</html>
