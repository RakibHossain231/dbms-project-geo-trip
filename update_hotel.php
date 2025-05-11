<?php
session_start();
include 'things/db_connect.php';

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'admin') {
    header("Location: admin_login.php?msg=Unauthorized+access");
    exit;
}

// Fetch all hotels for dropdown
$hotels_result = mysqli_query($conn, "SELECT id, name FROM hotels");
$hotels = $hotels_result ? mysqli_fetch_all($hotels_result, MYSQLI_ASSOC) : [];

// Fetch affiliates
$affiliate_result = mysqli_query($conn, "SELECT id FROM affiliate");
$affiliates = $affiliate_result ? mysqli_fetch_all($affiliate_result, MYSQLI_ASSOC) : [];

// Fetch locations
$location_result = mysqli_query($conn, "SELECT location_id, country, city FROM locations");
$locations = $location_result ? mysqli_fetch_all($location_result, MYSQLI_ASSOC) : [];

// Variables
$hotel_data = null;
$success_msg = '';
$error_msg = '';

// If hotel ID is selected
if (isset($_GET['hotel_id'])) {
    $hotel_id = (int)$_GET['hotel_id'];
    $stmt = $conn->prepare("SELECT * FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel_data = $result->fetch_assoc();
}

// If update form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hotel'])) {
    $id = (int)$_POST['hotel_id'];
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $stars = (int)$_POST['stars'];
    $availability = (int)$_POST['availability'];
    $affiliate_id = (int)$_POST['affiliate_id'];
    $location_id = (int)$_POST['location_id'];

    $stmt = $conn->prepare("UPDATE hotels SET name = ?, address = ?, stars = ?, availability = ?, affiliate_id = ?, location_id = ? WHERE id = ?");
    $stmt->bind_param("ssiiiii", $name, $address, $stars, $availability, $affiliate_id, $location_id, $id);

    if ($stmt->execute()) {
        $success_msg = "Hotel updated successfully.";
        $hotel_data = null;
    } else {
        $error_msg = "Update failed: " . $stmt->error;
    }
}
?>

<?php include 'things/top.php'; ?>
<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php'; ?>

<div class="max-w-4xl mx-auto p-6 mt-8 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-center">Update Hotel Details</h2>

    <?php if ($success_msg): ?>
        <p class="text-green-600 text-center font-medium mb-4"><?= $success_msg ?></p>
    <?php elseif ($error_msg): ?>
        <p class="text-red-600 text-center font-medium mb-4"><?= $error_msg ?></p>
    <?php endif; ?>

    <!-- Hotel Selector -->
    <form method="GET" class="mb-6 text-center">
        <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Select a Hotel to Update</label>
        <select name="hotel_id" id="hotel_id" onchange="this.form.submit()"
            class="w-full max-w-md mx-auto px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            <option value="">-- Select Hotel --</option>
            <?php foreach ($hotels as $h): ?>
                <option value="<?= $h['id'] ?>" <?= isset($_GET['hotel_id']) && $_GET['hotel_id'] == $h['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($h['name']) ?> (ID: <?= $h['id'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Update Form -->
    <?php if ($hotel_data): ?>
    <form method="POST" class="space-y-6">
        <input type="hidden" name="hotel_id" value="<?= $hotel_data['id'] ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Hotel Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($hotel_data['name']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($hotel_data['address']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stars</label>
                <input type="number" name="stars" value="<?= $hotel_data['stars'] ?>" min="1" max="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Availability</label>
                <input type="number" name="availability" value="<?= $hotel_data['availability'] ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Affiliate ID</label>
                <select name="affiliate_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Select Affiliate</option>
                    <?php foreach ($affiliates as $a): ?>
                        <option value="<?= $a['id'] ?>" <?= $hotel_data['affiliate_id'] == $a['id'] ? 'selected' : '' ?>>
                            <?= $a['id'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <select name="location_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Select Location</option>
                    <?php foreach ($locations as $l): ?>
                        <option value="<?= $l['location_id'] ?>" <?= $hotel_data['location_id'] == $l['location_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($l['country']) ?>, <?= htmlspecialchars($l['city']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" name="update_hotel"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">
                Update Hotel
            </button>
        </div>
    </form>
    <?php endif; ?>
</div>

</body>
<?php include 'things/footer.php'; ?>
</html>
