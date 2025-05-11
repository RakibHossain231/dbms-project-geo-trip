<?php
include('../things/db_connect.php');

$price = $_POST['price'];
$duration = $_POST['duration'];
$descriptions = mysqli_real_escape_string($conn, $_POST['descriptions']);
$availability = $_POST['availability'];
$commission_rate = $_POST['commission_rate'];
$image_url = $_POST['image_url'];
$location_id = $_POST['location_id'];
$hotel_id = $_POST['hotel_id'];
$start_date = $_POST['start_date'];

$insertPackage = "INSERT INTO package (price, duration, descriptions, availability, commission_rate, image_url, location_id,start_date)
                  VALUES ('$price', '$duration', '$descriptions', '$availability', '$commission_rate', '$image_url', '$location_id','$start_date')";

if (mysqli_query($conn, $insertPackage))
{
    $package_id = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO package_location (location_id, package_id) VALUES ('$location_id', '$package_id')");
    mysqli_query($conn, "INSERT INTO package_hotel (package_id, hotel_id)  VALUES ('$package_id', '$hotel_id') " ) ;

    echo '<div class="bg-green-100 text-green-800 p-4 m-6 rounded">
            ✅ Package created successfully! <a href="../package_creator.php" class="underline text-blue-600">Create another</a>
             OR <a href="../package_list.php" class="underline text-blue-600">Go to list</a>
          </div>';
} 
else 
{
    echo '<div class="bg-red-100 text-red-800 p-4 m-6 rounded">
            ❌ Failed to save package: ' . mysqli_error($conn) . '
          </div>';
}

mysqli_close($conn);
?>
