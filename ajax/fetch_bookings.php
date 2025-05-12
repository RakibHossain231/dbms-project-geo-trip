<?php
include('../things/db_connect.php');

// Get the status from the AJAX request
$status = isset($_POST['status']) ? $_POST['status'] : '';  // Default to empty, as no selection will show nothing

// SQL query based on the status
if ($status == 'default') {
    // If no status is selected, do not show any records
    echo '<div class="bg-red-100 text-red-600 p-5 border border-red-300 rounded-md shadow-md text-center font-large w-1/2 mx-auto">
            <span class="font-semibold">Please select a booking status to view results.</span>
        </div>';
    exit;
}
elseif ($status == 'verified') {
    $query = "SELECT * FROM bookings WHERE payment_status = 'verified'";
} elseif ($status == 'pending') {
    $query = "SELECT * FROM bookings WHERE payment_status = 'pending'";
} elseif ($status == 'NULL') {
    $query = "SELECT * FROM bookings WHERE payment_status IS NULL";
} else {
    $query = "SELECT * FROM bookings WHERE payment_status IN ('verified', 'pending') OR payment_status IS NULL";
}

$result = mysqli_query($conn, $query);

// Output the rows as a table
if (mysqli_num_rows($result) > 0) {
    echo '<table class="min-w-full bg-white table-auto border-collapse">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="py-2 px-4">Serial No.</th>  <!-- Added Serial Number Column -->
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Booking Date</th>
                    <th class="py-2 px-4">Arrival Date</th>
                    <th class="py-2 px-4">People Count</th>
                    <th class="py-2 px-4">Cancellation ID</th>
                    <th class="py-2 px-4">Payment ID</th>
                    <th class="py-2 px-4">Admin ID</th>
                    <th class="py-2 px-4">Customer ID</th>
                    <th class="py-2 px-4">Package ID</th>
                    <th class="py-2 px-4">Check Out</th>
                    <th class="py-2 px-4">Payment Status</th>
                </tr>
            </thead>
            <tbody>';

    // Initialize serial number counter
    $serialNo = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="border-b">
                <td class="py-2 px-4">' . $serialNo++ . '</td>  <!-- Display Serial Number -->
                <td class="py-2 px-4">' . $row['id'] . '</td>
                <td class="py-2 px-4">' . $row['booking_date'] . '</td>
                <td class="py-2 px-4">' . $row['arrival_date'] . '</td>
                <td class="py-2 px-4">' . $row['people_count'] . '</td>
                <td class="py-2 px-4">' . $row['cancellation_id'] . '</td>
                <td class="py-2 px-4">' . $row['payment_id'] . '</td>
                <td class="py-2 px-4">' . $row['admin_id'] . '</td>
                <td class="py-2 px-4">' . $row['customer_id'] . '</td>
                <td class="py-2 px-4">' . $row['package_id'] . '</td>
                <td class="py-2 px-4">' . $row['check_out'] . '</td>
                <td class="py-2 px-4">' . ($row['payment_status'] ? $row['payment_status'] : 'Not Set') . '</td>
              </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="bg-red-100 text-red-700 p-4 border border-red-300 rounded-md shadow-md text-center font-medium w-1/2 mx-auto">
            <span class="font-semibold">No bookings found</span> for the selected status. Please try selecting another status or check back later.
          </div>';
}
?>
