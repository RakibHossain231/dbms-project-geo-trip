<?php
session_start();
include('things/db_connect.php');

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php?msg=Please+login+to+cancel+booking");
    exit;
}

if (!isset($_GET['booking_id'])) {
    echo "<script>alert('Invalid request.'); window.location.href='user_profile.php';</script>";
    exit;
}

$booking_id = intval($_GET['booking_id']);
$customer_id = intval($_SESSION['id']);

$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND customer_id = ?");
$stmt->bind_param("ii", $booking_id, $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Invalid booking or permission denied.'); window.location.href='user_profile.php';</script>";
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #dc3545;
        }

        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
            border: none;
            transition: 0.3s;
        }

        button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Cancel Booking</h2>

        <form action="process_cancellation.php" method="POST">
            <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
            <label for="reason">Reason for Cancellation:</label>
            <textarea name="reason" rows="5" placeholder="Write your reason..." required></textarea>

            <button type="submit">Confirm Cancellation</button>
        </form>
    </div>
</body>

</html>