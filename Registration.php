







<?php include 'things/top.php'; ?>

<body class="bg-[url('resources/images/airplane_bg.png')] bg-repeat  min-h-screen before:opacity-70 ">
<?php include 'things/navbar.php' ?>
<!-- form container -->
<div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl w-full container mx-auto mt-4 bg-gradient-to-b from-white via-blue-50 to-teal-50">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Create Your Account</h1>
            <p class="text-gray-600 mt-2">Please fill in your details to register</p>
        </div>
        
        <form class="space-y-6" action="login.php" method="POST">
            <!-- Grid for side-by-side fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                
                <!-- Account Information (Username and Password at the end) -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            
            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox"
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a></label>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Create Account
                </button>
            </div>
            
            <!-- Sign In Link -->
            <div class="text-center text-sm">
                <p class="text-gray-600">
                    Already have an account? <a href="#" class="text-blue-600 hover:underline font-medium">Sign In</a>
                </p>
            </div>
        </form>
    </div>

</body>
<?php include 'things/footer.php'; ?>

</html>