<?php
session_start();
if (empty($_SESSION['id']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php?msg=Please+login+as+a+customer+to+make+payments");
    exit;
}

include 'things/top.php';
include 'things/db_connect.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : null;

if (!$booking_id) {
    die('Invalid booking ID.');
}

// Fetch booking info along with package price
$bookingResult = mysqli_query($conn, "
    SELECT b.id AS booking_id, p.price 
    FROM bookings b 
    JOIN package p ON b.package_id = p.id 
    WHERE b.id = $booking_id
");
$booking = mysqli_fetch_assoc($bookingResult);

if (!$booking) {
    die('Booking not found.');
}

$price = $booking['price'];

// Fetch coupon codes
$couponsResult = mysqli_query($conn, "SELECT id, coupon_code FROM coupons");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $transaction_id = trim($_POST['transaction_id']);
    $coupon_id = !empty($_POST['coupon_id']) ? intval($_POST['coupon_id']) : null;
    $paid_date = date('Y-m-d');

    // Insert payment info
    $stmt = $conn->prepare("INSERT INTO payments (payment_method, paid_on, transaction_id, coupon_id, booking_id, amount, payment_for) VALUES (?, ?, ?, ?, ?, ?, 'booking')");
    $stmt->bind_param("sssiid", $payment_method, $paid_date, $transaction_id, $coupon_id, $booking_id, $price);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $payment_id = $stmt->insert_id;

        // Update booking with payment_id only (no payment_status anymore)
        $update = $conn->prepare("UPDATE bookings SET payment_id = ? WHERE id = ?");
        $update->bind_param("ii", $payment_id, $booking_id);
        $update->execute();

        echo "<script>
                alert('Payment submitted successfully! Awaiting admin verification.');
                window.location.href='user_profile.php';
              </script>";
    } else {
        echo "<script>alert('Payment failed. Please try again.');</script>";
    }

    $stmt->close();
}
?>

<body class="min-h-screen bg-gradient-to-br from-yellow-50 to-blue-50 text-gray-800">
<?php include 'things/navbar.php'; ?>

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow border border-gray-200">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Submit Payment Info</h2>

    <p class="mb-4 text-center text-lg font-medium">
        Booking Price: <span class="text-green-600 font-bold">৳<?php echo htmlspecialchars($price); ?></span>
    </p>

    <form method="POST" id="paymentForm" onsubmit="return validateTransactionID();" class="space-y-4">
        <div>
            <label class="block font-semibold mb-1">Payment Method:</label>
            <select name="payment_method" required class="w-full border px-3 py-2 rounded">
                <option value="">💳 Select Method</option>
                <option value="Bkash">📱 Bkash</option>
                <option value="Nagad">💰 Nagad</option>
                <option value="Cellfin">📲 Cellfin</option>
                <option value="CITY TOUCH">🏛️ CITY TOUCH</option>
                <option value="SKYBANKING">☁️ SKYBANKING</option>
                <option value="NEXUSPAY">🧾 NEXUSPAY</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Transaction ID:</label>
            <input type="text" name="transaction_id" id="transaction_id" required class="w-full border px-3 py-2 rounded " placeholder="Transaction Id has to be between 6 and 25 characters">
        </div>

        <div>
            <label class="block font-semibold mb-1">Apply Coupon (optional):</label>
            <select name="coupon_id" class="w-full border px-3 py-2 rounded">
                <option value="">🎟️ No Coupon</option>
                <?php while ($coupon = mysqli_fetch_assoc($couponsResult)): ?>
                    <option value="<?php echo $coupon['id']; ?>">
                        <?php echo htmlspecialchars($coupon['coupon_code']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Confirm Payment
            </button>
        </div>
    </form>
</div>

<script>
function validateTransactionID() {
    const txn = document.getElementById("transaction_id").value.trim();
    if (txn.length < 6 || txn.length > 25) {
        alert("Transaction ID must be between 6 and 25 characters.");
        return false;
    }
    return true;
}
</script>

<div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
    <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
        Go Back
    </button>
</div>

<?php include 'things/footer.php'; ?>
</body>
</html>
