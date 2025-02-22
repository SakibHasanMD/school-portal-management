<!-- controller_login.php -->

<?php
include('../Model/DBconnection.php');
session_start();

if (isset($_POST['login'])) {
    $lusername = $_POST['logusername'];
    $lpassword = $_POST['logpassword'];
    $sql1 = "SELECT * FROM users WHERE ID = '$lusername' AND password = '$lpassword'";
    $result = mysqli_query($conn, $sql1);

    if (!$result) {
        die("Error!");
    } 

    else if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['ID'] = $lusername;
        $r = mysqli_fetch_assoc($result);
        redirectUser($r["role"]);
        exit();
    } else {
         
       $_SESSION['error_message']="Login failed. Please check your username and password!";
    }


    header('location:../View/login_view.php');
    exit();
}

mysqli_close($conn);

function redirectUser($role) {
    switch ($role) {
        case 'Admin':
            header("Location: ../View/admin.php");
            break;
        case 'Principal':
            header("Location: ../View/principal-dashboard.php");
            break;
        case 'Teacher':
            header("Location: ../View/teacher.php");
            break;
        case 'Student':
            header("Location: ../View/student.php");
            break;
        default:
            echo "Unknown role";
            break;
    }
}
?>
