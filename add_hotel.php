<?php
session_start();
include 'things/db_connect.php';

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'admin') {
    header("Location: admin_login.php?msg=Unauthorized+access");
    exit;
}

// Fetch all current hotels
$hotel_query = "SELECT * FROM hotels";
$hotels_result = mysqli_query($conn, $hotel_query);
$hotel_data = $hotels_result ? mysqli_fetch_all($hotels_result, MYSQLI_ASSOC) : [];

// Fetch all affiliates
$affiliate_query = "SELECT id FROM affiliate";
$affiliate_result = mysqli_query($conn, $affiliate_query);
$affiliates = $affiliate_result ? mysqli_fetch_all($affiliate_result, MYSQLI_ASSOC) : [];

// Fetch all locations
$location_query = "SELECT location_id, country, city FROM locations";
$location_result = mysqli_query($conn, $location_query);
$locations = $location_result ? mysqli_fetch_all($location_result, MYSQLI_ASSOC) : [];

// Build a map of location_id to country, city
$location_map = [];
foreach ($locations as $loc) {
    $location_map[$loc['location_id']] = $loc['country'] . ", " . $loc['city'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $stars = (int)$_POST['stars'];
    $availability = (int)$_POST['availability'];
    $affiliate_id = (int)$_POST['affiliate_id'];
    $location_id = (int)$_POST['location_id'];

    $stmt = $conn->prepare("INSERT INTO hotels (name, address, stars, availability, affiliate_id, location_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiii", $name, $address, $stars, $availability, $affiliate_id, $location_id);

    if ($stmt->execute()) {
        header("Location: add_hotel.php?msg=Hotel+added+successfully");
        exit;
    } else {
        $error = "Failed to add hotel: " . $stmt->error;
    }
}
?>

<?php include 'things/top.php'; ?>

<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php'; ?>

<h1 class="text-center mt-4 text-xl font-bold text-green-600 blink">
    <?= !empty($_GET['msg']) ? htmlspecialchars($_GET['msg']) : '' ?>
</h1>
<?php if (!empty($error)): ?>
    <p class="text-center text-red-500"><?= $error ?></p>
<?php endif; ?>

<!-- Show all hotels -->
<section class="max-w-6xl mx-auto p-4 mt-6">
    <h2 class="text-2xl font-semibold mb-4 text-center">Current Hotels</h2>
    <?php if (count($hotel_data) > 0): ?>
        <div class="overflow-x-auto bg-white shadow border rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-800">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Address</th>
                        <th class="px-6 py-3">Stars</th>
                        <th class="px-6 py-3">Available Seats</th>
                        <th class="px-6 py-3">Affiliate ID</th>
                        <th class="px-6 py-3">Location</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($hotel_data as $hotel): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?= $hotel['id'] ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($hotel['name']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($hotel['address']) ?></td>
                            <td class="px-6 py-4"><?= $hotel['stars'] ?></td>
                            <td class="px-6 py-4"><?= $hotel['availability'] ?></td>
                            <td class="px-6 py-4"><?= $hotel['affiliate_id'] ?></td>
                            <td class="px-6 py-4">
                                <?= isset($location_map[$hotel['location_id']]) ? htmlspecialchars($location_map[$hotel['location_id']]) : 'Unknown' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center text-red-500 mt-4">No hotels found.</div>
    <?php endif; ?>
</section>

<!-- Add Hotel Form -->
<section class="max-w-4xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-center">Add New Hotel</h2>
    <form method="POST" action="add_hotel.php" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block mb-1 text-sm font-medium">Hotel Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label for="address" class="block mb-1 text-sm font-medium">Address</label>
                <input type="text" name="address" id="address" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label for="stars" class="block mb-1 text-sm font-medium">Stars</label>
                <input type="number" name="stars" id="stars" min="1" max="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label for="availability" class="block mb-1 text-sm font-medium">Availability (Seats)</label>
                <input type="number" name="availability" id="availability" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label for="affiliate_id" class="block mb-1 text-sm font-medium">Affiliate ID</label>
                <select name="affiliate_id" id="affiliate_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Select Affiliate</option>
                    <?php foreach ($affiliates as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['id'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="location_id" class="block mb-1 text-sm font-medium">Location</label>
                <select name="location_id" id="location_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">Select Location</option>
                    <?php foreach ($location_map as $id => $label): ?>
                        <option value="<?= $id ?>"><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">
                Add Hotel
            </button>
        </div>
    </form>
</section>

</body>

<?php include 'things/footer.php'; ?>
</html>
