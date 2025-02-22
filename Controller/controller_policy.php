<?php 
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}
if (isset($_GET["add-policy-n-rules"])) {
    $pnrtitle = $_GET["title"];
    $details = $_GET["details"];
    $postDate = date("Y-m-d H:i:s");
    $insertsql = "INSERT INTO policy_rules (pnr_title, pnr_details, pnr_date)
                    VALUES ('$pnrtitle', '$details', '$postDate')";
    $resinsert=mysqli_query($conn, $insertsql);

    if ($resinsert) {
        $_SESSION['pri_message']="Policy added successfully!";
         
        
    } else {
        $_SESSION['pri_message']="Error: " . $insertsql . "Try Again";
        
    }
    header("Location: ../View/view-policy_n_rules.php");
    }

    else if (isset($_GET["edit-policy-n-rules"])) {

    $editid= $_GET['edit-policy-n-rules'];
    $etitle = $_GET["title"];
    $edetails = $_GET["details"];
    $editedDate = date("Y-m-d H:i:s");
    $editsql = "UPDATE policy_rules 
              SET pnr_title = '$etitle', 
                  pnr_details = '$edetails', 
                  pnr_date = '$editedDate' 
              WHERE policy_id = '$editid'";
    $resedit=mysqli_query($conn, $editsql);

   if ($resedit) {
         $_SESSION['pri_message']="Policy Edited successfully!";
    } else {
         $_SESSION['pri_message']="Error: " . $resedit . "Try Again";
    }
    header("Location: ../View/view-policy_n_rules.php");
    }
    else if(isset($_GET['del']))
    {
        $delid= $_GET['del'];
        $sqldel="Delete from policy_rules where policy_id='$delid'";
        $delr=mysqli_query($conn,$sqldel);

         if ($delr) {
         $_SESSION['pri_message']="Policy Deleted Sucessfully!";
        } else {
             $_SESSION['pri_message']="Error: " . $delr . "Try Again";
        }

    header("Location: ../View/view-policy_n_rules.php");
    }

    
    ?>