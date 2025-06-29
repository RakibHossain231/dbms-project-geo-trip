<?php
// must have the PHPMailer downloaded onto system and stored into the project folder
use PHPMailer\PHPMailer\PHPMailer; // folder name must be PHPMailer
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php'; // or path to PHPMailer if not using Composer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['customer_name']);
    $email   = htmlspecialchars($_POST['customer_email']);
    $subject = htmlspecialchars($_POST['mail_subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';        // Your Gmail address
        $mail->Password   = '';          // App password from Google
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email content
        $mail->setFrom($email, $name);
        $mail->addAddress('nutamim15@gmail.com'); // Destination email

        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        header("Location:contact_process.php?msg=Mail+Sent+successfully");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<?php  include 'things/top.php' ?>
<body>
    <?php include 'things/navbar.php' ; ?>
    <?php if (isset($_GET['msg'])): ?>
        <div class="max-w-4xl mx-auto mt-6 h-[60vh]">
            <div class="bg-green-200 border-2 h-full border-green-500 text-green-900 px-8 py-6 rounded-2xl shadow-lg text-center flex flex-col justify-center align-center">
                <h2 class="text-2xl font-bold mb-2 blink">✅ Success!</h2>
                <p class="text-lg font-medium">
                    <?php echo htmlspecialchars($_GET['msg']); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
    

</body>
<?php include 'things/footer.php' ?> 
</html>