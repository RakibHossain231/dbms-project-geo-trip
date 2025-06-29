<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logged_in = false;
if (empty($_SESSION['id']) && empty($_SESSION['type'])) {
    $logged_in = false;
} else { 
    $logged_in = true;
    $user_type = $_SESSION['type'];
}
function page_name()
{
    if ($_SERVER['REQUEST_URI'] === "/final_geo%20trips/home.php") return "home";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/about.php") return "about";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/services.php") return "services";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/packages.php") return "packages";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/visa_docs.php") return "visa_docs";
    else if ($_SERVER['REQUEST_URI'] === "/geo%20trips/login.php") return "login";
    else return "home";
}
?>
<header class="h-20 w-full sticky top-0 z-50">
    <nav class="flex flex-row max-h-24 bg-[#6C91C2] justify-between items-center px-4 ">
        <div class="max-h-24"><a href="home.php"><img class="rounded-2xl max-h-20 p-2" src="resources/images/geo_travel_logo.png"
                    alt=""></a> </div>

        <ul class="flex flex-row justify-evenly gap-4 font-bold font-sans">
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg  <?php if (page_name() === 'home') echo 'text-neutral-200'; ?>" href="home.php">Home</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if (page_name() === 'about') echo 'text-neutral-200'; ?>" href="about.php">About Us</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if (page_name() === 'services') echo 'text-neutral-200'; ?>" href="services.php">Services</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if (page_name() === 'packages') echo 'text-neutral-200'; ?>" href="package_card.php">Packages</a></li>
            <li><a class="hover:bg-cyan-400 p-2 rounded-lg <?php if (page_name() === 'visa_docs') echo 'text-neutral-200'; ?>" href="visa_docs.php">Visa Info</a></li>
        </ul>
        <div>
            <?php
            if (!$logged_in) {
            ?>
                <a href="admin_login.php"><button class="btn bg-[#94B4C1] p-4 hover:bg-white hover:font-bold"><i class="fa-solid fa-lock" style="color: #262726;"></i>Admin</button></a>
                <a href="login.php"><button class="btn bg-[#7AE2CF] p-4 hover:bg-white hover:font-bold"><i class="fa-solid fa-arrow-right-to-bracket"></i>Sign in</button></a>
                <a href="Registration.php"><button class="btn bg-[#ECEFCA] p-4 hover:bg-white hover:font-bold"><i class="fa-solid fa-user-plus"></i>Sign up</button></a>
            <?php } elseif ($user_type === 'admin') {
            ?>
                <a href="admin_panel.php"><button class="btn bg-red-500 p-4 hover:bg-white hover:font-bold"><i class="fa-duotone fa-solid fa-user-secret fa-xl" style="--fa-primary-color: #74C0FC; --fa-secondary-color: #74C0FC;"></i></button></a>
                
            <?php } else if ($user_type === 'user') {  ?>
                <a href="user_profile.php"><button class="btn bg-black text-white p-4 hover:bg-white hover:font-bold hover:text-black"><i class="fa-solid fa-user-tie" style="color: #74C0FC;"></i>Profile</button></a>
            <?php } ?>
        </div>
    </nav>
</header>