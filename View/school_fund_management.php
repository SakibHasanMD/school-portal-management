<?php

session_start();  
include('../Model/DBOperations.php');


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

	$recentfund=getRecentFundHistory($conn);
    $totalfundamount=getTotalFundAmount($conn);
    $userDetails = getUserDetailsById($conn, $_SESSION['ID']);
    ?>

<!DOCTYPE html>
<head>
  
    <title>School Fund Management</title>
</head>
<body>

    <body>
    <div class="container">
     <div class="sidebar">
        <?php include('sidebar.php') ?>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Fund Management</h2>


 

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
  </div></div></div>


        <!-- Table Section -->
        
<div class="dashboard-insights-container"><div class="dash-img-container"><img width="50px" height="50px"  src="../Resource/fund.png"></div>
    <div class="text-container">
      <div class="subheading">Fund Balance</div>
      <div class="heading"><?php echo $totalfundamount. " ৳"?></div>
  </div>
  </div>


 <div class="dashboard-insights">

<div class="dashboard-insights-container">
    <div class="text-container">
     
    <h3>Recent Fund History</h3>

<table class="table" width="95%">
    
    <tr><thead>
       <th>Fund ID</th>
       <th>Fund Name</th>
       <th>Amount</th>
     <th>Fund Date</th>
     <th>Funded By</th>
     <th>Created By</th>
     <th>Created At </th>
  
      </thead>
    </tr>
    
    <?php foreach ($recentfund as $r ) { ?>
    <tr>
        <td><?php echo $r["fund_id"] ; ?></td>
      <td><?php echo $r["fund_name"] ; ?></td>
        <td><?php echo $r["amount"] ; ?></td>
      <td><?php echo $r["fund_date"] ; ?></td>
      <td><?php echo $r["funded_by"] ; ?></td>
      <td><?php echo $r["created_by"] ; ?></td>
      <td><?php echo $r["created_at"] ; ?></td>
    
    </tr>
  <?php } ?>

</table>

  </div>
  </div>

     <div class="dashboard-insights-container">

  </div>


</div>


    </div>


    </div>
</div>
</body>
</html>







