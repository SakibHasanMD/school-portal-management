<?php 
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

include('../Model/DBConnection.php');
    $announcements=getAnnouncements($conn);
     $userDetails = getUserDetailsById($conn, $_SESSION['ID']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Announcement</title>
</head>
<body>
    <div class="container">
     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>
    <div class="main-content"> <div class="header">
            <h2>Previous Announcement</h2>
            <div class="profile-container">
    <img width="50px" height="50px"  src="../Resource/pp.png">
    <div class="text-container">
      <div class="heading">
          
          <?php
            echo $userDetails['fullname']; ?>

      </div>
      <div class="subheading"> <?php
            echo $userDetails['role'];?></div>
  </div></div>
        </div>


        <!-- Table Section -->
        <div class="white-container">
            <h3>Announcement Management</h3>
        
   <?php
      
      if(isset($_SESSION['ann_message'])){
        echo "
    <div class='alert'>
        <span  class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
        <strong id='ann_message'>" . $_SESSION['ann_message'] . "</strong>
    </div><br>";
         unset($_SESSION['ann_message']);
      }
     
     ?>

 <?php foreach ($announcements as $r ) { ?>
<div class="announcement">
  <h2 class="announcement-title"><?php echo $r["announcement_title"] ?></h2>
  <div class="announcement-meta">
    <div class="date-posted"><?php echo "Date Posted: " . $r["post_date"] ?></div>
    <div class="last-edited"><?php echo "Last Edited: " . $r["last_edited_date"] ?></div>
  </div>
  <h3 class="announcement-subject"><?php echo "Subject: " . $r["announcement_subject"] ?></h3>
  <div class="announcement-details"><?php echo $r["announcement_details"] ?></div>
  <div class="announcement-actions">
    <form method="get" action="announcement.php">
      <button  type="submit" name="edit" value="<?php echo $r["announcementID"] ?>">Edit</button></form>
      <form method="get" action="../Controller/controller_announcement.php">
      <button class="red" type="submit" name="del" value="<?php echo $r["announcementID"] ?>">Delete</button></form>
    
  </div>
</div>
<?php } ?>

<script>
    
    // Function to create the "Read More" button and truncate text
function createReadMoreButton(announcementDetailsElement) {
  const textContent = announcementDetailsElement.textContent;
  const textLength = textContent.length;

  if (textLength > 200) {
    const truncatedText = textContent.substring(0, 200) + "...";
    const readMoreButton = document.createElement("button");
    readMoreButton.textContent = "Read More";
    readMoreButton.classList.add("read-more-button");

    readMoreButton.addEventListener("click", () => {
      announcementDetailsElement.textContent = textContent;
      readMoreButton.remove();
    });

    announcementDetailsElement.textContent = truncatedText;
    announcementDetailsElement.appendChild(readMoreButton);
  }
}

// Select all announcement details elements
const announcementDetailsElements = document.querySelectorAll(".announcement-details");

// Apply the "Read More" button to each element if necessary
announcementDetailsElements.forEach(createReadMoreButton);
</script>



























   
    </div>
    </div>
</div>
</body>
</html>