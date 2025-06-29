<?php
session_start();
if (empty($_SESSION['id']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php?msg=You+must+be+a+customer+to+make+a+booking+for+the+package");
    exit;
}

$customer_id = $_SESSION['id'];
$package_id = $_GET['id'] ?? null;

include 'things/db_connect.php';

// Get package info
$package = null;
$title = '';
$description = '';
$duration = 1;

if ($package_id) {
    $result = mysqli_query($conn, "SELECT * FROM package WHERE id = $package_id");
    if ($result && mysqli_num_rows($result) > 0) {
        $package = mysqli_fetch_assoc($result);
        $description = $package['descriptions'];
        $duration = (int) $package['duration'];

        // Get first sentence as title
        $parts = explode('.', $description, 2);
        $title = trim($parts[0]) . '.';
    } else {
        die("Package not found.");
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrival_date = $_POST['arrival_date'];
    $check_out = $_POST['check_out'];
    $people_count = (int)$_POST['people_count'];

    if ($people_count < 1 || $people_count > 2) {
        header("Location: book_package.php?msg=Invalid+number+of+people");
        exit;
    }

    // Get a random admin_id
    $admin_result = mysqli_query($conn, "SELECT id FROM admin ORDER BY RAND() LIMIT 1");
    $admin = mysqli_fetch_assoc($admin_result);
    $admin_id = $admin['id'] ?? null;

    if ($admin_id) {
        $stmt = $conn->prepare("INSERT INTO bookings (booking_date, arrival_date, people_count, customer_id, package_id, check_out, admin_id) VALUES (CURDATE(), ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiisi", $arrival_date, $people_count, $customer_id, $package_id, $check_out, $admin_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();

            // Decrease package availability by 1 (only if availability > 0)
            $updateAvailability = "UPDATE package SET availability = availability - 1 WHERE id = $package_id AND availability > 0";
            mysqli_query($conn, $updateAvailability);

            echo "<script>alert('Booking successful! You will be redirected to your profile where you can see the bookings'); window.location.href='user_profile.php';</script>";
        } else {
            $stmt->close();
            echo "<script>alert('Booking failed. Try again.');</script>";
        }
    } else {
        die("No admin found.");
    }
}
?>

<?php include("things/top.php"); ?>

<body class="bg-gray-100">
<?php include("things/navbar.php"); ?>

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-center text-orange-300 text-3xl">Package Details</h1>
    <h3 class="text-2xl font-semibold mb-4 text-center text-blue-700 w-full">
        <?php echo htmlspecialchars($title); ?>
    </h3>

    <div class="bg-gray-50 border border-gray-300 p-4 rounded mb-6 shadow-sm">
        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
            <?php echo htmlspecialchars($description); ?>
        </p>
    </div>

    <form method="POST">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Arrival Date:</label>
            <input type="date" name="arrival_date" id="arrival_date" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Check-Out Date:</label>
            <input type="date" name="check_out" id="check_out" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Number of People:</label>
            <select name="people_count" required class="w-full border px-3 py-2 rounded">
                <option value="1">1 Person</option>
                <option value="2">2 People (Max)</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
            Confirm Booking
        </button>
    </form>
</div>

<script>
document.getElementById('arrival_date').addEventListener('change', function () {
    const arrivalDate = new Date(this.value);
    const tripDuration = <?= $duration ?>;

    if (!isNaN(arrivalDate.getTime())) {
        arrivalDate.setDate(arrivalDate.getDate() + tripDuration);
        const yyyy = arrivalDate.getFullYear();
        const mm = String(arrivalDate.getMonth() + 1).padStart(2, '0');
        const dd = String(arrivalDate.getDate()).padStart(2, '0');
        document.getElementById('check_out').value = `${yyyy}-${mm}-${dd}`;
    } else {
        document.getElementById('check_out').value = '';
    }
});
</script>

<?php include("things/footer.php"); ?>
</body>
</html>
