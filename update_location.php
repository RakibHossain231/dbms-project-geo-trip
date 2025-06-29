<?php
session_start();
include 'things/db_connect.php';

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'admin') {
    header("Location: admin_login.php?msg=Unauthorized+access");
    exit;
}

// Fetch all locations for the dropdown
$locations_result = mysqli_query($conn, "SELECT location_id, country, city FROM locations");
$locations = $locations_result ? mysqli_fetch_all($locations_result, MYSQLI_ASSOC) : [];

$location_data = null;
$success_msg = '';
$error_msg = '';

// If a location is selected
if (isset($_GET['location_id'])) {
    $location_id = (int)$_GET['location_id'];
    $stmt = $conn->prepare("SELECT * FROM locations WHERE location_id = ?");
    $stmt->bind_param("i", $location_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $location_data = $result->fetch_assoc();
}

// Handle the update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_location'])) {
    $id = (int)$_POST['location_id'];
    $country = strtoupper(trim($_POST['country']));
    $city = strtoupper(trim($_POST['city']));

    $stmt = $conn->prepare("UPDATE locations SET country = ?, city = ? WHERE location_id = ?");
    $stmt->bind_param("ssi", $country, $city, $id);

    if ($stmt->execute()) {
        $success_msg = "Location updated successfully.";
        $location_data = null;
    } else {
        $error_msg = "Update failed: " . $stmt->error;
    }
}
?>

<?php include 'things/top.php'; ?>
<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php'; ?>

<div class="max-w-4xl mx-auto p-6 mt-8 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-center">Update Location</h2>

    <?php if ($success_msg): ?>
        <p class="text-green-600 text-center font-medium mb-4"><?= $success_msg ?></p>
    <?php elseif ($error_msg): ?>
        <p class="text-red-600 text-center font-medium mb-4"><?= $error_msg ?></p>
    <?php endif; ?>

    <!-- Location Selector -->
    <form method="GET" class="mb-6 text-center">
        <label for="location_id" class="block text-sm font-medium text-gray-700 mb-1">Select a Location</label>
        <select name="location_id" id="location_id" onchange="this.form.submit()"
            class="w-full max-w-md mx-auto px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            <option value="">-- Select Location --</option>
            <?php foreach ($locations as $loc): ?>
                <option value="<?= $loc['location_id'] ?>" <?= isset($_GET['location_id']) && $_GET['location_id'] == $loc['location_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($loc['country']) ?>, <?= htmlspecialchars($loc['city']) ?> (ID: <?= $loc['location_id'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Update Form -->
    <?php if ($location_data): ?>
    <form method="POST" class="space-y-6">
        <input type="hidden" name="location_id" value="<?= $location_data['location_id'] ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Country</label>
                <input type="text" name="country" value="<?= htmlspecialchars($location_data['country']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">City</label>
                <input type="text" name="city" value="<?= htmlspecialchars($location_data['city']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" name="update_location"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">
                Update Location
            </button>
        </div>
    </form>
    <?php endif; ?>
</div>

</body>
<?php include 'things/footer.php'; ?>
</html>
