<?php include 'things/top.php'; ?>

<?php
include('things/db_connect.php');

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
    $query = " SELECT * FROM customer WHERE customerId = {$_GET['id']};";
    $data = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($data);
    $f_name = $data['f_name'];
    $l_name = $data['l_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $address = $data['address'];
    $username = $data['user_name'];
    $dob = $data['dob'];
    $nationality = $data['nationality'];
    $pass = $data['pass'];
    $gender = $data['gender'];
    $pp_no = $data['pp_no'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    // Form was submitted
    $id = intval($_GET['id']);
    // Update the data in DB
}
if (isset($_POST['update'])) {
    //getting the old pass from the database to check 
    $getOld = mysqli_query($conn, "SELECT pass FROM customer WHERE customerId = $id");
    $oldData = mysqli_fetch_assoc($getOld);
    $oldPasswordHash = $oldData['pass'];

    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $pp_no = mysqli_real_escape_string($conn, $_POST['passport']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $inputPassword = $_POST['password'];

    // Compare passwords
    if ( ($inputPassword === $oldPasswordHash)) {
        $finalPassword = $oldPasswordHash;
    } else {
        $finalPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
    }
    // $id = $_GET['id'];

    $query = "UPDATE customer SET 
        f_name = '$f_name',
        l_name = '$l_name',
        email = '$email',
        phone = '$phone',
        address = '$address',
        dob = '$dob',
        nationality = '$nationality',
        pp_no = '$pp_no',
        user_name = '$username',
        pass = '$finalPassword',
        gender = '$gender'
        WHERE customerId = '$id'  ";

    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location: customers_list.php?msg=Customer+data+updated+successfully");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
    print_r($_POST);
    echo $_GET['id'];
}



?>


<body class="bg-[url('resources/images/airplane_bg.png')] bg-repeat  min-h-screen before:opacity-70 ">
    <?php include 'things/navbar.php'; ?>
    <!-- form container -->
    <div class="bg-white rounded-lg shadow-2xl p-8 max-w-2xl w-full container mx-auto mt-4 bg-gradient-to-b from-orange-100 via-yellow-50 to-orange-100">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Update Account Data</h1>
            <p class="text-gray-600 mt-2">Please fill in your new details to update</p>
            <p class="text-red-600 mt-2"><?php if (!empty($_GET['error'])) {
                                                echo $_GET['error'];
                                            } ?></p>
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo '<div class="text-red-500 mt-2">' . $error . '</div>';
            }
            ?>
        </div>

        <form class="space-y-6" action="update_design.php?id= <?php echo $_GET['id'] ?>" method="POST">
            <!-- Grid for side-by-side fields -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Personal Information Section -->
                <!-- First Name and Last Name (positioned together) -->
                <div>
                    <label for="f_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="f_name" name="f_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $f_name; ?>">
                </div>

                <div>
                    <label for="l_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="l_name" name="l_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $l_name; ?>">
                </div>

                <!-- Contact Information -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $email; ?>">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $phone; ?>">
                </div>

                <!-- Address (spans full width) -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea id="address" name="address" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required><?php echo $address; ?></textarea>
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" id="dob" name="dob"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $dob; ?>">
                </div>

                <!-- Identification Information (Nationality and Passport positioned together) -->
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                    <input type="text" id="nationality" name="nationality"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $nationality; ?>">
                </div>

                <div>
                    <label for="passport" class="block text-sm font-medium text-gray-700 mb-1">Passport Number</label>
                    <input type="text" id="passport" name="passport"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo $pp_no; ?>">
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500">
                        <option value="male"
                            <?php
                            if ($gender === 'male') echo "selected";
                            ?>>Male</option>
                        <option value="female"
                            <?php
                            if ($gender === 'female') echo "selected";
                            ?>>Female</option>
                    </select>

                </div>
                <hr class="col-span-3 h-[2px] bg-red-200 border-t-2 border-red-300 rounded-md my-4" />
                <!-- Account Information (Username and Password at the end) -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500" required placeholder="Choose a username" value="<?php echo $username; ?>">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 ">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500" required placeholder="strong password" value="<?php echo $pass; ?>">
                </div>
            </div>


            <input type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 w-full" name="update" value="Update">


        </form>
    </div>

</body>
<?php include 'things/footer.php'; ?>

</html>