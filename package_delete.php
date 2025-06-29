<?php
// Include database connection
include('things/db_connect.php');


// Start session for success message
session_start();

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) 
{
    $package_id = $_GET['id'];

    // Escape the ID to prevent SQL injection
    $package_id = mysqli_real_escape_string($conn, $package_id);

    // Start a transaction to ensure all deletes happen together
    $conn->begin_transaction();

    try {
        // Step 1: Delete the package from package_location table
        $sql_delete_location = "DELETE FROM package_location WHERE package_id = $package_id";
        if ($conn->query($sql_delete_location) === TRUE) 
        {
            // Step 2: Delete the package from package_hotel table
            $sql_delete_hotel = "DELETE FROM package_hotel WHERE package_id = $package_id";
            if ($conn->query($sql_delete_hotel) === TRUE) 
            {
                // Step 3: Now delete the package from the package table
                $sql_delete_package = "DELETE FROM package WHERE id = $package_id";
                if ($conn->query($sql_delete_package) === TRUE)
                {
                    $conn->commit();  // Commit the transaction

                    // Set success message and redirect
                    $_SESSION['success_message'] = "Package deleted successfully!";
                    header("Location: package_list.php");
                    exit();
                } 
                else 
                {
                    $conn->rollback();  // Rollback if there is an error in deleting the package
                    echo "Error deleting package from the package table: " . $conn->error;
                }
            } 
            else 
            {
                $conn->rollback();  // Rollback if there is an error in deleting the hotel record
                echo "Error deleting package from hotel association: " . $conn->error;
            }
        } 
        else 
        {
            $conn->rollback();  // Rollback if there is an error in deleting the location record
            echo "Error deleting package from location association: " . $conn->error;
        }
    } 
    catch (Exception $e) 
    {
        $conn->rollback();  // Rollback in case of any other error
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
} 
else 
{
    echo "No package ID provided!";
}
?>
