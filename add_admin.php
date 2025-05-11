<?php
include 'things/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $join_date = mysqli_real_escape_string($conn, $_POST['join_date']);

    // 1. Check if email already exists
    $checkQuery = "SELECT id FROM admin WHERE email = '$email' LIMIT 1";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('An admin with this email already exists.'); window.history.back();</script>";
        exit();
    }

    // 2. Insert new admin
    $insertQuery = "INSERT INTO admin (name, email, admin_pass, join_date) 
                    VALUES ('$name', '$email', '$password', '$join_date')";

    if (mysqli_query($conn, $insertQuery)) {
        header("Location: customers_list.php?msg=Admin+added+successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include 'things/top.php'; ?>

<body>
    <?php include 'things/navbar.php'; ?>
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-200 to-purple-200 px-4 py-10">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-md border border-gray-300 shadow-xl rounded-2xl p-8">

            <h2 class="text-3xl font-bold text-center text-indigo-800 mb-6">
                <i class="fas fa-user-plus mr-2"></i><span class="bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent">Add New Admin</span>
            </h2>

            <form action="add_admin.php" method="POST" class="space-y-5">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Admin Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Unique Email only"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Joining Date -->
                <div>
                    <label for="join_date" class="block text-sm font-medium text-gray-700 mb-1">Joining Date</label>
                    <input type="date" id="join_date" name="join_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Submit -->

                <input type="submit"
                    class="w-full py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold rounded-lg hover:from-indigo-600 hover:to-blue-700 transition duration-300" value="Add Admin">
                </input>


            </form>
        </div>
    </section>

</body>
<?php include 'things/footer.php'; ?>

</html>