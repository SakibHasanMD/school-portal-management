<?php 
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

if (isset($_GET["add-announcements"])) {
    $title = $_GET["title"];
    $subject = $_GET["subject"];
    $details = $_GET["details"];
    $postDate = date("Y-m-d H:i:s");
    $lastEditedDate = $postDate;
    $insertsql = "INSERT INTO announcements (announcement_title, announcement_subject, announcement_details, post_date, last_edited_date)
                    VALUES ('$title', '$subject', '$details', '$postDate', '$lastEditedDate')";
    $resinsert=mysqli_query($conn, $insertsql);

    if ($resinsert) {
        $_SESSION['ann_message']="Announcement added successfully!";
         
        
    } else {
        $_SESSION['ann_message']="Error: " . $insertsql . "Try Again";
        
    }
    header("Location: ../View/view-announcements.php");
    }
    
    else if (isset($_GET["edit-announcements"])) {

    $editid= $_GET['edit-announcements'];
    $etitle = $_GET["title"];
    $esubject = $_GET["subject"];
    $edetails = $_GET["details"];
    $elastEditedDate = date("Y-m-d H:i:s");
    $editsql = "UPDATE announcements 
              SET announcement_title = '$etitle', 
                  announcement_subject = '$esubject', 
                  announcement_details = '$edetails', 
                  last_edited_date = '$elastEditedDate' 
              WHERE announcementID = '$editid'";
    $resedit=mysqli_query($conn, $editsql);

    if ($resedit) {
         $_SESSION['ann_message']="Announcement Edited successfully!";
    } else {
         $_SESSION['ann_message']="Error: " . $resedit . "Try Again";
    }
    header("Location: ../View/view-announcements.php");
    }
    
    else if(isset($_GET['del']))
    {
        $delid= $_GET['del'];
        $sqldel="Delete from announcements where announcementID='$delid'";
        $delr=mysqli_query($conn,$sqldel);

         if ($delr) {
         $_SESSION['ann_message']="Announcement Deleted Sucessfully!";
        } else {
             $_SESSION['ann_message']="Error: " . $delr . "Try Again";
        }

    header("Location: ../View/view-announcements.php");
    }

?>