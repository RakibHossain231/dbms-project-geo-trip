<?php include 'things/top.php' ?>

<body class="bg-cover bg-center min-h-screen bg-gradient-to-r from-blue-100 via-white to-blue-200 " >
    <?php include 'things/navbar.php' ?>
    <div class="w-full max-w-md p-8 rounded-lg shadow-lg bg-gradient-to-br from-indigo-500 to-purple-600 mx-auto my-10">
        <h2 class="text-white text-2xl font-bold text-center mb-6"><i class="fa-solid fa-circle-user text-2xl mr-2" style="color: #74C0FC;"></i>Customer Login</h2>
        <form action="login.php" method="POST" class="bg-white p-6 rounded-lg space-y-4">
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">Login</button>
        </form>
        <p class="text-center mt-2 font-bold">New member? <span class="blink  "><a href="registration.php" class="text-cyan-300 hover:text-yellow-500">Sign Up</a></span></p>
</body>
    </div>
    
<?php include 'things/footer.php' ?>

</html>