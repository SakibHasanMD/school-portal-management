<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

$userDetails = getUserDetailsById($conn, $_SESSION['ID']);


if (isset($_GET['edit'])) {
    $editID = $_GET['edit'];
    $editQuery = "SELECT * FROM policy_rules WHERE policy_id = '$editID'";
    $editResult = mysqli_query($conn, $editQuery);

    if ($editResult && $editRow = mysqli_fetch_assoc($editResult)) {
        $editTitle = $editRow['pnr_title'];
        $editDetails = $editRow['pnr_details'];


    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Policy/Rules Management</title>

</head>
<body>
    <div class="container">

     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>

    <div class="main-content">

        <div class="header">
            <h2>Manage School Policy/Rules</h2>
            <div class="profile-container">
    <img width="50px" height="50px"  src="../Resource/pp.png">
    <div class="text-container">
      <div class="heading">
          
          <?php
            
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
            <h1>Policy/Rules</h1>
           
        <form method="get" action="../Controller/controller_policy.php">
        <label >Policy/Rules Title:</label><br>
        <input type="text" name="title" value="<?php echo isset($editTitle) ? $editTitle : ''; ?>" required><br>
        <label >Policy/Rules Details:</label><br>
        <textarea name="details" rows="7" required><?php echo isset($editDetails) ? $editDetails : ''; ?></textarea><br>
        <button type="submit" value="<?php echo isset($_GET['edit']) ? $editID : ''; ?>"  name="<?php echo isset($_GET['edit']) ? 'edit-policy-n-rules' : 'add-policy-n-rules'; ?>">
         <?php echo isset($_GET['edit']) ? 'Edit Policy/Rules' : 'Add Policy/Rules'; ?>
        </button>
    </form>
   
    </div>
    </div>
</div>
</body>
</html>