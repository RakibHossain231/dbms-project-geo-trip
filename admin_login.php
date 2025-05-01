<?php include 'things/top.php'; ?>

<body>
<?php include 'things/navbar.php' ?>
<section class="min-h-screen bg-gradient-to-br from-indigo-100 to-blue-200 flex items-center justify-center px-4">
  <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-gray-200">
    
    <!-- Title -->
    <h2 class="text-3xl font-bold text-center text-indigo-800 mb-6">
      <i class="fas fa-user-shield mr-2"></i>Admin Login
    </h2>

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
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white/70" >
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