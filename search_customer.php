<?php include 'things/top.php'; ?>

<body>
    <?php
    include('things/db_connect.php'); // Include database connection
    include 'things/navbar.php'; // Include navbar
    ?>

    <!-- Search Form -->
    <div class="search-container">
        <form method="GET" action="">
            <label for="search_type">Select Search Type:</label>
            <select name="search_type" id="search_type">
                <option value="passport" selected>Passport ID</option>
                <option value="name">First Name</option>
            </select>
            <input type="text" name="search_value" required placeholder="Enter Passport ID or First Name" class="search-box">
            <button type="submit" name="search" class="search-btn">Search</button>
        </form>
    </div>

    <?php
    // If the search form is submitted
    if (isset($_GET['search'])) {
        $search_value = $_GET['search_value'];
        $search_type = $_GET['search_type'];

        // Conditional search based on selected type
        if ($search_type == 'passport') {
            // Search by passport ID
            $query = "SELECT * FROM customer WHERE pp_no='$search_value'";
        } else {
            // Search by first name
            $query = "SELECT * FROM customer WHERE f_name LIKE '%$search_value%'";
        }

        // Fetch the customer data from the database
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Output customer details inside the tbody
            echo "<table class='result-table'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Passport ID</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Nationality</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>User Name</th>
                            <th>Total Paid Bookings</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Iterate through the results and display in table rows
            while ($row = mysqli_fetch_assoc($result)) {
                $customer_id = $row['customerID'];  // Verify if this column exists
                // Query to count the PAID bookings for the customer
                $booking_query = "SELECT COUNT(*) AS total_paid FROM bookings WHERE customer_id='$customer_id' AND payment_status='verified'";
                $booking_result = mysqli_query($conn, $booking_query);
                $booking_row = mysqli_fetch_assoc($booking_result);
                $total_paid = $booking_row['total_paid'];

                // Display customer data in table
                echo "<tr>
                        <td>" . $row['f_name'] . " " . $row['l_name'] . "</td>
                        <td>" . $row['pp_no'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['nationality'] . "</td>
                        <td>" . $row['dob'] . "</td>
                        <td>" . $row['gender'] . "</td>
                        <td>" . $row['user_name'] . "</td>
                        <td>" . $total_paid . "</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            // Show "No results found!" message inside a styled box
            echo "<div class='no-results'>No results found!</div>";
        }
    }
    ?>

    <!-- Results Table -->
    <div class="results-container">
        <!-- Results will be displayed here -->
    </div>

    <!-- CSS Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .search-container {
            background-color: #fff;
            padding: 25px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 70%;
            margin: 20px auto;
        }

        .search-container form {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
        }

        .search-container label {
            font-size: 16px;
            color: #333;
        }

        .search-container input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 250px;
            max-width: 100%;
        }

        .search-container select {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 180px;
        }

        .search-container button {
            padding: 12px 18px;
            background-color: #28a745;
            color: white;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #218838;
        }

        .result-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .result-table thead {
            background-color: #f8f9fa;
        }

        .result-table th,
        .result-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .result-table th {
            background-color: #007bff;
            color: white;
        }

        .result-table td {
            background-color: white;
        }

        .result-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .results-container {
            margin: 20px;
        }

        /* No results found styling */
        .no-results {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            text-align: center;
            width: 70%;
            margin: 20px auto;
            border-radius: 8px;
        }
    </style>
    <!-- Add Go Back Button with modified styling -->
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; padding-right: 20px;">
        <button onclick="window.history.back()" style="background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
            Go Back
        </button>
    </div>
</body>

<?php include 'things/footer.php'; ?>
