<?php
 include('../Model/DBOperations.php');

session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

	$sql="select role,ID, fullname, gender, area_of_expertise, position, room_number, phone_number, email from users where role='Teacher'";
    $totalRows = mysqli_num_rows(mysqli_query($conn, $sql));
	$res= mysqli_query($conn,$sql);
    $teachers=getAllTeachers($conn);
	
    ?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>

</head>

<body>
    <div class="container">
     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>
    <div class="main-content"><div class="header">
            <h2>All Teachers Information Management</h2>
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
            <h3>Teachers Table</h3>


<div class="search-container">
    <textarea id="search-input" placeholder="Enter search term..."></textarea>
    <select id="column-dropdown">
        <option value="fullname">Fullname</option>
        <option value="gender">Gender</option>
        <option value="area_of_expertise">Subject</option>
        <option value="phone_number">Phone</option>
        <option value="email">Email</option>
        <option value="position">Position</option>
        <option value="room_number">Room</option>
    </select>
    <button onclick="searchStudents()"><i class="fas fa-search"></i> Search</button>
</div>

<div id="search-results">


<br>
            <center>
        <table align="center" class="table" id="result-table">
       
    <tr> <thead>
         <th>ID</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Subject</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Teachers Room</th>
                    <th>Details</th></thead>
       </thead>
    </tr>

<tbody>
    <?php  foreach ($teachers as $r) { ?> 
    <tr>
            <td><?php echo $r['ID']; ?></td>
                        <td><?php echo $r['fullname']; ?></td>
                        <td><?php echo $r['gender']; ?></td>
                        <td><?php echo $r['area_of_expertise']; ?></td>
                        <td><?php echo $r['phone_number']; ?></td>
                        <td><?php echo $r['email']; ?></td>
                        <td><?php echo $r['position']; ?></td>
                        <td><?php echo $r['room_number']; ?></td>
       <td>
                            <form method='get' action='view_profile_details.php'>
                                <input type='hidden' name='user-role' value='<?php echo $r['role']; ?>'>
                                <button type='submit' name='view_full_profile' value='<?php echo $r['ID']; ?>'>View Full</button>
                            </form>
                        </td>

    </tr>
  <?php } ?>
</tbody>
</table>
    </center>


</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function searchStudents() {
    const searchTerm = $('#search-input').val();
    const selectedColumn = $('#column-dropdown').val();
    const sqlQuery = `SELECT role,ID, fullname, gender, area_of_expertise, position, room_number, phone_number, email 
                       FROM users 
                       WHERE role='Teacher' 
                       AND ${selectedColumn} LIKE '%${searchTerm}%'`;

    // Use AJAX to send the query to the server and fetch results
    $.ajax({
      type: "POST",
      url: "../Controller/controller_fetch-teacher-search-results.php", 
      data: { query: sqlQuery },
      success: function(result) {
        // Update the search results container with the fetched results
        $('#search-results').html(result);
      },
      error: function(error) {
        console.log("Error:", error);
      }
    });
  }
</script>


    </div>
    </div>
</div>
</body>
</html>
