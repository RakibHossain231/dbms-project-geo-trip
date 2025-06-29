<?php
include('things/db_connect.php');

// Check if payment_id and action is received
if (isset($_POST['payment_id']) && isset($_POST['action'])) {
    $payment_id = intval($_POST['payment_id']);
    $action = $_POST['action'];

    if ($action === 'verify') {
        $new_status = 'verified';
    } elseif ($action === 'reject') {
        $new_status = 'rejected';
    } else {
        die('Invalid action.');
    }

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE payments SET payment_status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $payment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Payment status updated successfully.'); window.location.href='pending_payment.php';</script>";
    } else {
        echo "<script>alert('Failed to update payment status.'); window.location.href='pending_payment.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='pending_payment.php';</script>";
}

$conn->close();
?>
