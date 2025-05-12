<?php
include('things/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $update_sql = "UPDATE bookings SET payment_status = 'verified' WHERE id = $id";
    $conn->query($update_sql);
}

header("Location: pending_payment.php");
exit();
?>
