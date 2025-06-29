<?php
session_start();
require 'things/db_connect.php';

if (empty($_SESSION['id']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php?msg=You+must+login+first+to+submit+a+visa+assistance+request");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Detect user's country using IP
function getCountryByIP() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = "https://ipapi.co/{$ip}/json/";
    $response = @file_get_contents($url);

    if ($response) {
        $data = json_decode($response, true);
        return $data['country_name'] ?? 'Thailand';
    }

    return 'Thailand';
}

// Handle POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['id'];

    // Get a random admin ID
    $sql = "SELECT id FROM admin ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $admin_id = $row['id'];

        // Insert application entry
        $insert_sql = "INSERT INTO visa_application (customer_id, admin_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $customer_id, $admin_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Set up folder name
    $userId = $_POST['user_id'] ?? 'anonymous';
    $country = getCountryByIP();
    $date = date('Ymd');
    $time = date('His');
    $folderName = "uploads/{$userId}_{$country}_{$date}_{$time}";
    $uploadDir = $folderName . "/";

    // Create folder if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Function to save each file
    function saveFile($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES[$fileKey]['name']);
            $target = $uploadDir . time() . "_" . $filename;
            move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target);
            return $target;
        }
        return null;
    }

    // Upload all files
    saveFile('passport', $uploadDir);
    saveFile('photo', $uploadDir);
    saveFile('salary_statement', $uploadDir);
    saveFile('personal_statement', $uploadDir);
    saveFile('salary_slip', $uploadDir);
    saveFile('solvency', $uploadDir);
    saveFile('noc_letter', $uploadDir);
    saveFile('visiting_card', $uploadDir);
    saveFile('office_id', $uploadDir);
    saveFile('old_passport', $uploadDir);
    saveFile('student_docs', $uploadDir);

    // Redirect to avoid resubmission on refresh
    header("Location: visa_docs.php?submitted=1");
    exit;

}

// Display confirmation if redirected
$submitted = isset($_['submitted']);
?>

<?php include 'things/top.php'; ?>
<body class="bg-sky-100">
<?php include 'things/navbar.php'; ?>

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">

    <?php if ($submitted): ?>
        <h2 class="text-2xl font-bold text-green-600 mb-4 text-center">Documents Submitted Successfully!</h2>
        <p class="text-gray-700 text-center">Thank you for submitting your Thailand visa documents.</p>
        <div class="text-center mt-6">
            <a href="visa_docs.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit Another Application
            </a>
        </div>
         <?php else: ?>
        <h2 class="text-2xl font-bold text-blue-600 text-center mb-6">Upload Documents for Thailand Visa</h2>
        <form action="" method="post" enctype="multipart/form-data" class="space-y-4"
              onsubmit="this.querySelector('button[type=submit]').disabled = true;">

            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">

            <div>
                <label class="block font-semibold mb-1">Valid Passport (6+ months)</label>
                <input type="file" name="passport" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">2 Recent Photos (4.5x3.5 cm, Matte Paper)</label>
                <input type="file" name="photo" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Bank Salary Statement (6 Months)</label>
                <input type="file" name="salary_statement" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Personal Bank Statement</label>
                <input type="file" name="personal_statement" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Last 3 Salary Slips</label>
                <input type="file" name="salary_slip" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Bank Solvency Certificate</label>
                <input type="file" name="solvency" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">NOC Letter (2 copies on office pad)</label>
                <input type="file" name="noc_letter" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Visiting Card</label>
                <input type="file" name="visiting_card" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Office ID Card (Copy)</label>
                <input type="file" name="office_id" required class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Old Passport (If any)</label>
                <input type="file" name="old_passport" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Student ID & Tuition Fee Receipt (If student)</label>
                <input type="file" name="student_docs" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                    Submit Application
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
<?php include 'things/footer.php'; ?>
</html>
