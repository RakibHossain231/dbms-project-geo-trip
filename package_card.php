<?php
include('things/db_connect.php');

// Fetch all packages with hotel and location details
$query = "SELECT package.id, package.descriptions, package.price, package.duration, 
                 package.availability, package.commission_rate, package.image_url, 
                 hotels.name AS hotel_name, locations.country AS country, locations.city AS city
          FROM package
          JOIN package_hotel ON package.id = package_hotel.package_id
          JOIN hotels ON package_hotel.hotel_id = hotels.id
          JOIN package_location ON package.id = package_location.package_id
          JOIN locations ON package_location.location_id = locations.location_id";
$result = mysqli_query($conn, $query);

// Check if the query was successful and there are packages
if ($result && mysqli_num_rows($result) > 0) {
    $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'No packages available.';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'things/top.php'  ?>
<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php'  ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-700">Travel Packages</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            // Loop through each package and display it as a card
            foreach ($packages as $row) {
                // Extract the first few words from the descriptions for the headline
                $description_words = explode(' ', $row['descriptions']);
                $headline = $row['city'] . ", " . $row['country'];

                // Checking if 'descriptions' exists in the array
                $image_url = isset($row['image_url']) ? htmlspecialchars($row['image_url']) : 'default_image_url.jpg';
                $price = isset($row['price']) ? htmlspecialchars($row['price']) : 'N/A';
                $descriptions = isset($row['descriptions']) ? htmlspecialchars($row['descriptions']) : 'No description available';
                $duration = isset($row['duration']) ? htmlspecialchars($row['duration']) : 'N/A';
                $availability = isset($row['availability']) ? htmlspecialchars($row['availability']) : 'N/A';
                $commission_rate = isset($row['commission_rate']) ? htmlspecialchars($row['commission_rate']) : 'N/A';

                $short_description = substr($descriptions, 0, 100); // Limit the description to 200 characters for two lines
                if (strlen($descriptions) > 100) {
                    $short_description .= '...'; // Add ellipsis if the description is too long
                }
                echo '<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                        <img src="' . $image_url . '" alt="Package Photo" class="w-full h-48 object-cover">
                        <div class="p-6 flex-grow">
                            <h2 class="text-xl font-semibold text-blue-800 mb-2">' . $headline . '</h2>
                            <p class="text-sm text-gray-600 mb-2">Price: ৳' . $price . '</p>
                            <p class="text-sm text-gray-600 mb-4">' . $short_description . '</p>

                            <!-- View More and Book Now Buttons -->
                            <div class="flex justify-between">
                                <button onclick="document.getElementById(\'more-info-' . $row['id'] . '\').classList.toggle(\'hidden\');" class="text-blue-500 hover:underline mb-4">View More</button>

                                <!-- Booking Button aligned to the right -->
                                <a href="book_package.php?id=' . $row['id'] . '" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Book Now
                                </a>
                            </div>

                            <!-- More Info Section -->
                            <div id="more-info-' . $row['id'] . '" class="hidden">
                                <p class="text-sm text-gray-600 mb-4"><strong>Hotel Name:</strong> ' . htmlspecialchars($row['hotel_name']) . '</p>
                                <p class="text-sm text-gray-600 mb-4"><strong>Location:</strong> ' . htmlspecialchars($row['city']) . ', ' . htmlspecialchars($row['country']) . '</p>
                                <p class="text-sm text-gray-600 mb-4"><strong>Duration:</strong> ' . $duration . ' days</p>
                                <p class="text-sm text-gray-600 mb-4"><strong>Availability:</strong> ' . $availability . ' rooms</p>
                                <p class="text-sm text-gray-600 mb-4"><strong>Commission Rate:</strong> ' . $commission_rate . '%</p>
                                <p class="text-sm text-gray-600 mb-4"><strong>Description:</strong> ' . $short_description . '</p>
                                <button onclick="toggleDescription(' . $row['id'] . ')" class="text-blue-500 hover:underline mb-4" id="btn-' . $row['id'] . '">See More</button>
                                <div id="full-desc-' . $row['id'] . '" class="hidden">
                                    <p class="text-sm text-gray-600 mb-4">' . nl2br($descriptions) . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
    <script>
        // Toggle function for the "See More" text
        function toggleDescription(id) {
            var fullDesc = document.getElementById('full-desc-' + id);
            var btn = document.getElementById('btn-' + id);
            if (fullDesc.classList.contains('hidden')) {
                fullDesc.classList.remove('hidden');
                btn.innerHTML = 'See less';  // Change text to 'See less'
            } else {
                fullDesc.classList.add('hidden');
                btn.innerHTML = 'See more';  // Change text back to 'See more'
            }
        }
    </script>
</body>
<?php include 'things/footer.php'  ?>
</html>