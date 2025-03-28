<?php include 'things/top.php'; ?>
<body class="bg-blue-200 flex flex-col min-h-screen">
    
    <?php include 'things/navbar.php' ?>

    <main class="flex flex-col items-center justify-between flex-grow pt-24 px-4 w-[80%] mx-auto">
    <div class="flex w-full max-w-screen-lg bg-black rounded-lg shadow-lg overflow-scroll">
        <!-- Image Container (80% width) -->
        <div class="w-1/2 bg-gray-200 flex items-center justify-center overflow-hidden">
            <img src="resources/images/reg_pic.jpg" alt="Registration" class="w-full h-full object-cover">
        </div>

        <!-- Form Container -->
        <div class="flex-1 p-8 overflow-y-scroll  max-h-[80vh] w-4/5">
            <h1 class="text-center text-xl font-bold text-blue-500 mb-6">Registration Form</h1>
            <form method="post" action="registration.php">
                <!-- Form Inputs -->
                <div>
                        <label class="block font-medium text-white" for="firstName">First Name</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="firstName" name="firstName" placeholder="Enter your first name">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="lastName">Last Name</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="lastName" name="lastName" placeholder="Enter your last name">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="dob">Date of Birth</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="date" id="dob" name="dob">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="Nationality">Nationality</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="Nationality" name="Nationality" placeholder="Enter your nationality">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="Passport">Passport Number</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="Passport" name="Passport" placeholder="Enter your passport number">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="Email">Email Address</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="email" id="Email" name="Email" placeholder="Enter your email address">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="phone">Phone Number</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="user">User ID</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="user" name="user" placeholder="Create a user ID">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="password">Password</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="password" id="password" name="password" placeholder="Create a password">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="cp">Confirm Password</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="password" id="cp" name="cp" placeholder="Confirm your password">
                    </div>
                    <div>
                        <label class="block font-medium text-white" for="Address">Current Address</label>
                        <input class="w-full p-2 border rounded bg-gray-100 text-gray-900" type="text" id="Address" name="Address" placeholder="Enter your current address">
                    </div>
                    <div>
                        <input class="w-full p-3 mt-3 bg-teal-500 text-white font-bold rounded hover:bg-teal-400 cursor-pointer" type="submit" value="Register">
                    </div>
            </form>
        </div>
    </div>

</body>
<div class="w-[100vw]">
<?php include 'things/footer.php'; ?>
</div>
</html>

