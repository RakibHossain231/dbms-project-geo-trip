<?php
// Include database connection
include('things/db_connect.php');

// Check if the package ID is provided
if (isset($_GET['id'])) 
{
    $package_id = $_GET['id'];

    // Escape the id to prevent SQL injection
    $package_id = mysqli_real_escape_string($conn, $package_id);

    // Fetch existing data of the package
    $sql = "SELECT * FROM package WHERE id = $package_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {
        $package = $result->fetch_assoc();
    } 
    else 
    {
        die("Package not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Get updated data from the form
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    $commission_rate = mysqli_real_escape_string($conn, $_POST['commission_rate']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $start_date = $package['start_date']; // Keep the existing start_date
    
    // Update query with the automatic calculation of expire_date
    $update_sql = "UPDATE package SET
                    price = '$price',
                    duration = '$duration',
                    descriptions = '$description',
                    availability = '$availability',
                    commission_rate = '$commission_rate',
                    image_url = '$image_url',
                    expiry_date = DATE_ADD('$start_date', INTERVAL $duration DAY) 
                    WHERE id = $package_id";
    
    if ($conn->query($update_sql) === TRUE) 
    {
        session_start();
        $_SESSION['success_message'] = "Package updated successfully!";
        header("Location: package_list.php");
        exit();
    } 
    else 
    {
        echo "Error updating package: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php include 'things/top.php'  ?>
<body class="bg-gray-100">
    <?php include 'things/navbar.php'  ?>
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg space-y-6">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Update Package</h2>

        <form method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price Field -->
                <div class="flex flex-col">
                    <label for="price" class="block text-sm font-medium text-gray-800">Price</label>
                    <input type="text" id="price" name="price" value="<?= $package['price'] ?>" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Duration Field -->
                <div class="flex flex-col">
                    <label for="duration" class="block text-sm font-medium text-gray-800">Duration (days)</label>
                    <input type="number" id="duration" name="duration" value="<?= $package['duration'] ?>" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Description Field -->
                <div class="flex flex-col col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-800">Description</label>
                    <textarea id="description" name="description" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500"><?= $package['descriptions'] ?></textarea>
                </div>

                <!-- Availability Field -->
                <div class="flex flex-col">
                    <label for="availability" class="block text-sm font-medium text-gray-800">Availability</label>
                    <input type="number" id="availability" name="availability" value="<?= $package['availability'] ?>" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Commission Rate Field -->
                <div class="flex flex-col">
                    <label for="commission_rate" class="block text-sm font-medium text-gray-800">Commission Rate</label>
                    <input type="text" id="commission_rate" name="commission_rate" value="<?= $package['commission_rate'] ?>" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Image URL Field -->
                <div class="flex flex-col col-span-2">
                    <label for="image_url" class="block text-sm font-medium text-gray-800">Image URL</label>
                    <input type="text" id="image_url" name="image_url" value="<?= $package['image_url'] ?>" class="mt-2 px-4 py-3 border rounded-md w-full shadow-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-8">
                <button type="submit" class="px-8 py-4 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none transition-all">
                    Update Package
                </button>
            </div>
        </form>
    </div>
    
    <!-- Back Button add -->
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
      <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
          Go Back
      </button>
    </div>
</body>
<?php include 'things/footer.php'  ?>
</html>
