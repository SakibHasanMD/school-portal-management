<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}
    



     if (isset($_GET['edit'])) {
    $editID = $_GET['edit'];
    $editQuery = "SELECT * FROM announcements WHERE announcementID = '$editID'";
    $editResult = mysqli_query($conn, $editQuery);

    if ($editResult && $editRow = mysqli_fetch_assoc($editResult)) {
        $editTitle = $editRow['announcement_title'];
        $editSubject = $editRow['announcement_subject'];
        $editDetails = $editRow['announcement_details'];


    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Announcement Management</title>

</head>
<body>
    <div class="container">

    <!-- Sidebar -->
     <div class="sidebar">
        <!-- Include your sidebar content here -->
        <?php include('sidebar.php') ?>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
       
        <!-- Header Section -->

        <div class="header">
            <h2>Announcement</h2>

            <div class="profile-container">
    <img width="50px" height="50px"  src="Resource/pp.png">
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
            <h1>Add New Announcement</h1>
         
        <!-- Main content -->
        <form method="get" action="../Controller/controller_announcement.php">
        <label >Announcement Title:</label><br>
        <input type="text" name="title" value="<?php echo isset($editTitle) ? $editTitle : ''; ?>" required><br>
        <label >Announcement Subject:</label><br>
        <input type="text" name="subject" value="<?php echo isset($editSubject) ? $editSubject : ''; ?>" required><br>
        <label >Announcement Details:</label><br>
        <textarea name="details" rows="7" required><?php echo isset($editDetails) ? $editDetails : ''; ?></textarea><br>
        <button type="submit" value="<?php echo isset($_GET['edit']) ? $editID : ''; ?>"  name="<?php echo isset($_GET['edit']) ? 'edit-announcements' : 'add-announcements'; ?>">
            <?php echo isset($_GET['edit']) ? 'Edit announcements' : 'Add announcements'; ?>
        </button>
    </form>
    </div>
    </div>
</div>
</body>
</html>