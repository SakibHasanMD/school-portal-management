<?php 

session_start();
include('../Model/DBOperations.php');



if (!isset($_SESSION['ID'])) {
    header("Location: login_view.php");
    echo "You Need To Login First!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
</head>
<body>
    <div class="container">
     <div class="sidebar">
        
        <?php include('sidebar.php') ?>
    </div>

   
    <div class="main-content">


        <div class="header">
            <h2>Change Password</h2>

            <div class="profile-container">
    <img width="50px" height="50px"  src="../Resource/pp.png">
    <div class="text-container">
      <div class="heading">
          
          <?php
            $userDetails = getUserDetailsById($conn, $_SESSION['ID']);
            echo $userDetails['fullname'];
            ?>

      </div>
      <div class="subheading"> <?php
          
            echo $userDetails['role'];
            ?></div>
  </div></div>
        </div>


        <!-- Table Section -->
        <div class="white-container">
         
        
       <div class="text-container">
        <div class="heading" style="color: black;">Reset Your Password:</div>
        <div class="subheading">Enter your old password that you used to login</div><br>
    <form method="post" action="../Controller/controller_changepass.php" onsubmit="return validateForm()">
        <label for="old-password">Old Password:</label><br>
        <div class="password-container">
            <input type="password" id="old-password" name="old-password">
            <span class="toggle-password" onclick="togglePassword('old-password')">👁️</span>
        </div><br>

        <label for="new-password">New Password:</label><br>
        <div class="password-container">
            <input type="password" id="new-password" name="new-password">
             <span id="new-password-error" class="error"></span><br>
            <span class="toggle-password" onclick="togglePassword('new-password')">👁️</span>
        </div><br>

        <label for="confirm-password">Confirm New Password:</label><br>
        <div class="password-container">
            <input type="password" id="confirm-password" name="confirm-password">
            <span class="toggle-password" onclick="togglePassword('confirm-password')">👁️</span>
             <span id="confirm-password-error" class="error"></span>
        </div><br>

        <input type="submit" value="Change Password" name="change-pass">
    </form>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }


          function validateForm() {
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const newPasswordError = document.getElementById('new-password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        // Check if New Password is empty
        if (!newPassword.trim()) {
            newPasswordError.textContent = "New Password is required";
            return false;
        }

        // Check if Confirm Password is empty
        if (!confirmPassword.trim()) {
            confirmPasswordError.textContent = "Confirm Password is required";
            return false;
        }

        // Check if New Password and Confirm Password match
        if (newPassword !== confirmPassword) {
            newPasswordError.textContent = "Passwords do not match";
            confirmPasswordError.textContent = "Passwords do not match";
            return false;
        }

        newPasswordError.textContent = "";
        confirmPasswordError.textContent = "";
        return true;
    }
    </script>

    </div>
    </div><
</div>
</body>
</html>
