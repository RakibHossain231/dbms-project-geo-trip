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

  <!-- User Info -->
  <div class="max-w-4xl mx-auto mt-6">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
      <div class="bg-blue-600 px-6 py-4 text-white">
        <h2 class="text-2xl font-bold">Welcome, <?= htmlspecialchars($data['f_name']) ?>!</h2>
        <p class="text-sm">Here is your profile overview</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <div>
          <p><span class="font-semibold text-gray-700">Customer ID:</span> <?= $data['customerID'] ?></p>
          <p><span class="font-semibold text-gray-700">First Name:</span> <?= $data['f_name'] ?></p>
          <p><span class="font-semibold text-gray-700">Last Name:</span> <?= $data['l_name'] ?></p>
          <p><span class="font-semibold text-gray-700">Date of Birth:</span> <?= $data['dob'] ?></p>
          <p><span class="font-semibold text-gray-700">Phone:</span> <?= $data['phone'] ?></p>
          <p><span class="font-semibold text-gray-700">Email:</span> <?= $data['email'] ?></p>
        </div>
        <div>
          <p><span class="font-semibold text-gray-700">Address:</span> <?= $data['address'] ?></p>
          <p><span class="font-semibold text-gray-700">Nationality:</span> <?= $data['nationality'] ?></p>
          <p><span class="font-semibold text-gray-700">Passport No:</span> <?= $data['pp_no'] ?></p>
          <p><span class="font-semibold text-gray-700">Username:</span> <?= $data['user_name'] ?></p>
          <p><span class="font-semibold text-gray-700">Gender:</span> <?= $data['gender'] ?></p>
        </div>
        <div class="col-span-full text-center mt-4">
          <form action="logout.php" method="POST">
            <input type="submit" name="Logout" value="Logout" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-medium">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bookings Table -->
  <div class="max-w-5xl mx-auto mt-10 mb-16">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-green-600 mb-4 text-center">Your Bookings</h2>
      <hr class="mb-4">

      <?php
      // Main query for bookings (only non-cancelled bookings)
      $bookingQuery = "
      SELECT 
        b.id AS booking_id,
        b.booking_date,
        b.arrival_date,
        b.check_out,
        b.people_count,
        p.price,
        p.descriptions,
        b.package_id,
        pay.payment_status
      FROM bookings b
      JOIN package p ON b.package_id = p.id
      LEFT JOIN (
        SELECT booking_id, payment_status 
        FROM payments 
        WHERE id IN (
            SELECT MAX(id) FROM payments GROUP BY booking_id
        )
      ) pay ON pay.booking_id = b.id
      WHERE b.customer_id = $customer_id AND b.is_cancelled = 0
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
          $paymentStatus = $row['payment_status'] ?? 'unpaid';

          echo '<tr class="border-t hover:bg-gray-100">
                <td class="p-2">' . htmlspecialchars($row['booking_id']) . '</td>
                <td class="p-2">' . htmlspecialchars($title) . '</td>
                <td class="p-2">' . htmlspecialchars($row['price']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['arrival_date']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['check_out']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['people_count']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['booking_date']) . '</td>';

          // Payment status column
          echo '<td class="p-2 capitalize">';
          if ($paymentStatus == 'verified') {
            echo '<span class="text-green-600 font-semibold">✓ Verified</span>';
          } elseif ($paymentStatus == 'pending') {
            echo '<span class="text-yellow-500 font-medium">Pending</span>';
          } elseif ($paymentStatus == 'rejected') {
            echo '<span class="text-red-500 font-medium">Rejected</span>';
          } else {
            echo '<span class="text-gray-500 font-medium">Unpaid</span>';
          }
          echo '</td>';

          // Action column
          echo '<td class="p-2">';
          if ($paymentStatus == 'unpaid' || $paymentStatus == 'rejected') {
            echo '<a href="make_payment.php?booking_id=' . $row['booking_id'] . '&package_id=' . $row['package_id'] . '" 
                     class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow">
                     Purchase
                  </a><br><br>';
          }
          echo '<a href="cancel_booking.php?booking_id=' . $row['booking_id'] . '" 
                 class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                 Cancel
              </a>';
          echo '</td></tr>';
        }

        echo '</tbody></table></div>';
      } else {
        echo '<p class="text-center text-gray-500">You have not placed any bookings yet.</p>';
      }
      ?>
    </div>
  </div>

  <!-- Payments Table -->
  <div class="max-w-5xl mx-auto mt-10 mb-16">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-purple-600 mb-4 text-center">Your Payment Requests</h2>
      <hr class="mb-4">

      <?php
      $paymentQuery = "
      SELECT pay.id, pay.amount, pay.paid_on, pay.transaction_id, pay.payment_method, pay.payment_for, pay.payment_status
      FROM payments pay
      LEFT JOIN bookings b ON pay.booking_id = b.id AND pay.payment_for = 'booking'
      LEFT JOIN visa_application v ON pay.booking_id = v.id AND pay.payment_for = 'visa'
      WHERE b.customer_id = $customer_id OR v.customer_id = $customer_id
      ORDER BY pay.paid_on DESC";

      $paymentResult = mysqli_query($conn, $paymentQuery);

      if (mysqli_num_rows($paymentResult) > 0) {
        echo '<div class="overflow-x-auto">
              <table class="min-w-full text-sm text-gray-800 text-center border border-gray-300 rounded-lg">
                <thead class="bg-purple-100 text-purple-700 font-semibold">
                  <tr>
                    <th class="p-2">Payment ID</th>
                    <th class="p-2">Type</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Transaction ID</th>
                    <th class="p-2">Payment Method</th>
                    <th class="p-2">Paid On</th>
                    <th class="p-2">Payment For</th>
                    <th class="p-2">Status</th>
                  </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($paymentResult)) {
          echo '<tr class="border-t hover:bg-gray-100">
                <td class="p-2">' . htmlspecialchars($row['id']) . '</td>
                <td class="p-2 capitalize">' . htmlspecialchars($row['payment_for']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['amount']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['transaction_id']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['payment_method']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['paid_on']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['payment_for']) . '</td>
                <td class="p-2 capitalize">' . htmlspecialchars($row['payment_status']) . '</td>
                </tr>';
        }

        echo '</tbody></table></div>';
      } else {
        echo '<p class="text-center text-gray-500">You have not made any payment requests yet.</p>';
      }
      ?>
    </div>
  </div>
  <!-- Visa Applications Table -->
  <div class="max-w-5xl mx-auto mt-10 mb-16">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-blue-600 mb-4 text-center">Your Visa Applications</h2>
      <hr class="mb-4">

      <?php
      $visaQuery = "
      SELECT 
        v.id AS visa_id,
        v.submission_date,
        v.visa_status,
        v.admin_comment,
        pay.paid_on,
        pay.payment_status,
        pay.id AS payment_id
      FROM visa_application v
      LEFT JOIN payments pay 
        ON pay.booking_id = v.id AND pay.payment_for = 'visa'
      WHERE v.customer_id = $customer_id
      ORDER BY v.submission_date DESC
    ";

      $visaResult = mysqli_query($conn, $visaQuery);

      if (mysqli_num_rows($visaResult) > 0) {
        echo '<div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-800 text-center border border-gray-300 rounded-lg">
              <thead class="bg-blue-100 text-blue-700 font-semibold">
                <tr>
                  <th class="p-2">Visa ID</th>
                  <th class="p-2">Submitted On</th>
                  <th class="p-2">Status</th>
                  <th class="p-2">Admin Comment</th>
                  <th class="p-2">Paid On</th>
                  <th class="p-2">Payment Status</th>
                  <th class="p-2">Action</th>
                </tr>
              </thead>
              <tbody>';

        while ($row = mysqli_fetch_assoc($visaResult)) {
          $paymentStatus = $row['payment_status'] ?? 'unpaid';
          $paidOn = $row['paid_on'] ?? 'N/A';

          echo '<tr class="border-t hover:bg-gray-100">
              <td class="p-2">' . htmlspecialchars($row['visa_id']) . '</td>
              <td class="p-2">' . htmlspecialchars($row['submission_date']) . '</td>
              <td class="p-2 capitalize">' . htmlspecialchars($row['visa_status']) . '</td>
              <td class="p-2">' . htmlspecialchars($row['admin_comment']) . '</td>
              <td class="p-2">' . htmlspecialchars($paidOn) . '</td>';

          // Payment Status
          echo '<td class="p-2 capitalize">';
          if ($paymentStatus == 'verified') {
            echo '<span class="text-green-600 font-semibold">✓ Verified</span>';
          } elseif ($paymentStatus == 'pending') {
            echo '<span class="text-yellow-500 font-medium">Pending</span>';
          } elseif ($paymentStatus == 'rejected') {
            echo '<span class="text-red-500 font-medium">Rejected</span>';
          } else {
            echo '<span class="text-gray-500 font-medium">Unpaid</span>';
          }
          echo '</td>';

          // Action
          echo '<td class="p-2">';
          if ($paymentStatus == 'unpaid' || $paymentStatus == 'rejected') {
            echo '<a href="make_visa_payment.php?visa_id=' . $row['visa_id'] . '&type=visa" 
                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow">
                   Pay Now
                 </a>';
          } else {
            echo '<span class="text-sm text-gray-500">—</span>';
          }
          echo '</td></tr>';
        }

        echo '</tbody></table></div>';
      } else {
        echo '<p class="text-center text-gray-500">You have not submitted any visa applications yet.</p>';
      }
      ?>
    </div>
  </div>
  <!-- Visa Payments Table (New Table) -->
  <div class="max-w-5xl mx-auto mt-10 mb-16">
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-indigo-600 mb-4 text-center">Your Visa Payments</h2>
      <hr class="mb-4">

      <?php
      $visaPaymentsQuery = "
      SELECT vp.id AS payment_id, 
             vp.application_id, 
             vp.amount, 
             vp.payment_date, 
             vp.transaction_id,
             va.visa_status
      FROM visa_payments vp
      INNER JOIN visa_application va ON vp.application_id = va.id
      WHERE va.customer_id = $customer_id
      ORDER BY vp.payment_date DESC
    ";

      $visaPaymentsResult = mysqli_query($conn, $visaPaymentsQuery);

      if (mysqli_num_rows($visaPaymentsResult) > 0) {
        echo '<div class="overflow-x-auto">
              <table class="min-w-full text-sm text-gray-800 text-center border border-gray-300 rounded-lg">
                <thead class="bg-indigo-100 text-indigo-700 font-semibold">
                  <tr>
                    <th class="p-2">Payment ID</th>
                    <th class="p-2">Application ID</th>
                    <th class="p-2">Amount (৳)</th>
                    <th class="p-2">Payment Date</th>
                    <th class="p-2">Transaction ID</th>
                    <th class="p-2">Visa Status</th>
                  </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($visaPaymentsResult)) {
          echo '<tr class="border-t hover:bg-gray-100">
                <td class="p-2">' . htmlspecialchars($row['payment_id']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['application_id']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['amount']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['payment_date']) . '</td>
                <td class="p-2">' . htmlspecialchars($row['transaction_id']) . '</td>
                <td class="p-2 capitalize">' . htmlspecialchars($row['visa_status']) . '</td>
              </tr>';
        }

        echo '</tbody></table></div>';
      } else {
        echo '<p class="text-center text-gray-500">You have not made any visa payments yet.</p>';
      }
      ?>
    </div>
  </div>



</body>
<?php include 'things/footer.php'; ?>

</html>