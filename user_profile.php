<?php
session_start();
if (empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type'] !== 'user')) {
  header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
  exit;
} else {
  $customer_id = $_SESSION['id'];
  include 'things/db_connect.php';
  $query = "SELECT * FROM customer WHERE customerId = '$customer_id';";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($result);
}
?>
<?php include 'things/top.php'; ?>

<body class="min-h-screen bg-gradient-to-tr from-yellow-100 via-white to-blue-100 text-gray-900 font-sans tracking-wide">
  <?php include 'things/navbar.php'; ?>
  <!-- Shows the user data -->
  <div class="max-w-md mx-auto mt-6">
    <div class="bg-gradient-to-b from-white to-blue-200 shadow-md rounded-2xl p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-blue-500 mb-4 text-center">Customer Information</h2>
      <hr class="mb-2">
      <div class="space-y-2 text-gray-700 text-md flex flex-col items-center justify-center ">
        <p><span class="font-medium">Customer ID:</span> <?php echo $data['customerID'] ?></p>
        <p><span class="font-medium">First Name:</span> <?php echo $data['f_name'] ?></p>
        <p><span class="font-medium">Last Name:</span> <?php echo $data['l_name'] ?></p>
        <p><span class="font-medium">Date of Birth:</span> <?php echo $data['dob'] ?></p>
        <p><span class="font-medium">Phone:</span> <?php echo $data['phone'] ?></p>
        <p><span class="font-medium">Email:</span> <?php echo $data['email'] ?></p>
        <p><span class="font-medium">Address:</span> <?php echo $data['address'] ?></p>
        <p><span class="font-medium">Nationality:</span> <?php echo $data['nationality'] ?></p>
        <p><span class="font-medium">Passport No:</span> <?php echo $data['pp_no'] ?></p>
        <p><span class="font-medium">Username:</span> <?php echo $data['user_name'] ?></p>
        <p><span class="font-medium">Gender:</span> <?php echo $data['gender'] ?></p>
        <form action="logout.php" method="POST">
          <input type="submit" name="Logout" value="Logout" class="bg-black text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
        </form>
      </div>
    </div>
  </div>
  <!-- Bookings Table -->
  <div class="max-w-5xl mx-auto mt-10 mb-16">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-green-600 mb-4 text-center">Your Bookings</h2>
      <hr class="mb-4">

      <?php
      $bookingQuery = "
      SELECT 
        b.id AS booking_id,
        b.booking_date,
        b.arrival_date,
        b.check_out,
        b.people_count,
        b.payment_status,
        p.price,
        p.descriptions,
        b.package_id
      FROM bookings b
      JOIN package p ON b.package_id = p.id
      WHERE b.customer_id = $customer_id
      ORDER BY b.booking_date DESC";

      $bookingResult = mysqli_query($conn, $bookingQuery);

      if (mysqli_num_rows($bookingResult) > 0) {
        echo '<div class="overflow-x-auto">
              <table class="min-w-full text-sm text-gray-800 text-center border border-gray-300 rounded-lg">
                <thead class="bg-blue-100 text-blue-700 font-semibold">
                  <tr>
                    <th class="p-2">Booking ID</th>
                    <th class="p-2">Package Title</th>
                    <th class="p-2">Price (৳)</th>
                    <th class="p-2">Arrival</th>
                    <th class="p-2">Checkout</th>
                    <th class="p-2">People</th>
                    <th class="p-2">Booking Date</th>
                    <th class="p-2">Payment Status</th>
                    <th class="p-2">Action</th>
                  </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($bookingResult)) {
          $title = trim(explode('.', $row['descriptions'], 2)[0]) . '.';
          $bookingStatus = strtolower($row['payment_status'] ?? 'null');

          echo '<tr class="border-t hover:bg-gray-100">
                <td class="p-2">' . htmlspecialchars($row['booking_id']) . '</td>
                <td class="p-2">' . htmlspecialchars($title) . '</td>
                <td class="p-2">' . htmlspecialchars($row['price']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['arrival_date']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['check_out']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['people_count']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['booking_date']) . '</td>
                <td class="p-2 capitalize">' . htmlspecialchars($bookingStatus) . '</td>
                <td class="p-2">';

          switch ($bookingStatus) {
            case 'verified':
              echo '<span class="text-green-600 font-semibold">✓ Verified</span>';
              break;

            case 'pending':
              echo '<span class="text-yellow-500 font-medium">Pending Verification</span>';
              break;

            case 'null':
            default:
              echo '<a href="make_payment.php?booking_id=' . $row['booking_id'] . '&package_id=' . $row['package_id'] . '" 
                     class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow">
                     purchase
                  </a>';
              break;
          }

          echo '</td></tr>';
        }

        echo '</tbody></table></div>';
      } else {
        echo '<p class="text-center text-gray-500">You have not placed any bookings yet.</p>';
      }
      ?>
    </div>
  </div>

</body>
<?php include 'things/footer.php'; ?>
</html>