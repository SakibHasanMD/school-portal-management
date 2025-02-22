<?php


include('../Model/DBOperations.php');

session_start();  
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}
$topPerformers = getTopPerformers($conn);
$teachersOverview = getEmployeeOverview($conn,'Teacher');
$staffsOverview = getEmployeeOverview($conn,'Staff');
$userDetails = getUserDetailsById($conn,$_SESSION['ID']);
$dashboardInsights = getDashboardInsights($conn);

?>

<!DOCTYPE html>
<head>
  
    <title>Principal Dashboard</title>
</head>
<body>

    <body>
    <div class="container">
     <div class="sidebar">
        <?php include('../View/sidebar.php') ?>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Dashboard</h2>


 

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
  </div></div></div>


        <!-- Table Section -->
        <div class="dashboard-insights"><div class="dashboard-insights-container"><div class="dash-img-container"><img width="50px" height="50px"  src="../Resource/student.png"></div>
    <div class="text-container">
      <div class="subheading">Students</div>
      <div class="heading"><?php echo $dashboardInsights['num_students']; ?></div>
  </div>
  </div>

<div class="dashboard-insights-container"><div class="dash-img-container"><img width="50px" height="50px"  src="../Resource/teacher.png"></div>
    <div class="text-container">
      <div class="subheading">Teachers</div>
      <div class="heading"><?php echo $dashboardInsights['num_teachers']; ?></div>
  </div>
  </div>

<div class="dashboard-insights-container"><div class="dash-img-container"><img width="50px" height="50px"  src="../Resource/staff.png"></div>
    <div class="text-container">
      <div class="subheading">Staffs</div>
      <div class="heading"><?php echo $dashboardInsights['num_staffs']; ?></div>
  </div>
  </div>

<div class="dashboard-insights-container"><div class="dash-img-container"><img width="50px" height="50px"  src="../Resource/fund.png"></div>
    <div class="text-container">
      <div class="subheading">Fund Balance</div>
      <div class="heading"><?php echo $dashboardInsights['totalfundamount']. " ৳"?></div>
  </div>
  </div>
</div>

 <div class="dashboard-insights">

<div class="dashboard-insights-container">
    <div class="text-container">
     
    <h3>Top Performers</h3>

<table class="table" width="95%">
    
    <tr><thead>
       <th>ID</th>
       <th>Full Name</th>
       <th>Date of Birth</th>
     <th>Class Grade</th>
     <th>Guardian Name</th>
     <th>Class</th>
     <th>Phone Number</th>
     <th>Email</th>
      </thead>
    </tr>
    
    <?php  foreach ($topPerformers as $r) { ?>
    <tr>
        <td><?php echo $r["ID"] ; ?></td>
      <td><?php echo $r["fullname"] ; ?></td>
        <td><?php echo $r["date_of_birth"] ; ?></td>
      <td><?php echo $r["class_grade"] ; ?></td>
      <td><?php echo $r["guardian_name"] ; ?></td>
      <td><?php echo $r["class"] ; ?></td>
      <td><?php echo $r["phone_number"] ; ?></td>
      <td><?php echo $r["email"] ; ?></td>

    </tr>
  <?php } ?>

</table>

  </div>
  </div>

     <div class="dashboard-insights-container">
     <div class="text-container">
<div class="heading">Students</div>
 <div class="pie" style="--percent: <?php echo $dashboardInsights['boypercent'].'%' ?>;"></div>

 <div class="gender-stats">
  <div class="stat">
    <span class="dot blue"></span>
    <span class="subheading bold">Boys: <?php echo $dashboardInsights['boycount']; ?></span>
  </div>
  <div class="stat">
    <span class="dot pink"></span>
    <span class="subheading bold">Girls: <?php echo $dashboardInsights['girlcount']; ?></span>
  </div>
</div>

</div>
  </div>


</div>


    <div class="dashboard-insights"><div class="dashboard-insights-container">
        <div class="text-container">
            
             <h3>Employee Overview</h3>
            <!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'teachers')">Teachers</button>
  <button class="tablinks" onclick="openTab(event, 'staffs')">Staffs</button>
</div>

<!-- Tab content -->
<div id="teachers" class="tabcontent" style="display: block;">
  

<table class="table">
    <tr><tbody>
      <th>ID</th>
      <th>Full Name</th>
      <th>Address</th>
      <th>Subject</th>
      <th>Salary</th>
      <th>Join Date</th>
      <th>Position</th>
      <th>Teachers Room</th>
       <th>Phone Number</th>
      <th>Email</th>
      </tbody>
    </tr>
    <?php  foreach ($teachersOverview as $r) { ?>
    <tr>
      <td><?php echo $r["ID"] ; ?></td>
      <td><?php echo $r["fullname"] ; ?></td>
      <td><?php echo $r["address"] ; ?></td>
  <td><?php echo $r["area_of_expertise"] ; ?></td>
  <td><?php echo $r["salary"] ; ?></td>
  <td><?php echo $r["joindate"] ; ?></td>
  <td><?php echo $r["position"] ; ?></td>
  <td><?php echo $r["room_number"] ; ?></td>
  <td><?php echo $r["phone_number"] ; ?></td>
  <td><?php echo $r["email"] ; ?></td>
    </tr>
  <?php } ?>
</table>

</div>

<div id="staffs" class="tabcontent">
 

<table class="table">
    <tr><tbody>
      <th>ID</th>
      <th>Full Name</th>
      <th>Phone Number</th>
      <th>Email</th>
      <th>Department</th>
      <th>Position</th>
      <th>Office Number</th>
      </tbody>
    </tr>

    <?php  foreach ($staffsOverview as $r) { ?>
    <tr>

      <td><?php echo $r["ID"] ; ?></td>
      <td><?php echo $r["fullname"] ; ?></td>
      <td><?php echo $r["phone_number"] ; ?></td>
  <td><?php echo $r["email"] ; ?></td>
  <td><?php echo $r["area_of_expertise"] ; ?></td>
  <td><?php echo $r["position"] ; ?></td>
  <td><?php echo $r["room_number"] ; ?></td>
    </tr>
  <?php } ?>
</table>

</div>



        </div>
    </div></div>


    </div>
</div>
</body>
</html>







