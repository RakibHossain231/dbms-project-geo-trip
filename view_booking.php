<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Add jQuery -->
</head>
<?php include 'things/top.php'  ?>
<body class="bg-gray-100">
    <?php include 'things/navbar.php'  ?>
    <div class="max-w-6xl mx-auto my-8 p-4 bg-white shadow-lg rounded-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">View Booking</h1>

        <!-- Dropdown Menu for Status -->
        <div class="flex justify-center space-x-8 mb-6">
            <div class="relative inline-block w-64">
                <select id="searchType" class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="default" disabled selected>Select a Booking Status</option> <!-- Default 'Please Select' option -->
                    <option value="verified" class="bg-green-100 text-green-800 hover:bg-green-200">Verified Booking</option>
                    <option value="pending" class="bg-yellow-100 text-yellow-800 hover:bg-yellow-200">Pending Booking</option>
                    <option value="NULL" class="bg-gray-100 text-gray-800 hover:bg-gray-200">Null Payment Booking</option>
                    <option value="all" class="bg-blue-100 text-blue-800 hover:bg-blue-200">All Bookings</option>
                </select>
            </div>
        </div>

        <!-- Initial Empty Output -->
        <div id="bookingTable">
            <!-- Table will be populated here once an option is selected -->
        </div>


    <script>
        $(document).ready(function() {
            // On page load, load the verified bookings by default
            loadBookings('default');

            // On dropdown change, load the selected status bookings
            $('#searchType').change(function() {
                var status = $(this).val();
                loadBookings(status);
            });

            function loadBookings(status) {
                $.ajax({
                    url: 'ajax/fetch_bookings.php',
                    type: 'POST',
                    data: {status: status},
                    success: function(response) {
                        $('#bookingTable').html(response);
                    }
                });
            }
        });
    </script>

</body>
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
      <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
          Go Back
      </button>
    </div>
    <?php include 'things/footer.php'  ?>
</html>
