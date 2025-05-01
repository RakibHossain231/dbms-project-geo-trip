<?php
include 'things/top.php';
include 'things/db_connect.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = " SELECT * FROM admin WHERE id = $id;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM admin WHERE id = $id;";
    $data = mysqli_query($conn, $query);
    if ($data) {
?>
        <!-- a small message about deletation -->
        <script>
            alert("Customer Deleted Successfully")
        </script>
<?php
        sleep(1);
        mysqli_close($conn);
        header('Location: customers_list.php?msg=Admin+deleted+successfully');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

?>

<body>
    <?php include 'things/navbar.php' ?>
    <div class="max-w-md mx-auto mt-10 bg-white/90 backdrop-blur-lg shadow-xl rounded-2xl p-6 border border-gray-200">
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
            <form action="delete_admin.php?id=<?php echo $_GET['id'] ?>" method="POST">
                <input type="submit" value="Delete" class="bg-black text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
            </form>

        </div>
    </div>


</body>
<?php include 'things/footer.php' ?>

</html>