<?php

function page_name()
{
    if ($_SERVER['REQUEST_URI'] === "/geo%20trips/home.php") return "home";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/about.php") return "about";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/services.php") return "services";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/packages.php") return "packages";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/visa_docs.php") return "visa_docs";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/login.php") return "login";
    else return "home";
}
?>
<header class="h-20 w-full sticky top-0 z-50">
    <nav class="flex flex-row max-h-24 bg-blue-400 justify-between items-center px-4 ">
        <div class="max-h-24"><img class="rounded-2xl max-h-20 p-2" src="resources/images/geo_travel_logo.png"
                alt=""></div>
        <ul class="flex flex-row justify-evenly gap-4 font-bold font-sans">
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg  <?php if(page_name()==='home') echo 'text-neutral-200'; ?>" href="home.php">Home</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if(page_name()==='about') echo 'text-neutral-200'; ?>" href="about.php">About Us</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if(page_name()==='services') echo 'text-neutral-200'; ?>" href="services.php">Services</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if(page_name()==='packages') echo 'text-neutral-200'; ?>" href="packages.php">Packages</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if(page_name()==='visa_docs') echo 'text-neutral-200'; ?>" href="visa_docs.php">Visa Info</a></li>
        </ul>
        <div>
            <a href="admin_login.php"><button class="btn bg-orange-400 p-4 hover:bg-orange-300"><i class="fa-solid fa-lock" style="color: #262726;"></i>Admin</button></a>
            <a href="login.php"><button class="btn bg-purple-600 p-4 hover:bg-purple-400"><i class="fa-solid fa-arrow-right-to-bracket"></i>Sign in</button></a>
            <a href="Registration.php"><button class="btn bg-teal-500 p-4 hover:bg-teal-300"><i class="fa-solid fa-user-plus"></i>Sign up</button></a>

        </div>
    </nav>
</header>