<?php
session_start();
include('things/db_connect.php');

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php?msg=Please+login+to+cancel+booking");
    exit;
}

if (isset($_POST['booking_id']) && isset($_POST['reason'])) {
    $booking_id = intval($_POST['booking_id']);
    $reason = trim($_POST['reason']);
    $customer_id = intval($_SESSION['id']);

    // Verify booking belongs to this user
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND customer_id = ?");
    $stmt->bind_param("ii", $booking_id, $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('Invalid booking or permission denied.'); window.location.href='user_profile.php';</script>";
        exit;
    }

    // Insert into cancellations table
    $cancel_date = date('Y-m-d');
    $refund_amount = 0;

    $insert = $conn->prepare("INSERT INTO cancellations (Cancelled_on, Refund_amount, Reason, Booking_id) VALUES (?, ?, ?, ?)");
    $insert->bind_param("sdsi", $cancel_date, $refund_amount, $reason, $booking_id);
    $insert->execute();
    $insert->close();

    // Mark booking as cancelled
    $update = $conn->prepare("UPDATE bookings SET is_cancelled = 1 WHERE id = ?");
    $update->bind_param("i", $booking_id);
    $update->execute();
    $update->close();

    echo "<script>alert('Booking cancelled successfully.'); window.location.href='user_profile.php';</script>";
} else {
    echo "<script>alert('Invalid request.'); window.location.href='user_profile.php';</script>";
}

$conn->close();
