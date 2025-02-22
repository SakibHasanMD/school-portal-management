<?php 
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login_view.php");
    echo "You Need To Login First!";
    exit();
}

include('../Model/DBConnection.php');
    $policyandrule=getAllPolicyAndRules($conn);





?>
<!DOCTYPE html>
<html>
<head>
    <title>View Policy/Rules</title>

</head>
<body>
    <div class="container">
     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>

    <div class="main-content"><div class="header">
            <h2>Previously Posted Policy/Rules</h2>
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
            <h3>Policy/Rules</h3>
       



 <?php
      
      if(isset($_SESSION['pri_message'])){
        echo "
    <div class='alert'>
        <span  class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
        <strong id='pri_message'>" . $_SESSION['pri_message'] . "</strong>
    </div><br>";
         unset($_SESSION['pri_message']);
      }
     
     ?>



 <?php foreach ($policyandrule as $r ) {?>
<div class="announcement">
  <h2 class="announcement-title"><?php echo $r["pnr_title"] ?></h2>
  <div class="announcement-meta">
    <div class="date-posted"><?php echo "Date Posted: " . $r["pnr_date"] ?></div>
  </div>
  <div class="announcement-details"><?php echo $r["pnr_details"] ?></div>
  <div class="announcement-actions">
    <form method="get" action="policy-and-rules.php">
      <button type="submit" name="edit" value="<?php echo $r["policy_id"] ?>">Edit</button></form>
      <form method="get" action="../Controller/controller_policy.php">
      <button class="red" type="submit" name="del" value="<?php echo $r["policy_id"] ?>">Delete</button></form>
    </form>
  </div>


  
</div>
<?php } ?>


</div>



<div class="footer" style="display: none;">
    <div>Developed by - MD Sakib Hasan</div>
    <div>Faculty - Shafi Sir</div>
    <div>Fall 22-23   ㅤ</div>
</div>
</div>



</div>
  <style>
        .footer {
            height: 5vh; 
            background-color:  #292A35;
            display: flex;
            align-items: center;
            margin-left: 8px;
            font-size: 1.2rem;
            padding-left: 15px;
            position: fixed;
            color: white;
            bottom: 0;
            justify-content: space-between;
            text-align: center;
            width: 85%;
    </style>

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

    
    

</body></html>