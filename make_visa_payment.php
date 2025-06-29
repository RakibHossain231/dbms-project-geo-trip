<?php
require_once 'things/db_connect.php';

$visa_id = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $application_id = intval($_POST['application_id']);
    $amount = floatval($_POST['amount']);
    $payment_date = $_POST['payment_date'] ?? date('Y-m-d');
    $transaction_id = trim($_POST['transaction_id']);

    if ($application_id <= 0 || $amount <= 0 || empty($transaction_id)) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $query = "INSERT INTO visa_payments (application_id, amount, payment_date, transaction_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Insert Prepare Failed: " . $conn->error);
        }

        $stmt->bind_param("idss", $application_id, $amount, $payment_date, $transaction_id);
        if ($stmt->execute()) {
            $payment_id = $stmt->insert_id;

            $updateQuery = "UPDATE visa_application SET payment_id = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            if (!$updateStmt) {
                die("Update Prepare Failed: " . $conn->error);
            }

            $updateStmt->bind_param("ii", $payment_id, $application_id);
            if ($updateStmt->execute()) {
                $success = "✅ Payment recorded successfully. Payment ID: $payment_id";
            } else {
                $error = "❌ Failed to update visa_applications: " . $updateStmt->error;
            }

            $updateStmt->close();
        } else {
            $error = "❌ Failed to insert visa payment: " . $stmt->error;
        }

        $stmt->close();
    }

    $visa_id = $application_id; // retain in form after POST
} elseif (isset($_GET['visa_id'])) {
    // First time loading
    $visa_id = intval($_GET['visa_id']);
}

include('things/top.php');
?>

<body class="bg-gray-100 px-4">
    <?php include('things/navbar.php') ?>

    <div class="bg-white shadow-md rounded-lg px-4 py-8 max-w-md w-full flex flex-col justify-center mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Make Visa Payment</h2>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="make_visa_payment.php" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Visa Application ID</label>
                <input type="number" id="application_id_display" value="<?= htmlspecialchars($visa_id) ?>" disabled
                    class="mt-1 w-full px-3 py-2 border border-gray-300 bg-gray-100 rounded-lg text-gray-500">
                <input type="hidden" name="application_id" value="<?= htmlspecialchars($visa_id) ?>">
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Payment Amount</label>
                <input type="number" step="0.01" id="amount" name="amount" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="payment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                <input type="date" id="payment_date" name="payment_date" value="<?= date('Y-m-d') ?>"
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="transaction_id" class="block text-sm font-medium text-gray-700">Transaction ID</label>
                <input type="text" id="transaction_id" name="transaction_id" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-semibold transition duration-200">
                Submit Payment
            </button>
        </form>
    </div>
</body>

<?php include('things/footer.php') ?>
</html>
