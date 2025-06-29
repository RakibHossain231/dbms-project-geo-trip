<?php
session_start();
include('things/db_connect.php');

// Admin authentication check
if (empty($_SESSION['id']) || $_SESSION['type'] !== 'admin') {
    header("Location: admin_login.php?msg=Please+login+as+admin");
    exit;
}

// Payment filter
$payment_filter = isset($_GET['payment_status']) ? trim($_GET['payment_status']) : null;
$where = "WHERE 1=1";
if (!empty($payment_filter)) {
    if ($payment_filter == 'unpaid') {
        $where .= " AND pay.payment_status IS NULL";
    } else {
        $safe_payment = $conn->real_escape_string($payment_filter);
        $where .= " AND pay.payment_status = '$safe_payment'";
    }
}

$sql = "
SELECT 
    b.id AS booking_id, b.booking_date, b.arrival_date, b.check_out, b.people_count, b.is_cancelled,
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
$where
ORDER BY b.booking_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'things/top.php'; ?>

<body class="bg-gray-100">
<?php include 'things/navbar.php'; ?>

<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Admin - All Bookings</h2>

    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="GET" class="flex flex-wrap gap-3 items-center justify-center">
            <select name="payment_status" class="border px-4 py-2 rounded">
                <option value="">Payment Status</option>
                <option value="verified" <?= $payment_filter == 'verified' ? 'selected' : '' ?>>Verified</option>
                <option value="pending" <?= $payment_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="rejected" <?= $payment_filter == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="unpaid" <?= $payment_filter == 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Filter</button>
            <a href="admin_view_bookings.php" class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">Reset</a>
        </form>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white text-sm">
                    <th class="p-2">Booking ID</th>
                    <th class="p-2">Customer</th>
                    <th class="p-2">Contact</th>
                    <th class="p-2">Package</th>
                    <th class="p-2">Location</th>
                    <th class="p-2">Booking Date</th>
                    <th class="p-2">Arrival</th>
                    <th class="p-2">Checkout</th>
                    <th class="p-2">People</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Payment</th>
                    <th class="p-2">Cancellation</th>
                    <th class="p-2">Refund</th>
                </tr>
            </thead>
            <tbody class="text-center text-sm">
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="<?= $row['is_cancelled'] ? 'bg-red-100' : '' ?>">
                    <td class="p-2"><?= $row['booking_id'] ?></td>
                    <td class="p-2"><?= htmlspecialchars($row['f_name'] . " " . $row['l_name']) ?></td>
                    <td class="p-2"><?= $row['email'] ?><br><?= $row['phone'] ?></td>
                    <td class="p-2"><?= htmlspecialchars($row['descriptions']) ?></td>
                    <td class="p-2"><?= $row['city'] . ", " . $row['country'] ?></td>
                    <td class="p-2"><?= $row['booking_date'] ?></td>
                    <td class="p-2"><?= $row['arrival_date'] ?></td>
                    <td class="p-2"><?= $row['check_out'] ?></td>
                    <td class="p-2"><?= $row['people_count'] ?></td>
                    <td class="p-2"><?= number_format($row['price'], 2) ?> ৳</td>
                    <td class="p-2 font-semibold">
                        <?php
                        if ($row['payment_status'] == 'verified') {
                            echo '<span class="text-green-600">Verified</span>';
                        } elseif ($row['payment_status'] == 'pending') {
                            echo '<span class="text-yellow-500">Pending</span>';
                        } elseif ($row['payment_status'] == 'rejected') {
                            echo '<span class="text-red-500">Rejected</span>';
                        } else {
                            echo '<span class="text-gray-500">Unpaid</span>';
                        }
                        ?>
                    </td>
                    <td class="p-2">
                        <?= $row['is_cancelled'] ? "Cancelled<br>Reason: " . htmlspecialchars($row['Reason']) . "<br>On: " . $row['Cancelled_on'] : "-" ?>
                    </td>
                    <td class="p-2">
                        <?= $row['Refund_amount'] !== null ? number_format($row['Refund_amount'], 2) . " ৳" : "-" ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="text-center text-gray-500">No bookings found.</p>
    <?php endif; ?>
</div>

</body>
<?php include 'things/footer.php'; ?>
</html>
