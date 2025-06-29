<?php
session_start();
include('things/db_connect.php');

// Admin authentication check (optional)
if (empty($_SESSION['id']) || $_SESSION['type'] !== 'admin') {
    header("Location: admin_login.php?msg=Please+login+as+admin");
    exit;
}

// Handle refund update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancellation_id'], $_POST['refund_amount'])) {
    $cancellation_id = intval($_POST['cancellation_id']);
    $refund_amount = floatval($_POST['refund_amount']);

    $stmt = $conn->prepare("UPDATE cancellations SET Refund_amount = ? WHERE Id = ?");
    $stmt->bind_param("di", $refund_amount, $cancellation_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Refund updated successfully.'); window.location.href='admin_cancellations.php';</script>";
    exit;
}

// Fetch all cancellations
$sql = "
SELECT 
    c.Id AS cancellation_id,
    c.Cancelled_on,
    c.Refund_amount,
    c.Reason,
    b.id AS booking_id,
    b.customer_id,
    p.price
FROM cancellations c
JOIN bookings b ON c.Booking_id = b.id
JOIN package p ON b.package_id = p.id
ORDER BY c.Cancelled_on DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cancellation Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 36px;
            font-weight: bold;
            background: linear-gradient(to left, #8B0000, #FF0000);
            -webkit-background-clip: text;
            color: transparent;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
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

        input[type="number"] {
            width: 80px;
            padding: 5px;
            text-align: right;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<?php include 'things/top.php'; ?>

<body>
    <?php include 'things/navbar.php'; ?>

    <h2>Cancellation Management</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Cancellation ID</th>
                    <th>Booking ID</th>
                    <th>Customer ID</th>
                    <th>Package Price</th>
                    <th>Cancelled On</th>
                    <th>Reason</th>
                    <th>Refund Amount (৳)</th>
                    <th>Update Refund</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['cancellation_id'] ?></td>
                        <td><?= $row['booking_id'] ?></td>
                        <td><?= $row['customer_id'] ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['Cancelled_on'] ?></td>
                        <td><?= htmlspecialchars($row['Reason']) ?></td>
                        <td>
                            <form action="admin_cancellations.php" method="POST">
                                <input type="hidden" name="cancellation_id" value="<?= $row['cancellation_id'] ?>">
                                <input type="number" class="text-center" name="refund_amount" value="<?= $row['Refund_amount'] ?>" step="0.01" min="0" required>
                        </td>
                        <td>
                            <button type="submit">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p style="text-align:center;">No cancellations found.</p>
    <?php endif; ?>

</body>
<?php include 'things/footer.php'; ?>

</html>