<?php
include('../things/db_connect.php');

if (!isset($_GET['booking_id'])) {
    echo "<p>Invalid request.</p>";
    exit;
}

$booking_id = intval($_GET['booking_id']);

// Full query joining everything we need
$sql = "
SELECT 
    b.id AS booking_id, 
    b.booking_date, b.arrival_date, b.check_out, b.people_count, b.is_cancelled,
    b.customer_id, c.f_name, c.l_name, c.email, c.phone,
    p.price, p.descriptions, p.duration,
    pack_loc.country, pack_loc.city,
    pay.payment_status, pay.amount, pay.transaction_id, pay.payment_method, pay.paid_on,
    can.Reason, can.Refund_amount, can.Cancelled_on
FROM bookings b
JOIN customer c ON b.customer_id = c.customerID
JOIN package p ON b.package_id = p.id
JOIN package_location pl ON p.id = pl.Package_id
JOIN locations pack_loc ON pl.Location_id = pack_loc.Location_id
LEFT JOIN (
    SELECT booking_id, payment_status, amount, transaction_id, payment_method, paid_on 
    FROM payments 
    WHERE id IN (SELECT MAX(id) FROM payments GROUP BY booking_id)
) pay ON pay.booking_id = b.id
LEFT JOIN cancellations can ON can.Booking_id = b.id
WHERE b.id = $booking_id
";

$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo "<p>Booking not found.</p>";
    exit;
}

$row = $result->fetch_assoc();
?>

<h3 style="text-align:center; color:#333;">Booking Details</h3>
<table>
    <tr><th>Booking ID</th><td><?= $row['booking_id'] ?></td></tr>
    <tr><th>Customer Name</th><td><?= $row['f_name'] . " " . $row['l_name'] ?></td></tr>
    <tr><th>Customer Email</th><td><?= $row['email'] ?></td></tr>
    <tr><th>Phone</th><td><?= $row['phone'] ?></td></tr>
    <tr><th>Booking Date</th><td><?= $row['booking_date'] ?></td></tr>
    <tr><th>Arrival Date</th><td><?= $row['arrival_date'] ?></td></tr>
    <tr><th>Checkout</th><td><?= $row['check_out'] ?></td></tr>
    <tr><th>People Count</th><td><?= $row['people_count'] ?></td></tr>
    <tr><th>Package Price</th><td><?= $row['price'] ?></td></tr>
    <tr><th>Package Duration</th><td><?= $row['duration'] ?> Days</td></tr>
    <tr><th>Location</th><td><?= $row['city'] . ', ' . $row['country'] ?></td></tr>
    <tr><th>Payment Status</th><td><?= $row['payment_status'] ?? 'Unpaid' ?></td></tr>
    <tr><th>Payment Amount</th><td><?= $row['amount'] ?? '-' ?></td></tr>
    <tr><th>Transaction ID</th><td><?= $row['transaction_id'] ?? '-' ?></td></tr>
    <tr><th>Payment Method</th><td><?= $row['payment_method'] ?? '-' ?></td></tr>
    <tr><th>Paid On</th><td><?= $row['paid_on'] ?? '-' ?></td></tr>
    <tr><th>Cancellation Status</th><td><?= $row['is_cancelled'] ? 'Cancelled' : 'Active' ?></td></tr>
    <tr><th>Cancellation Reason</th><td><?= $row['Reason'] ?? '-' ?></td></tr>
    <tr><th>Refund Amount</th><td><?= $row['Refund_amount'] ?? '-' ?></td></tr>
    <tr><th>Cancelled On</th><td><?= $row['Cancelled_on'] ?? '-' ?></td></tr>
</table>
