<?php include 'things/top.php' ?>

<body class="bg-cover bg-center min-h-screen " style="background-image: url('image-cache.jpeg');">
    <?php include 'things/navbar.php' ?>
    <div class="flex items-center justify-center w-full min-h-[80vh] bg-[url('resources/images/hero_bg.jpg')]" >
        <div class="bg-[#1B262C] backdrop-blur-md border-2 border-black shadow-lg rounded-lg p-8 w-full max-w-md">
            <div class="mb-6">
                <label for="login" class="block text-[#a5dbff] font-medium">Username</label>
                <input type="text" id="login" name="login" placeholder="Type your Username" class="w-full p-2 border-1 border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-700 bg-slate-400 text-white">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-[#a5dbff] font-medium">Password</label>
                <input type="password" id="password" name="password" placeholder="Type your Password" class="w-full p-2 border-1 border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-700 bg-slate-400 text-white">
            </div>
            <div>
                <input type="submit" value="SIGN IN" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-2 focus:outline-none focus:ring-lime-200  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">
            </div>
        </div>
    </div>
</body>
<?php include 'things/footer.php' ?>

</html>