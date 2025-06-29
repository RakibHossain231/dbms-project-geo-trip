<?php include 'things/top.php' ?>
<?php
include('things/db_connect.php');

$query = "SELECT package.id, package.descriptions, package.price, package.duration,
                 package.availability, package.commission_rate, package.image_url, 
                 hotels.name AS hotel_name, locations.country AS country, locations.city AS city
          FROM package
          JOIN package_hotel ON package.id = package_hotel.package_id
          JOIN hotels ON package_hotel.hotel_id = hotels.id
          JOIN package_location ON package.id = package_location.package_id
          JOIN locations ON package_location.location_id = locations.location_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'No packages available.';
    exit;
}
?>

<body class="bg-blue-100">
    <!-- <header class="h-24 w-full">
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
    </header> -->
    <?php include 'things/navbar.php' ?>
    <!-- carousal section  -->
    <section class="mx-10 mt-1 rounded-md">
        <!-- slider carousal code  -->
        <div class="carousel md:h-[550px] w-full">
            <!-- slider 1 -->
            <div id="slide1"
                class="carousel-item relative w-full bg-gradient-to-r from-blue-200 to-blue-400  bg-opacity-55 gap-y-8">
                <!-- main content container  -->
                <div class="flex flex-col md:flex-row justify-between">
                    <!-- text content  -->
                    <div class="flex flex-col  items-start justify-center gap-y-10 p-10 flex-1 text-black">
                        <h1 class="text-5xl font-bold">Fly To Riyadh With Us Bangla, Your friendliest companion</h1>
                        <p>Experience a seamless journey from the heart of Bangladesh to the vibrant capital of Saudi
                            Arabia. Enjoy comfortable flights with US-Bangla Air and discover the rich culture and
                            modern wonders of Riyadh.

                        </p>
                        <button class="btn bg-blue-500 hover:bg-teal-300 p-4">Purchase</button>
                    </div>
                    <!-- image content  -->
                    <div class="flex-1  py-8 md:py-24 px-3  "><img src="resources/images/carousal_pic_1.jpeg"
                            class="w-[400px] " />
                    </div>
                </div>
                <!-- button container  -->
                <div class="absolute left-2 right-2 top-1/2 flex -translate-y-1/2 transform justify-between ">
                    <a href="#slide4" class="btn  opacity-55 hover:opacity-100">❮</a>
                    <a href="#slide2" class="btn btn-warning opacity-55 hover:opacity-100">❯</a>
                </div>
            </div>
            <!-- slide 2 -->
            <div id="slide2" class="carousel-item relative w-full bg-gradient-to-r from-blue-200 to-blue-400">
                <!-- main content container  -->
                <div class="flex flex-col md:flex-row justify-between">
                    <!-- text content  -->
                    <div class="flex flex-col  items-start justify-center  p-10 gap-y-8 flex-1 text-black">
                        <h1 class="text-5xl font-bold">Himalayan Heritage Kathmandu</h1>
                        <p> Discover the soul of Nepal with our Kathmandu package. Explore ancient temples, breathtaking
                            landscapes, and vibrant culture. Your adventure awaits!</p>
                        <button class="btn bg-blue-500 hover:bg-teal-300 p-4 text-white border-none">Purchase</button>
                    </div>
                    <!-- image content  -->
                    <div class="flex-1  py-8 md:py-24 px-3  "><img src="resources/images/Carousal_pic_2.jpeg"
                            class="w-[400px] " />
                    </div>
                </div>
                <!-- button container  -->
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide1" class="btn btn-warning opacity-55 hover:opacity-100">❮</a>
                    <a href="#slide3" class="btn btn-warning opacity-55 hover:opacity-100">❯</a>
                </div>
            </div>
            <!-- sslide 3 -->
            <div id="slide3" class="carousel-item relative w-full bg-gradient-to-r from-blue-200 to-blue-400">
                <!-- main content container  -->
                <div class="flex flex-col md:flex-row justify-between">
                    <!-- text content  -->
                    <div class="flex flex-col  items-start justify-center gap-y-10 p-10 flex-1 text-black">
                        <h1 class="text-5xl font-bold">Tropical Twin Treasures</h1>
                        <p>Experience the pristine beaches of the Maldives, then explore Sri Lanka's cultural treasures.
                            This package blends relaxation with adventure in two stunning Indian Ocean destinations.</p>
                        <button class="btn  bg-blue-500 hover:bg-teal-300 p-4 text-white border-none">Purchase</button>
                    </div>
                    <!-- image content  -->
                    <div class="flex-1  py-8 md:py-24 px-3  "><img src="resources/images/carousal pic 3.jpeg"
                            class="w-[400px] " />
                    </div>
                </div>
                <!-- button container  -->
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide2" class="btn btn-warning opacity-55 hover:opacity-100">❮</a>
                    <a href="#slide4" class="btn btn-warning opacity-55 hover:opacity-100">❯</a>
                </div>
            </div>
            <!-- slide 4  -->

            <div id="slide4" class="carousel-item relative w-full bg-gradient-to-r from-blue-200 to-blue-400">
                <!-- main content container  -->
                <div class="flex flex-col md:flex-row justify-between">
                    <!-- text content  -->
                    <div class="flex flex-col  items-start justify-center gap-y-10 p-10 flex-1 text-black">
                        <h1 class="text-5xl font-bold">Dream Destinations, Dream Discounts</h1>
                        <p>Your dream trip is now more affordable. Enjoy 30% off economy flights with Oman Air.</p>
                        <button class="btn  bg-blue-500 hover:bg-teal-300 p-4 text-white border-none">Purchase</button>
                    </div>
                    <!-- image content  -->
                    <div class="flex-1  py-8 md:py-24 px-3  "><img src="resources/images/carousal pic 4.jpeg"
                            class="w-[400px] " />
                    </div>
                </div>
                <!-- button container  -->
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide3" class="btn btn-warning opacity-55 hover:opacity-100">❮</a>
                    <a href="#slide1" class="btn btn-warning opacity-55 hover:opacity-100">❯</a>
                </div>
            </div>
        </div>
    </section>
    <!-- hero section  -->
    <section
        class="mx-10 mt-2 p-10 grid grid-cols-2 items-center justify-between gap-10  bg-[url('resources/images/hero_bg.jpg')] rounded-lg ">
        <!-- #contents section -->
        <div
            class="flex flex-col gap-4 bg-[#004d40] justify-center items-center bg-gradient-to-r from-black via-gray-800 to-transparent p-6 rounded-lg">
            <h1 class="text-2xl font-bold font-mono text-orange-500">Explore the World with Ease!</h1>
            <h3 class="text-lg font-normal text-white"><i>Explore breathtaking destinations, plan seamless trips, and
                    book hassle-free accommodations—all in one place. Whether you're dreaming of a relaxing getaway, an
                    exciting adventure, or a cultural escape, we make travel easy and unforgettable.</i></h3>
            <!-- button section  -->
            <div class="flex flex-row gap-3">
                <!-- Leads to search or booking page -->
                <button class="btn p-4 bg-red-500 hover:bg-red-600 border-none"><i class="fa-solid fa-camera"
                        style="color: #B197FC;"></i>Start your Journey</button>
                <!-- Leads to a list of travel locations -->
                <button class="btn p4 bg-green-300 p-4 hover:bg-green-200 "><i
                        class="fa-solid fa-magnifying-glass fa-sm" style="color: #000000;"></i>Explore
                    Destinations</button>
            </div>
        </div>
        <div>
            <img class="max-w-[90%] rounded-2xl self-end" src="resources/images/hero.jfif" alt="">
        </div>
    </section>
    <!-- popular destinations  -->
    <section class="p-10">
        <h2 class="text-3xl font-bold text-center mb-6">Popular Destinations</h2>
        <div class="grid grid-cols-3 gap-6">
            <!-- Bali -->
            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination1.jpg" class="rounded-lg">
                <h3 class="text-xl font-semibold header-font mt-3">Bali, Indonesia</h3>
                <p class="text-gray-600">A symphony of nature, culture, and serenity. Let your journey begin.</p>
                <button class="btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black ">View
                    More</button>
            </div>
            <!-- santorini, greece  -->
            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination2.jpg" class="rounded-lg">
                <h3 class="text-xl font-semibold header-font mt-3">Santorini, Greece</h3>
                <p class="text-gray-600">Enjoy stunning views and charming whitewashed villages.</p>
                <button
                    class="btn btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black  mt-1">View
                    More</button>
            </div>
            <!-- kyoto japan  -->

            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination3.jpg" class="rounded-lg">
                <h3 class="text-xl font-bold mt-1 header-font">Kyoto, Japan</h3>
                <p class="text-gray-600">A tapestry of temples, gardens, and geishas. Your unforgettable adventure
                    awaits.</p>
                <button
                    class="btn btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black  mt-1">View
                    More</button>
            </div>
            <!-- paris  -->
            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination4.jpg" class="rounded-lg">
                <h3 class="text-xl font-bold mt-1 header-font">Paris, France</h3>
                <p class="text-gray-600">A tapestry of temples, gardens, and geishas. Your unforgettable adventure
                    awaits.</p>
                <button
                    class="btn btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black   mt-1">View
                    More</button>
            </div>
            <!-- barcelona  -->
            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination5.jpg" class="rounded-lg">
                <h3 class="text-xl font-bold mt-1 header-font">Barcelona, Spain</h3>
                <p class="text-gray-600">A tapestry of temples, gardens, and geishas. Your unforgettable adventure
                    awaits.</p>
                <button
                    class="btn btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black   mt-1">View
                    More</button>
            </div>
            <!-- sundarban  -->
            <div class="bg-white shadow-lg p-4 rounded-lg flex flex-col justify-between items-start">
                <img src="resources/images/destination6.jpg" class="rounded-lg">
                <h3 class="text-xl font-bold mt-1 header-font">Sundarban, Bangladesh</h3>
                <p class="text-gray-600">A tapestry of temples, gardens, and geishas. Your unforgettable adventure
                    awaits.</p>
                <button
                    class="btn btn p-4 text-white bg-blue-500 rounded-lg hover:bg-teal-300 hover:text-black   mt-1">View
                    More</button>
            </div>
        </div>
    </section>
    <!-- packages section -->
    <section class="container  mt-2 p-10">
        <h2 class="text-3xl font-bold text-center mb-6">Top Travel Packages</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($packages as $row):
                $headline = $row['city'] . ", " . $row['country'];
                $image_url = !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'default_image_url.jpg';
                $price = htmlspecialchars($row['price']);
                $duration = htmlspecialchars($row['duration']);
                $descriptions = htmlspecialchars($row['descriptions']);
                $availability = htmlspecialchars($row['availability']);
                $commission_rate = htmlspecialchars($row['commission_rate']);
                $short_description = substr($descriptions, 0, 100) . (strlen($descriptions) > 100 ? '...' : '');
                ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                    <img src="<?= $image_url ?>" alt="Package Photo" class="w-full h-48 object-cover">
                    <div class="p-6 flex-grow">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2"><?= $headline ?></h2>
                        <p class="text-sm text-gray-600 mb-1"><strong>Trip Duration:</strong> <?= $duration ?> days</p>
                        <p class="text-sm text-gray-600 mb-3"><strong>Price:</strong> ৳<?= $price ?></p>

                        <div class="flex justify-between items-center">
                            <button onclick="openModal(<?= $row['id'] ?>)" class="text-blue-500 hover:underline">View
                                More</button>
                            <a href="book_package.php?id=<?= $row['id'] ?>"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-<?= $row['id'] ?>"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20  backdrop-blur-sm">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto relative p-6">
                        <!-- Close Button -->
                        <button onclick="closeModal(<?= $row['id'] ?>)"
                            class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl font-bold z-10">
                            &times;
                        </button>

                        <div class="pr-2">
                            <h3 class="text-lg font-semibold mb-2"><?= $headline ?> – Full Package Details</h3>
                            <p class="text-sm text-gray-600 mb-2"><strong>Hotel:</strong>
                                <?= htmlspecialchars($row['hotel_name']) ?></p>
                            <p class="text-sm text-gray-600 mb-2"><strong>Availability:</strong> <?= $availability ?> rooms
                            </p>
                            <p class="text-sm text-gray-600 mb-2"><strong>Commission:</strong> <?= $commission_rate ?>%</p>
                            <hr class="my-3">
                            <p class="text-sm text-gray-700 whitespace-pre-line"><?= nl2br($descriptions) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <div class="max-w-4xl mx-auto py-10 px-5  mt-2">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Frequently Asked Questions</h2>
        <div class="space-y-4">
            <?php
            $faqs = [
                "What destinations do you offer?" => "We offer a wide range of destinations, including tropical beaches, historic cities, and adventure locations worldwide.",
                "How do I book a trip?" => "You can book a trip by selecting your destination, choosing a package, and completing the checkout process on our website.",
                "What payment methods do you accept?" => "We accept credit cards, PayPal, and other online payment options.",
                "Can I cancel or reschedule my booking?" => "Yes, you can cancel or reschedule your booking depending on the policy of the chosen package. Please check the terms before booking."
            ];

            foreach ($faqs as $question => $answer):
                ?>
                <div class="bg-white shadow-md p-5 rounded-lg">
                    <button class="w-full text-left font-semibold text-gray-800 flex justify-between"
                        onclick="toggleFAQ(this)">
                        <?php echo $question; ?>
                        <span class="text-xl">+</span>
                    </button>
                    <p class="mt-2 text-gray-600 hidden"><?php echo $answer; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function toggleFAQ(button) {
            const answer = button.nextElementSibling;
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                button.querySelector('span').textContent = '-';
            } else {
                answer.classList.add('hidden');
                button.querySelector('span').textContent = '+';
            }
        }
    </script>
    <!-- reviews section -->
    <section class="grid grid-cols-3 mx-10 mt-2 gap-y-4 gap-x-2">
        <!-- card 1 -->
        <div
            class="flex flex-col justify-center items-center bg-gradient-to-r from-blue-200 to-blue-400 p-6 rounded-lg">
            <img src="resources/images/avatar-1.jpg" alt="" class="rounded-full max-h-60 ">
            <div class="flex flex-row gap-x-2 mt-4">
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
            </div>
            <p class="text-white text-center mt-4">"I had an amazing experience with Geo Trips. The booking process was
                easy, and the trip was unforgettable!"</p>
            <h4 class="text-white font-semibold mt-4">- Jane Doe</h4>
        </div>
        <!-- card 2 -->
        <div
            class="flex flex-col justify-center items-center bg-gradient-to-r from-teal-400 to-yellow-400 p-6 rounded-lg">
            <img src="resources/images/avatar-2.jpg" alt="" class="rounded-full max-h-60  ">
            <div class="flex flex-row gap-x-2 mt-4">
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
            </div>
            <p class="text-white text-center mt-4">"The guides' deep knowledge and passion truly enhanced the
                experience, making complex geological concepts accessible and fascinating.!"</p>
            <h4 class="text-white font-semibold mt-4">- Oscar Rio</h4>
        </div>
        <!-- card 3 -->
        <div
            class="flex flex-col justify-center items-center bg-gradient-to-r from-red-500 to-purple-400 p-6 rounded-lg">
            <img src="resources/images/avatar-3.jpg" alt="" class="rounded-full max-h-60">
            <div class="flex flex-row gap-x-2 mt-4">
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
            </div>
            <p class="text-white text-center mt-4">"From meticulously planned itineraries to exceptional field
                experiences, Geo Trips provides an unforgettable journey into the earth's remarkable history."</p>
            <h4 class="text-white font-semibold mt-4">- Alexander Sorloth</h4>
        </div>
    </section>
    <!-- footer section  -->
    <?php include 'things/footer.php'; ?>



</body>

</html>