<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Development</title>
    <!-- tailwind link  -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- daisy ui cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 h-screen flex flex-col items-center justify-between">
    <header class="h-64 w-full">
    <nav class="flex flex-row max-h-24  bg-emerald-100 justify-between items-center px-4 ">
            <div class="max-h-20"><img class="rounded-2xl max-h-20 p-2" src="resources/images/geo_travel_logo.png"
                    alt=""></div>
            <ul class="flex flex-row justify-evenly gap-4 font-bold font-sans">
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="home.php">Home</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="about.php">About Us</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="services.php">Services</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="packages.php">Packages</a></li>
                <li><a class="hover:bg-cyan-400 p-2 rounded-lg" href="contacts.php">Contacts</a></li>
            </ul>
            <div>
                <button class="btn bg-orange-400 p-4 hover:bg-orange-300"><i class="fa-solid fa-lock" style="color: #262726;"></i>Admin</button>
                <button class="btn bg-purple-600 p-4 hover:bg-purple-400"><i class="fa-solid fa-arrow-right-to-bracket"></i>Sign in</button>
                <button class="btn bg-teal-500 p-4 hover:bg-teal-300"><i class="fa-solid fa-user-plus"></i>Sign up</button>

            </div>
        </nav>
    </header>
    <div class="bg-white p-10 rounded-lg shadow-md text-center">
        <i class="fas fa-tools text-5xl text-gray-400 mb-6"></i>
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Under Development</h1>
        <p class="text-gray-600 text-lg">This page is currently under development. Please check back later.</p>
    </div>

</body>
</html>