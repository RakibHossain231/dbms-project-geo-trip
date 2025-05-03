<?php include 'things/top.php'; ?>

<?php
include 'things/db_connect.php';
if (isset($_POST['submit'])) {
    $f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    // Use password_verify to during the login process to check the password against the hash
    $password = password_hash($password,PASSWORD_DEFAULT);
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $nationality = mysqli_real_escape_string($conn,$_POST['nationality']);
    $pp_no = mysqli_real_escape_string($conn,$_POST['passport']);
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $termError = "";
    if(empty($_POST['submit'])){
        
    }
    else {
        if(empty($f_name) || empty($l_name) || empty($email) || empty($phone) || empty($address) || empty($dob) || empty($nationality) || empty($pp_no) || empty($username) || empty($password) || empty($gender)){
            $termError = "Please fill in all fields";
            header("Location:Registration.php?error=$termError");
            exit();
        }
        $query = "INSERT INTO customer(f_name, l_name, dob, phone, email, address, nationality, pp_no, user_name, pass,gender) 
                  VALUES ('$f_name', '$l_name', '$dob', '$phone', '$email', '$address', '$nationality', '$pp_no', '$username', '$password','$gender')";
        // $result = mysqli_query($conn, $query);
        if (mysqli_query($conn, $query)) {
            mysqli_close($conn);
            print_r('<div class="text-red-500">Success</div>');
            header("Location: login.php?msg=Registration+successfull+.+Pleasae+Login+to+Continue");
            exit();
        } else {
            echo '<h1 class = "text-red-800 font-bold font-sans text-2xl text-center w-auto h-auto">Error occured</h1> <pre class="text-red-500 font-semibold font-sans text-xl text-center w-auto h-auto">';
            print_r(mysqli_error($conn));
            echo '</pre>';
            mysqli_close($conn);
            die();
        }
    }
}

?>


<body class="bg-[url('resources/images/airplane_bg.png')] bg-repeat  min-h-screen before:opacity-70 ">
    <?php include 'things/navbar.php'; ?>
    <!-- form container -->
    <div class="bg-white rounded-lg shadow-2xl p-8 max-w-2xl w-full container mx-auto mt-4 bg-gradient-to-b from-orange-100 via-yellow-50 to-orange-100">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Create Your Account</h1>
            <p class="text-gray-600 mt-2">Please fill in your details to register</p>
            <?php 
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<div class="text-red-500 mt-2">'.$error.'</div>';
                }
            ?>
        </div>

        <form class="space-y-6" action="Registration.php" method="POST">
            <!-- Grid for side-by-side fields -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Personal Information Section -->
                <!-- First Name and Last Name (positioned together) -->
                <div>
                    <label for="f_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="f_name" name="f_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="l_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="l_name" name="l_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Contact Information -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Address (spans full width) -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea id="address" name="address" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" id="dob" name="dob"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Identification Information (Nationality and Passport positioned together) -->
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                    <input type="text" id="nationality" name="nationality"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="passport" class="block text-sm font-medium text-gray-700 mb-1">Passport Number</label>
                    <input type="text" id="passport" name="passport"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    
                </div>
                <hr class="col-span-3 h-[2px] bg-red-200 border-t-2 border-red-300 rounded-md my-4" />
                <!-- Account Information (Username and Password at the end) -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500" required placeholder="Choose a username">
                </div> 

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 ">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-200 text-stone-500" required  placeholder="strong password">
                </div>
            </div>

            
            <input type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 w-full" name="submit" value="Register" >
            

        </form>
    </div>

</body>
<?php include 'things/footer.php'; ?>

</html>