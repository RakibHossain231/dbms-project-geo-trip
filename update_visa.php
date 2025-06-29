<?php
session_start();
if (empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type'] !== 'admin')) {
    header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
    exit();
} else {
    $admin_id = $_SESSION['id'];
    include 'things/db_connect.php';

    // Get the visa ID from URL
    if (!isset($_GET['id'])) {
        die("Visa application ID not provided.");
    }

    $visa_id = $_GET['id'];

    // Fetch visa application
    $query = "SELECT * FROM visa_application WHERE id = '$visa_id'";
    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) === 0) {
        die("Visa application not found.");
    }
    $visa = mysqli_fetch_assoc($result);
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = $_POST['visa_status'];
    $new_comment = mysqli_real_escape_string($conn, $_POST['admin_comment']);

    $update_sql = "UPDATE visa_application 
                   SET Visa_status = '$new_status', Admin_comment = '$new_comment' 
                   WHERE Id = '$visa_id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: admin_visa_view.php?msg=Visa+application+updated+successfully");
        exit();
    } else {
        $error = "Failed to update visa application.";
    }
}
include('things/top.php');
?>


<body class="bg-gray-100 text-gray-800">
<?php  include('things/navbar.php'); ?>
<div class="max-w-2xl mx-auto p-6 mt-10 bg-slate-100 shadow-md rounded-md ">
    <h2 class="text-2xl font-bold mb-6 text-blue-700 text-center">Update Visa Application</h2>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-slate-50 p-2 rounded-lg">
        <!-- Visa Status -->
        <div class="mb-6">
            <label for="visa_status" class="block text-Large font-semibold text-gray-600 mb-2">Visa Status</label>
            <select name="visa_status" id="visa_status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white">
                <option class="bg-gray-100 text-black font-medium text-center" value="Pending" <?= $visa['visa_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option class="bg-green-100 text-black font-medium text-center" value="Approved" <?= $visa['visa_status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                <option class="bg-red-100 text-black font-medium text-center" value="Rejected" <?= $visa['visa_status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>
        </div>

        <!-- Admin Comment -->
        <div class="mb-4">
            <label for="admin_comment" class="block font-medium mb-1">Admin Comment</label>
            <textarea name="admin_comment" id="admin_comment" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-center"  ><?= htmlspecialchars($visa['admin_comment']) ?></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between">
            <a href="admin_visa_view.php" class="text-blue-600 hover:underline">← Back to Visa List</a>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

</body>
<?php include('things/footer.php') ?>
</html>

<?php mysqli_close($conn); ?>
