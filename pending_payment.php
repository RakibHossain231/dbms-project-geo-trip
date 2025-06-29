<?php
include('things/db_connect.php');

// Query for pending payments
$sql = "
SELECT 
    payments.id AS payment_id,
    payments.amount,
    payments.transaction_id,
    payments.paid_on,
    payments.booking_id,
    bookings.customer_id,
    bookings.arrival_date,
    bookings.people_count,
    bookings.package_id,
    bookings.check_out
FROM payments
JOIN bookings ON payments.booking_id = bookings.id
WHERE payments.payment_status = 'pending'
ORDER BY payments.paid_on DESC;
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Payments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'things/top.php'; ?>

<body class="bg-gray-100">
<?php include 'things/navbar.php'; ?>

<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold text-red-600 mb-6 text-center">Pending Payments</h2>

    <?php if ($result && $result->num_rows > 0): ?>
    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-red-500 text-white">
                <tr>
                    <th class="p-3">Payment ID</th>
                    <th class="p-3">Booking ID</th>
                    <th class="p-3">Customer ID</th>
                    <th class="p-3">Package ID</th>
                    <th class="p-3">Arrival</th>
                    <th class="p-3">Checkout</th>
                    <th class="p-3">People</th>
                    <th class="p-3">Amount (৳)</th>
                    <th class="p-3">Transaction ID</th>
                    <th class="p-3">Paid On</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?= $row['payment_id'] ?></td>
                    <td class="p-2"><?= $row['booking_id'] ?></td>
                    <td class="p-2"><?= $row['customer_id'] ?></td>
                    <td class="p-2"><?= $row['package_id'] ?></td>
                    <td class="p-2"><?= $row['arrival_date'] ?></td>
                    <td class="p-2"><?= $row['check_out'] ?></td>
                    <td class="p-2"><?= $row['people_count'] ?></td>
                    <td class="p-2"><?= number_format($row['amount'], 2) ?></td>
                    <td class="p-2"><?= $row['transaction_id'] ?></td>
                    <td class="p-2"><?= $row['paid_on'] ?></td>
                    <td class="p-2 flex flex-col gap-2">
                        <form action="payment_verify.php" method="POST">
                            <input type="hidden" name="payment_id" value="<?= $row['payment_id'] ?>">
                            <button type="submit" name="action" value="verify" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 w-full">Verify</button>
                        </form>
                        <form action="payment_verify.php" method="POST">
                            <input type="hidden" name="payment_id" value="<?= $row['payment_id'] ?>">
                            <button type="submit" name="action" value="reject" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 w-full">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="text-center text-gray-500 text-lg mt-8">No pending payments found.</p>
    <?php endif; ?>
</div>

</body>
<?php include 'things/footer.php'; ?>
</html>
