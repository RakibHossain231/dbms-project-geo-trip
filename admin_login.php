<?php
session_start();
require 'things/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $admin_email = mysqli_real_escape_string($conn, $_POST['email']); // FIX: use real_escape_string
  $admin_pass = $_POST['password']; // don't escape password

  $query = "SELECT id, email, admin_pass FROM admin WHERE email = '$admin_email'";
  $result = mysqli_query($conn, $query);

  // Check if the query succeeded and returned a row
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashed_pass = $row['admin_pass'];

    if (password_verify($admin_pass, $hashed_pass)) {
      $_SESSION['id'] = $row['id'];
      $_SESSION['type'] = 'admin';
      mysqli_close($conn);
      header("Location: admin_panel.php");
      exit();
    } else {
      // Wrong password
      mysqli_close($conn);
      header("Location: admin_login.php?msg=Invalid+email+or+password");
      exit();
    }
  } else {
    // No user found with that email
    mysqli_close($conn);
    header("Location: admin_login.php?msg=Invalid+email+or+password");
    exit();
  }
}
?>

<?php include 'things/top.php'; ?>

<body>
  <?php include 'things/navbar.php' ?>
  <section class="min-h-screen bg-gradient-to-br from-indigo-100 to-blue-200 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-gray-200">

      <!-- Title -->
      <h2 class="text-3xl font-bold text-center text-indigo-800 mb-6">
        <i class="fas fa-user-shield mr-2"></i>Admin Login
      </h2>
      <?php if (isset($_GET['msg'])):
        $msg = htmlspecialchars($_GET['msg']);
      ?>
        <div class="my-4 px-5 py-4 rounded-md border border-green-200 bg-green-50 text-green-800 text-sm shadow-sm">
          <div class="flex items-center space-x-2">
            <i class="fa-solid fa-message text-xl" style="color: #74C0FC;"></i>
            <span><?php echo $msg; ?></span>
          </div>
        </div>
      <?php endif; ?>

      <!-- Login Form -->
      <form action="admin_login.php" method="POST" class="space-y-5">

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" id="email" name="email" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white/70">
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input type="password" id="password" name="password" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white/70">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit"
            class="w-full py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-semibold rounded-md hover:from-indigo-600 hover:to-blue-700 transition duration-300">
            Login
          </button>
        </div>

      </form>



    </div>
  </section>
</body>
<?php include 'things/footer.php'; ?>

</html>