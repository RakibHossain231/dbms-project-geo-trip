<?php
include('things/db_connect.php');

$query = "SELECT package.id, package.descriptions, package.price, package.duration,
                 package.availability, package.commission_rate, package.image_url, 
                 hotels.name AS hotel_name, locations.country AS country, locations.city AS city
          FROM package
          JOIN package_hotel ON package.id = package_hotel.package_id
          JOIN hotels ON package_hotel.hotel_id = hotels.id
          JOIN package_location ON package.id = package_location.package_id
          JOIN locations ON package_location.location_id = locations.location_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'No packages available.';
    exit;
}
?>
<?php include 'things/top.php' ?>

<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php' ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8 text-blue-700">Travel Packages</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($packages as $row): 
            $headline = $row['city'] . ", " . $row['country'];
            $image_url = !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'default_image_url.jpg';
            $price = htmlspecialchars($row['price']);
            $duration = htmlspecialchars($row['duration']);
            $descriptions = htmlspecialchars($row['descriptions']);
            $availability = htmlspecialchars($row['availability']);
            $commission_rate = htmlspecialchars($row['commission_rate']);
            $short_description = substr($descriptions, 0, 100) . (strlen($descriptions) > 100 ? '...' : '');
        ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                <img src="<?= $image_url ?>" alt="Package Photo" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2"><?= $headline ?></h2>
                    <p class="text-sm text-gray-600 mb-1"><strong>Trip Duration:</strong> <?= $duration ?> days</p>
                    <p class="text-sm text-gray-600 mb-3"><strong>Price:</strong> ৳<?= $price ?></p>

                    <div class="flex justify-between items-center">
                        <button onclick="openModal(<?= $row['id'] ?>)" class="text-blue-500 hover:underline">View More</button>
                        <a href="book_package.php?id=<?= $row['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20  backdrop-blur-sm">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto relative p-6">
                    <!-- Close Button -->
                    <button onclick="closeModal(<?= $row['id'] ?>)" 
                            class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl font-bold z-10">
                        &times;
                    </button>

                    <div class="pr-2">
                        <h3 class="text-lg font-semibold mb-2"><?= $headline ?> – Full Package Details</h3>
                        <p class="text-sm text-gray-600 mb-2"><strong>Hotel:</strong> <?= htmlspecialchars($row['hotel_name']) ?></p>
                        <p class="text-sm text-gray-600 mb-2"><strong>Availability:</strong> <?= $availability ?> rooms</p>
                        <p class="text-sm text-gray-600 mb-2"><strong>Commission:</strong> <?= $commission_rate ?>%</p>
                        <hr class="my-3">
                        <p class="text-sm text-gray-700 whitespace-pre-line"><?= nl2br($descriptions) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
        document.getElementById('modal-' + id).classList.add('flex');
    }
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
        document.getElementById('modal-' + id).classList.remove('flex');
    }
</script>

<div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
    <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
        Go Back
    </button>
</div>
</body>
<?php include 'things/footer.php' ?>
</html>
