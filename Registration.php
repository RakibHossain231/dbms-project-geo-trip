<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- daisy ui cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- playfair font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    
    <!-- <header class="w-full bg-blue-400 fixed top-0 left-0 shadow-md z-50">
        <nav class="flex justify-between items-center p-4 max-w-6xl mx-auto">
            <div class="h-16">
                <img class="rounded-2xl h-full" src="resources/images/geo_travel_logo.png" alt="Logo">
            </div>
            <ul class="flex space-x-4 font-bold">
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="home.php">Home</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="about.php">About Us</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="services.php">Services</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="packages.php">Packages</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="contacts.php">Contacts</a></li>
            </ul>
            <div class="space-x-2">
                <a href="login.php"><button class="bg-orange-400 p-2 rounded hover:bg-orange-300">Admin</button></a>
                <a href="signin.php"><button class="bg-purple-600 p-2 rounded hover:bg-purple-400">Sign in</button></a>
                <a href="Registration.php"><button class="bg-teal-500 p-2 rounded hover:bg-teal-300">Sign up</button></a>
            </div>
        </nav>
    </header> -->
    <header class="h-24 w-full">
        <nav class="flex flex-row max-h-24  bg-blue-400 justify-between items-center px-4 ">
            <div class="max-h-24"><img class="rounded-2xl max-h-24 p-2" src="resources/images/geo_travel_logo.png"
                    alt=""></div>
            <ul class="flex flex-row justify-evenly gap-4 font-bold font-sans">
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="home.php">Home</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="about.php">About Us</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="services.php">Services</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="packages.php">Packages</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="contacts.php">Contacts</a></li>
            </ul>
            <div>
                <a href="login.php"><button class="btn bg-orange-400 p-4 hover:bg-orange-300"><i class="fa-solid fa-lock" style="color: #262726;"></i>Admin</button></a>
                <a href="signin.php"><button class="btn bg-purple-600 p-4 hover:bg-purple-400"><i class="fa-solid fa-arrow-right-to-bracket"></i>Sign in</button></a>
                <a href="Registration.php"><button class="btn bg-teal-500 p-4 hover:bg-teal-300"><i class="fa-solid fa-user-plus"></i>Sign up</button></a>

            </div>
        </nav>
    </header>

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
</html>
