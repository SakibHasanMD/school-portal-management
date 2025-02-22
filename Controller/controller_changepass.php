<?php
session_start();
include('../Model/DBOperations.php');
if (!isset($_SESSION['ID'])) {
    header("Location: login_view.php");
    echo "You Need To Login First!";
    exit();
}

if (isset($_POST['change-pass'])) {
    $oldPassword = $_POST["old-password"];
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm-password"];
    $userId = $_SESSION['ID'];


    if (changePassword($conn, $oldPassword, $newPassword, $userId)) {
        session_destroy();
        session_start();
        $_SESSION['error_message']="Password changed successfully! Login to Continue!";
        header("Location: ../View/login_view.php");
        
        
    } else {
        echo "Error changing password.";
    }
}
?>