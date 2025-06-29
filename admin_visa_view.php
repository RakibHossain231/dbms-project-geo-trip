<?php
session_start();
if (empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type'] !== 'admin')) {
    header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
    exit();
} else {
    $admin_id = $_SESSION['id'];
    include 'things/db_connect.php';

    $query = "SELECT * FROM admin WHERE id = '$admin_id';";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

$visa_sql = "SELECT * FROM visa_application";
$visa_result = mysqli_query($conn, $visa_sql);
include('things/top.php');
?>


<body class="bg-gray-100 text-gray-900">
    <?php include('things/navbar.php'); ?>
    <div class="container mx-auto p-6 ">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Visa Applications</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600 ">
                    <tr class="bg-blue-200">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Submission Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Admin Comment</th>
                        <th class="px-6 py-4">Payment ID</th>
                        <th class="px-6 py-4">Admin ID</th>
                        <th class="px-6 py-4">Customer ID</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($visa_result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($visa_result)): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4"><?= htmlspecialchars($row['id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['submission_date']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['visa_status']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['admin_comment']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['payment_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['admin_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['customer_id']) ?></td>
                                <td class="px-6 py-4">
                                    <a href="update_visa.php?id=<?= $row['id'] ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded">
                                        Update
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No visa applications found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php
include('things/footer.php');
mysqli_close($conn);
?>
