<?php
session_start();
if (empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type'] !== 'admin')) {
    header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
} else {
    $admin_id = $_SESSION['id'];
    include 'things/db_connect.php';
    $query = " SELECT * FROM admin WHERE id = '$admin_id';";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

?>

<?php include 'things/top.php'; ?>

<body>
    <?php include 'things/navbar.php'; ?>
    <div class="max-w-md mx-auto my-10 bg-white/90 backdrop-blur-lg shadow-xl rounded-2xl p-6 border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-cyan-600 mb-6"><i class="fas fa-user-shield mr-2"></i>Admin Profile</h2>
        <hr class="mb-4 border-gray-300">

        <div class="space-y-4 text-gray-800 flex flex-col items-center min-w-[400px]">

            <div class="flex items-center gap-3">
                <i class="fas fa-user text-indigo-500 text-lg"></i>
                <p><span class="font-semibold">Name:</span> <?php echo htmlspecialchars($data['name']); ?></p>
            </div>

            <div class="flex items-center gap-3">
                <i class="fas fa-envelope text-indigo-500 text-lg"></i>
                <p><span class="font-semibold">Email:</span> <?php echo htmlspecialchars($data['email']); ?></p>
            </div>

            <div class="flex items-center gap-3">
                <i class="fas fa-calendar-alt text-indigo-500 text-lg"></i>
                <p><span class="font-semibold">Joining Date:</span> <?php echo htmlspecialchars(date('F d, Y', strtotime($data['join_date']))); ?></p>
            </div>
            <form action="logout.php?id=<?php echo $admin_id ?>" method="POST">
                <input type="submit" value="Logout" name="Logout" class="bg-black text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
            </form>

        </div>
    </div>
    <section class="min-h-screen bg-gradient-to-br from-slate-100 to-indigo-200 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-5xl bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200 p-10">

            <!-- Heading -->
            <h2 class="text-4xl font-extrabold text-center text-indigo-800 mb-10">
                <i class="fas fa-toolbox mr-2"></i>Admin Control Panel
            </h2>

            <!-- Button Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Users -->
                <a href="customers_list.php" class="admin-btn bg-indigo-50 border-indigo-200 text-indigo-700 hover:bg-indigo-100">
                    <i class="fas fa-users-cog text-2xl"></i>
                    <div>
                        <p class="font-semibold">Manage Users</p>
                        <p class="text-sm text-gray-600">Update/Delete Admins & Customers</p>
                    </div>
                </a>

                <!-- Search -->
                <a href="search_customer.php" class="admin-btn bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100">
                    <i class="fas fa-search text-2xl"></i>
                    <div>
                        <p class="font-semibold">Search Customers</p>
                        <p class="text-sm text-gray-600">Find customer records easily</p>
                    </div>
                </a>

                <!-- Packages  create-->
                <a href="package_creator.php" class="admin-btn bg-green-50 border-green-200 text-green-700 hover:bg-green-100">
                    <i class="fas fa-box-open text-2xl"></i>
                    <div>
                        <p class="font-semibold">Create Package</p>
                        <p class="text-sm text-gray-600">Add a new package To the website</p>
                    </div>
                </a>
                <!-- Packages  update-->
                <a href="package_list.php" class="admin-btn bg-green-50 border-green-200 text-green-700 hover:bg-green-100">
                    <i class="fas fa-box-open text-2xl"></i>
                    <div>
                        <p class="font-semibold">Modify Package</p>
                        <p class="text-sm text-gray-600">Modify The data of existing Packages</p>
                    </div>
                </a>

                <!-- Bookings -->
                <a href="admin_view_bookings.php" class="admin-btn bg-yellow-50 border-yellow-200 text-yellow-700 hover:bg-yellow-100">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">View Bookings</p>
                        <p class="text-sm text-gray-600">See and manage all bookings</p>
                    </div>
                </a>

                <!-- Payments -->
                <a href="pending_payment.php" class="admin-btn bg-red-50 border-red-200 text-red-700 hover:bg-red-100">
                    <i class="fas fa-money-check-alt text-2xl"></i>
                    <div>
                        <p class="font-semibold">Pending Payments</p>
                        <p class="text-sm text-gray-600">Verify and track payments</p>
                    </div>
                </a>

                <!-- Visa Assistance -->
                <a href="visa_data.php" class="admin-btn bg-purple-50 border-purple-200 text-purple-700 hover:bg-purple-100">
                    <i class="fas fa-passport text-2xl"></i>
                    <div>
                        <p class="font-semibold">Visa Assistance</p>
                        <p class="text-sm text-gray-600">Manage visa applications</p>
                    </div>
                </a>

                <!-- Coupons -->
                <a href="manage_coupons.php" class="admin-btn bg-amber-50 border-amber-200 text-amber-700 hover:bg-amber-100">
                    <i class="fas fa-ticket-alt text-2xl"></i>
                    <div>
                        <p class="font-semibold">Manage Coupons</p>
                        <p class="text-sm text-gray-600">Add, edit or expire coupons</p>
                    </div>
                </a>

                <!-- add new admin -->
                <a href="add_admin.php" class="admin-btn bg-slate-50 border-slate-200 text-slate-700 hover:bg-slate-100">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <div>
                        <p class="font-semibold">New Admin</p>
                        <p class="text-sm text-gray-600">Add new admin to the database</p>
                    </div>
                </a>
                <!-- Add Location -->
                <a href="add_location.php" class="admin-btn bg-sky-100 border-sky-300 text-blue-700 hover:bg-yellow-100 ">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">Add Location</p>
                        <p class="text-sm text-gray-600">Add New City To the Database</p>
                    </div>
                </a>
                <!-- Update Location -->
                <a href="update_location.php" class="admin-btn bg-green-100 border-green-300 text-green-700 hover:bg-green-500 ">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">Update Location</p>
                        <p class="text-sm text-gray-600">Update Location Data</p>
                    </div>
                </a>
                <!-- Add hotel -->
                <a href="add_hotel.php" class="admin-btn bg-sky-100 border-sky-300 text-blue-700 hover:bg-yellow-100 ">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">Add Hotel</p>
                        <p class="text-sm text-gray-600">Add New Hotel To the Database</p>
                    </div>
                </a>
                <!-- Update hotel -->
                <a href="update_hotel.php" class="admin-btn bg-green-100 border-green-300 text-green-700 hover:bg-green-500 ">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">Update Hotel</p>
                        <p class="text-sm text-gray-600">Fix Mistakes Of Hotel data</p>
                    </div>
                </a>
                <!-- Cancellations -->
                <a href="admin_cancellations.php" class="admin-btn bg-cyan-100 border-green-300 text-emerald-800 hover:bg-cyan-500 ">
                    <i class="fas fa-book text-2xl"></i>
                    <div>
                        <p class="font-semibold">Manage Cancellations</p>
                        <p class="text-sm text-gray-600">View Cancellation Data</p>
                    </div>
                </a>
                <a href="admin_visa_view.php" class="admin-btn bg-green-50 border-green-200 text-green-700 hover:bg-green-100">
                    <i class="fas fa-passport text-2xl"></i>
                    <div>
                        <p class="font-semibold">Visa Applications</p>
                        <p class="text-sm text-gray-600">View and manage visa requests</p>
                    </div>
                </a>


            </div>
        </div>
    </section>

    <!-- Tailwind Custom Class for Buttons -->
    <style>
        .admin-btn {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.25rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            /* Tailwind's gray-200 */
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        .admin-btn:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            background-color: white;
            color: black;
        }
    </style>

</body>
<?php include 'things/footer.php'; ?>