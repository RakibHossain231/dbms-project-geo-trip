
<?php 
include('things/db_connect.php');
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head> -->
<?php include 'things/top.php'  ?>
<body class="bg-gray-100 text-gray-800">
<?php include 'things/navbar.php'  ?>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-700">Travel Packages</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $query = "SELECT * FROM package";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) 
            {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $img = (!empty($row['image_url']) && file_exists($row['image_url'])) ? $row['image_url'] : 'cardPhoto/default.png';

                    // Truncate description to 250 characters
                    $description = htmlspecialchars($row['descriptions']);
                    $truncated_description = substr($description, 0, 250);
                    if (strlen($description) > 250) {
                        $truncated_description .= '...'; // Add ellipsis if description is truncated
                    }

                    // Display the package card
                    echo '<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                            <img src="' . $img . '" alt="Package Photo" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-blue-800 mb-2">Price: ৳' . htmlspecialchars($row['price']) . '</h2>
                                <p class="text-sm text-gray-600 mb-2">Duration: ' . htmlspecialchars($row['duration']) . ' days</p>
                                <p class="text-sm text-gray-600 mb-4" id="desc-' . $row['id'] . '">' . $truncated_description . '</p>

                                <!-- View More as Text (Like a Link) -->
                                <p onclick="toggleDescription(' . $row['id'] . ')" class="text-blue-500 hover:underline cursor-pointer mb-4" id="btn-' . $row['id'] . '">See more</p>

                                <!-- Full description hidden by default -->
                                <div id="full-desc-' . $row['id'] . '" class="hidden">
                                    <p class="text-sm text-gray-600 mb-4">' . nl2br($description) . '</p> <!-- Full description -->
                                </div>

                                <div class="flex justify-between items-center">
                                    <a href="book_package.php?id=' . $row['id'] . '" class="text-white bg-green-500 px-3 py-1 rounded hover:bg-green-200">Book Now</a>
                                </div>
                            </div>
                        </div>';
                }
            } 
            else 
            {
                echo '<p class="text-center col-span-3 text-gray-500">No packages found.</p>';
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
    <!-- Add Go Back Button with modified styling -->
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
        <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
            Go Back
        </button>
    </div>

</body>
<?php include 'things/footer.php'  ?>

</html>