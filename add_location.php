<?php
session_start();
include 'things/db_connect.php';
if (empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type'] !== 'admin')) {
    header("Location: admin_login.php?msg=You+must+be+a+customer+to+Make+a+booking+for+the+package");
}
if (!isset($_POST['submit'])) {
    include 'things/db_connect.php';
    $location_query = 'SELECT * FROM locations;';
    $result = mysqli_query($conn, $location_query);
    if (!$result) {
        echo "Database Error" . mysqli_error($conn);
    } else {
        $location_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
} else {
    $country = mysqli_escape_string($conn, strtoupper($_POST['country']));
    $city = mysqli_escape_string($conn,strtoupper($_POST['city']));
    $query = "SELECT * FROM locations where country = '$country' and city = '$city'  ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header("Location:add_location.php?msg=Location+already+exists");
        exit;
    } else {
        $insert_query = "INSERT INTO LOCATIONS (country,city) VALUES ('$country','$city') ";
        $result = mysqli_query($conn, $insert_query);
        if (!$result) {
            echo "Insertion Error" . mysqli_errno($conn);
        } else {
            header("Location:add_location.php?msg=Location+added+successfully");
            exit;
        }
    }
}
?>

<?php include 'things/top.php' ?>

<body class="bg-gray-100 text-gray-800">
    <?php include 'things/navbar.php' ?>
    <h1 class="blink text-center p-2 bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent text-2xl font-bold mt-2">
        <?php if(!empty($_GET['msg'])){
            echo $_GET['msg'];
        } ?>
    </h1>
    <!-- location showing section -->
    <section class="max-w-6xl mx-auto p-4 mt-10">
        <h1 class="text-2xl font-semibold mb-6 text-center">Available Locations</h1>

        <?php if (isset($location_data) && mysqli_num_rows($result) > 0): ?>
            <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200 bg-white">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-3">Location ID</th>
                            <th class="px-6 py-3">Country</th>
                            <th class="px-6 py-3">City</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($location_data as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4"><?= $row['location_id'] ?></td>
                                <td class="px-6 py-4"><?= $row['country'] ?></td>
                                <td class="px-6 py-4"><?= $row['city'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center text-red-600 font-semibold mt-4">No Location Present In the Database</div>
        <?php endif; ?>
    </section>
    <!-- New Location Adding Form -->
    <section class="max-w-4xl mx-auto p-6 mt-10 bg-teal-50 shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-center">Add New Location</h2>
        <form action="add_location.php" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="country" class="block mb-1 text-sm font-medium text-gray-700">Country</label>
                    <input type="text" id="country" name="country" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label for="city" class="block mb-1 text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="city" name="city" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>
            <div class="text-center">
                <input type="submit" name='submit' class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition" value="Add location">
            </div>
        </form>
    </section>

</body>

<?php include 'things/footer.php' ?>

</html>