<?php
include 'things/top.php';
include 'things/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // checking if the user came in valid way.
    $current_page = $_SERVER['PHP_SELF'];
    $previous_page = $_SERVER['HTTP_REFERER'];
    if (!isset($previous_page)) {
        header("Location: Registration.php?error=You Must be an admin to update data");
        exit();
    }
    $update_page = 'http://localhost/geo%20trips/customers_list.php';
    // echo $current_page;
    // echo $previous_page;
    $error = "";
    if (str_contains($previous_page, $update_page)) {
    } else {
        $error =  'You are not valid ';
    }
    $query = " SELECT * FROM admin WHERE id = {$_GET['id']};";
    $data = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($data);
    $name = $data['name'];
    $email = $data['email'];
    $pass = $data['admin_pass'];
    $join_date = $data['join_date'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    // Form was submitted
    $id = intval($_GET['id']);
    // Update the data in DB
}
if (isset($_POST['update'])) {
    //getting the old pass from the database to check 
    $getOld = mysqli_query($conn, "SELECT admin_pass FROM admin WHERE id = $id");
    $oldData = mysqli_fetch_assoc($getOld);
    $oldPasswordHash = $oldData['admin_pass'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $join_date = $_POST['join_date'];
    $inputPassword = $_POST['password'];

    // Compare passwords
    if (($inputPassword === $oldPasswordHash)) {
        $finalPassword = $oldPasswordHash;
    } else {
        $finalPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
    }
    // $id = $_GET['id'];

    $query = "UPDATE admin SET 
                name = '$name',
                email = '$email',
                admin_pass = '$finalPassword',
                join_date = '$join_date'
              WHERE id = $id";
    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location: customers_list.php?msg=Admin+data+updated+successfully");
        exit();
    } else {
        echo "Update failed: " ."<pre>". mysqli_error($conn) . "</pre>";
    }
}
?>

<body class="bg-[url('resources/images/admin_update_bg.png')] bg-cover bg-no-repeat bg-center">
    <?php include 'things/navbar.php' ?>
    <section class="min-h-screen flex items-center justify-center  px-4">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-8 border border-gray-200 drop-shadow-md">

            <h2 class="text-3xl font-bold text-center text-indigo-800 mb-6">Update Admin Details</h2>
            <hr class="p-[1px] bg-linear-to-r from-sky-500 to-indigo-500 mb-5">
            <form action="update_admin.php?id=<?php echo $_GET['id'];?>" method="POST" class="space-y-5">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" name="name" required value=" <?php echo $name; ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-white/70">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" required value=" <?php echo $email; ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-white/70">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required value=" <?php echo $pass; ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-white/70">
                </div>

                <!-- Joining Date -->
                <div>
                    <label for="join_date" class="block text-sm font-semibold text-gray-700 mb-1">Joining Date</label>
                    <input type="date" id="join_date" name="join_date" required
                        value="<?php echo date('Y-m-d', strtotime($join_date)); ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-white/70">
                </div>


                <!-- Submit Button -->
                <div class="text-center pt-4">
                    <input type="submit"
                        class="w-full py-3 bg-gradient-to-r from-blue-400 via-indigo-500 to-blue-500 text-white font-bold rounded-lg hover:from-blue-900 hover:to-indigo-700 transition duration-300" name="update" value="Update">
                    </input>
                </div>

            </form>
        </div>
    </section>

</body>
<?php include 'things/footer.php'; ?>

</html>