<?php
require 'things/db_connect.php';
$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $country = strtoupper(trim($_POST['country']));
    $city = strtoupper(trim($_POST['city']));

    if (!empty($country) && !empty($city)) {
        $stmt = $conn->prepare("INSERT INTO locations (country, city) VALUES (?, ?)");
        $stmt->bind_param("ss", $country, $city);
        if ($stmt->execute()) {
            $success = "City added successfully!";
        } else {
            $error = "Failed to add city. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}

// Fetch unique countries for dropdown
$countries = [];
$query = "SELECT DISTINCT country FROM locations ORDER BY country ASC";
$res = mysqli_query($conn, $query);

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $countries[] = $row['country'];
    }
} else {
    $error = "Error fetching countries: " . mysqli_error($conn);
}
?>
<?php include 'things/top.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New City</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen ">
    <?php include 'things/navbar.php' ?>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md mx-auto my-4">
        <h2 class="text-2xl font-semibold text-blue-700 mb-6 text-center">Add New City <i class="fa-solid fa-location-dot"></i></h2>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="block mb-2 text-sm font-medium text-gray-700">Select Country</label>
            <select name="country" required
                class="w-full p-2 border border-gray-300 rounded mb-4">
                <option value="">-- Choose Country --</option>
                <?php foreach ($countries as $c): ?>
                    <option value="<?= htmlspecialchars($c) ?>"><?= htmlspecialchars($c) ?></option>
                <?php endforeach; ?>
            </select>

            <label class="block mb-2 text-sm font-medium text-gray-700">City Name</label>
            <input type="text" name="city" placeholder="Enter new city name" required
                class="w-full p-2 border border-gray-300 rounded mb-6">

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Add City</button>
        </form>
    </div>

</body>
<?php  include 'things/footer.php' ?>
</html>
