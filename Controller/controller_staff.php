	<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}
if(isset($_GET['del']))
	{
	    $id= $_GET['del'];
	    $sqldel="Delete from users where ID='$id'";
	    echo "Deleted Sucessfully!";
	    $delr=mysqli_query($conn,$sqldel);

         if ($delr) {
         $_SESSION['staff_message']="Staff Suspended Sucessfully!";
        } else {
             $_SESSION['staff_message']="Error: " . $delr . "Try Again";
        }

    header("Location: ../View/staff-management.php");
    }
	

?>