<?php
session_start(); // ✅ Required to access session data

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Logout'])) {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to login with success message
    header("Location: admin_login.php?msg=You+have+logged+out+successfully");
    exit(); // ✅ Always use exit after header
} else {
    // Optional: Redirect if accessed directly
    header("Location: admin_panel.php");
    exit();
}
