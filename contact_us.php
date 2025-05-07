<?php include 'things/top.php'; ?>

<body>
    <?php include 'things/navbar.php' ?>
</body>
<!-- contact us box container  -->
<div class="max-w-[90%] mx-auto bg-[#0D1821] shadow-lg rounded-2xl p-8 md:p-12 space-y-6 mt-1 text-white grid grid-cols-2 gap-4 items-center justify-eve">
    <!-- text container  -->
    <div class="flex flex-col items-start justify-center p-4 gap-y-5">
        <div>
            <h1 class="text-2xl  font-serif font-bold text-blue-300  ">Get In Touch With Us</h1>
            <p class="text-base  ">
                Have a question about your next adventure? Need help planning the perfect trip? We're here for you! Whether it's booking inquiries, travel recommendations, or any other assistance, feel free to reach out. We're always happy to help!
            </p>
        </div>
        <div>
            <i class="fa-solid fa-phone mr-1" style="color: #74C0FC;"></i>01913389573 <br>
            <i class="fa-brands fa-whatsapp mr-1" style="color: #1fc75a;"></i>01913389573 <br>
            <i class="fa-duotone fa-solid fa-envelope mr-1" style="--fa-primary-color: #00d5ff; --fa-secondary-color: #4b84af; --fa-secondary-opacity: 1;"></i>Geotrips19@gmail.com<br>
            <i class="fa-duotone fa-solid fa-envelope mr-1" style="--fa-primary-color: #00d5ff; --fa-secondary-color:#4b84af; --fa-secondary-opacity:1;"></i>Mesbah_70@yahoo.com<br>
        </div>

        <div>
            <h3 class="font-bold text-xl font-serif text-blue-300  ">Prefer a face-to-face chat? </h3>
            <p class="font-base ">
                We'd love to welcome you to our office! Drop by during business hours, and our travel experts will be happy to assist you. Let's plan your dream trip together!
            </p>

        </div>
        <div class="flex flex-col items-start gap-1">
            <h4 class="font-bold font-lg  font-serif text-teal-300 ">Office Address</h4>
            <p>
                154,Motijheel C/A, Near Wapda Mosque <br>
                Dhaka-1000,Bangladesh
            </p>
            <br>
            <iframe class="rounded-lg" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.2909752728699!2d90.42280648531322!3d23.723989634939766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b84e34ac5e4d%3A0x748363a37ab176cf!2sJamia%20Darul%20Ulum%20Motijheel!5e0!3m2!1sen!2sbd!4v1742979895096!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- form container  -->
    <div class="flex flex-col  ">
        <div class="flex flex-col bg-gradient-to-r from-[#1E293B] to-[rgb(51,65,85)] p-8 rounded-xl shadow-lg">
            <h1 class="text-2xl font-bold text-orange-400 mb-4">Send Us an Email</h1>
            <form action="contact_process.php" method="post">
                <div class="flex flex-col gap-4">
                    <input type="text" placeholder="Your Name" name="customer_name"
                        class="p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring-2 focus:ring-orange-400 outline-none">

                    <input type="email" placeholder="Your Email" name="customer_email"
                        class="p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring-2 focus:ring-orange-400 outline-none">

                    <input type="text" placeholder="Subject" name="mail_subject"
                        class="p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring-2 focus:ring-orange-400 outline-none">

                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Your Message"
                        class="p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring-2 focus:ring-orange-400 outline-none"></textarea>

                    
                </div>
                <button class="btn bg-white text-black  p-4 hover:bg-black hover:text-cyan-300  font-semibold rounded-lg shadow-md transition-all duration-300 mx-auto mt-2">
                        Send Message
                    </button>
            </form>
            
        </div>
    </div>
<div class="col-span-2  mt-4 bg-slate-400 rounded-lg">
<?php include 'things/footer.php'; ?>
</div>
</html>