<?php 
session_start();
if(empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type']!== 'admin') ){
    header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
}
?>

<?php
include 'things/top.php';
?>


<!-- work to fetch all the customer data  -->
<?php
include 'things/db_connect.php';
if (!$conn) {
    die("Connection Failed: ") . mysqli_error($conn);
} else {
    $sql1 = 'Select * from customer;';
    $result = mysqli_query($conn, $sql1);
    $c_len = 0;
    $a_len = 0;
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $c_len = mysqli_num_rows($result);
        mysqli_free_result($result);
    }
    $sql2 = "SELECT * FROM admin;";
    $result = mysqli_query($conn, $sql2);
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        $admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $a_len = mysqli_num_rows($result);
        mysqli_free_result($result);
    }
    $sql3 = 'Select * from location;';
    $result = mysqli_query($conn, $sql1);
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        $locations = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
    mysqli_close($conn);
}
?>

<body>
    <header>
        <?php include 'things/navbar.php' ?>
    </header>
    <h1 class="blink text-center p-2 bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent text-2xl font-bold mt-2">
        <?php if(!empty($_GET['msg'])){
            echo $_GET['msg'];
        } ?>
    </h1>
    <!-- Customer Data showing section  -->
    <section class=" container  mx-2 p-4 flex flex-col  rounded-lg  mt-4 mb-8 ">
        <h1 class="text-xl font-bold text-slate-800 pb-2 ">Customer List <i class="fa-regular fa-circle-user" style="color: #0b105b;"></i></h1>
        <div class="overflow-x-scroll">
            <table class=" table-auto border-2 border-gray-300">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="py-3 px-6 border-b ">ID</th>
                        <th class="py-3 px-6 border-b ">First Name</th>
                        <th class="py-3 px-6 border-b ">Last Name</th>
                        <th class="py-3 px-6 border-b ">DOB</th>
                        <th class="py-3 px-6 border-b ">Phone</th>
                        <th class="py-3 px-6 border-b ">Email</th>
                        <th class="py-3 px-6 border-b col-span-2 ">Address</th>
                        <th class="py-3 px-6 border-b ">Nationality</th>
                        <th class="py-3 px-6 border-b ">Passport No</th>
                        <th class="py-3 px-6 border-b ">User Name</th>
                        <th class="py-3 px-6 border-b ">Operations</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black divide-y divide-indigo-400">
                    <?php
                    function showCustomer($customer)
                    {
                        echo "<tr class='hover:bg-blue-100 '>
                        <td class='py-3 px-6'>{$customer['customerID']}</td>
                        <td class='py-3 px-6'>{$customer['f_name']}</td>
                        <td class='py-3 px-6'>{$customer['l_name']}</td>
                        <td class='py-3 px-6'>{$customer['dob']}</td>
                        <td class='py-3 px-6'>{$customer['phone']}</td>
                        <td class='py-3 px-6'>{$customer['email']}</td>
                        <td class='text-sm py-3 px-6 col-span-2'>{$customer['address']}</td>
                        <td class='py-3 px-6'>{$customer['nationality']}</td>
                        <td class='py-3 px-6'>{$customer['pp_no']}</td>
                        <td class='py-3 px-6'>{$customer['user_name']}</td>
                        <td class='py-3 px-6 flex flex-row gap-2 justify-center items-center '><a href='update_design.php?id={$customer['customerID']} ' class='hover:bg-blue-500 p-2 rounded-sm bg-black text-white '>Update</a> <a href='delete_customer.php?id={$customer['customerID']} ' class='hover:bg-blue-500 p-2 rounded-sm bg-red-600 text-white '>Delete</a></td>

                    </tr>";
                    }

                    if ($c_len > 0) {
                        foreach ($customers as $customer) {
                            showCustomer($customer);
                        }
                    } else {
                        echo "<tr class='hover:bg-blue-100 '>
                        <td class='py-3 px-6'>No Data Found</td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- admin data showing section  -->
    <section class="container mx-2 p-4 flex flex-col  rounded-lg  mt-4 mb-8 ">
        <h1 class="text-xl font-bold text-slate-800 pb-2 ">Admin List <i class="fa-solid fa-screwdriver-wrench"></i></h1>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border border-gray-300">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-3 px-6 border-b">ID</th>
                        <th class="py-3 px-6 border-b">Name</th>
                        <th class="py-3 px-6 border-b">Email</th>
                        <th class="py-3 px-6 border-b">Joining Date</th>
                        <th class="py-3 px-6 border-b">Operations</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black divide-y divide-indigo-400">
                    <?php
                    function showAdmin($admin)
                    {
                        echo "<tr class='hover:bg-blue-100 hover:font-semibold font-sans'>
                        <td class='py-3 px-6'>{$admin['id']}</td>
                        <td class='py-3 px-6'>{$admin['name']}</td>
                        <td class='py-3 px-6'>{$admin['email']}</td>
                        <td class='py-3 px-6'>{$admin['join_date']}</td>
                        <td class='py-3 px-6 flex flex-row gap-2 justify-center items-center '><a href='update_admin.php?id={$admin['id']} ' class='hover:bg-blue-500 p-2 rounded-sm bg-black text-white '>Update</a> <a href='delete_admin.php?id={$admin['id']} ' class='hover:bg-blue-500 p-2 rounded-sm bg-red-600 text-white '>Delete</a></td>

                    </tr>";
                    }

                    if ($a_len > 0) {
                        foreach ($admins as $admin) {
                            showAdmin($admin);
                        }
                    } else {
                        echo "<tr class='hover:bg-blue-100 '>
                        <td class='py-3 px-6'>No Data Found</td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php include 'things/footer.php' ?>
</body>