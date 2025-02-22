<?php
include('../Model/DBOperations.php');
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

$sql = "select role, ID, fullname, date_of_birth, gender, address, admit_date, class_grade from users where role='Student' ORDER BY ID COLLATE utf32_general_ci";
$totalRows = mysqli_num_rows(mysqli_query($conn, $sql));
$res = mysqli_query($conn, $sql);
$students=getAllStudents($conn);
$userDetails = getUserDetailsById($conn, $_SESSION['ID']);
?>

    
<!DOCTYPE html>
<head>

    <title>All Student Information Management</title>
</head>
<body>
    <div class="container">
     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>
    <div class="main-content">
       <div class="header">
            <h2>All Student Information</h2>
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
            <h3>Student Table</h3>


            <div class="search-container">
    <textarea id="search-input" placeholder="Enter search term..."></textarea>
    <select id="column-dropdown">
        <option value="fullname">Fullname</option>
        <option value="date_of_birth">Date of Birth</option>
        <option value="gender">Gender</option>
        <option value="address">Address</option>
        <option value="admit_date">Admit Date</option>
        <option value="class_grade">Class Grade</option>
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
         <th>Date of Birth</th>
         <th>Date of Admission</th>
         <th>Class Grade</th>
         <th>View Full</th>
       </thead>
    </tr>

<tbody>
    <?php  foreach ($students as $r) { ?> 
    <tr>
          <td><?php echo $r["ID"] ; ?></td>
          <td><?php echo $r["fullname"] ; ?></td>
          <td><?php echo $r["date_of_birth"] ; ?></td>
          <td><?php echo $r["admit_date"] ; ?></td>
            <td><?php echo $r["class_grade"] ; ?></td>
      <td>
        <form method="get" action="view_profile_details.php">
      <input type="hidden" name="user-role" value="<?php echo $r["role"]; ?>">
      <button type="submit" name="view_full_profile" value="<?php echo $r["ID"] ; ?>">View Full</button>
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
    const sqlQuery = `SELECT role, ID, fullname, date_of_birth, gender, address, admit_date, class_grade 
                       FROM users 
                       WHERE role='Student' 
                       AND ${selectedColumn} LIKE '%${searchTerm}%'`;

    // Use AJAX to send the query to the server and fetch results
    $.ajax({
      type: "POST",
      url: "../Controller/controller_fetch-student-search-results.php", 
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





   <div style="text-align: right;margin: 20px 15px;" class="submit-confirm"> <input type="submit" id="load-more"  value="Load More">
<input type="submit" id="load-all" value="Load All"></div>
<script>
var visibleRows = 8; 
var totalRows = <?php echo $totalRows; ?>; 

$(document).ready(function() {
  updateTableVisibility();

  $('#load-more').on('click', function() {
  visibleRows += 5; // Increase the number of visible rows
  updateTableVisibility();

  // Automatically scroll down to show newly loaded rows
 window.location.href = "#load-more";
});

  $('#load-all').on('click', function() {
    visibleRows = totalRows; // Show all rows
    updateTableVisibility();
  });
});

function updateTableVisibility() {
  $('#result-table tbody tr').hide(); // Hide all rows
  $('#result-table tbody tr:lt(' + visibleRows + ')').show(); // Show only the specified number of rows

  // Show/hide "Load More" and "Load All" buttons based on the number of visible rows
  if (visibleRows < totalRows) {
    $('#load-more').show();
    $('#load-all').show();
  } else {
    $('#load-more').hide();
    $('#load-all').hide();
  }
}
</script>


    </div>
    </div>
</div>
</body>
</html>