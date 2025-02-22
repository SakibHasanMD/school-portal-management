<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

$userDetails = getUserDetailsById($conn, $_SESSION['ID']);



if (isset($_GET['user-role']) && isset($_GET['view_full_profile'])) {
    $userRole = $_GET['user-role'];
    $viewProfileId = $_GET['view_full_profile'];

    // Call the function with the provided parameters
    $sql = createUserQuery($userRole, $viewProfileId);

    // Now you can use $sql as needed
    // ...
} else {
     header("Location: principal-dashboard.php");
    echo "User role or view full profile ID not provided.";
}

  $res= mysqli_query($conn,$sql);
  $rdata= mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User Details</title>
<style>


.dashboard-insights-container.Teacher,
.dashboard-insights-container.Staff {
  display: none;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 190px;
  height: 290px;
  margin-bottom: 15px;

}

.contract:hover {
    background-color: darkgreen;
    cursor: pointer;
}

.contract i{
    margin: 4px;
    padding: 4px;
    
}
.guardian-card{
  box-shadow: none;
  height: 240px;
}

.profile-section {
    width: 100%;
  padding-left: 20px;
  margin: 0px 20px;
}

.section-title {
  color:  #40556B;
  border-bottom: 2px solid #3498db;
  padding-bottom: 10px;
  margin-bottom: 20px;
  margin-top: 5px;
}

.info-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.info-item.student {
  display: flex;
}
.info-item.Teacher, .info-item.Staff , .info-item.not-student{
  display: none;
}

.info-item i {
  font-size: 20px;
  margin-right: 10px;
  color: #3498db;
  width: 20px;
  height: 20px;
}

span {
  margin-left: 5px;
  width: 220px;
  font-weight: bold;
  color:  #40556B;
}

p {
  margin: 0;
}








/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 8px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 290px;
  font-size: 18px;

  
}

/* The popup chat - hidden by default */
.chat-popup {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 1px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 90%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #F0F4F6;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #F0F4F0;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

</style>
  
</head>
<body>
    <div class="container">
     <div class="sidebar">
        
        <?php include('sidebar.php') ?>
    </div>

   
    <div class="main-content">


        <div class="header">
            <h2>View Profile</h2>

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
       
         
        <div class="dashboard-insights" style="align-items: center;">
    <div class="dashboard-insights-container" style="align-items: center;">
<div class="card">
    <?php
    $gender = strtolower($rdata['gender']);
    $role = strtolower($rdata['role']);
    $imageUrl = '';

    // Define image URLs based on role and gender
    if ($role === 'student') {
        if ($gender === 'male') {
            $imageUrl = 'https://img.freepik.com/premium-vector/cut-boy-reading-book-cartoon-icon-illustration-kid-education-icon-concept-isolated-premium-flat-cartoon-style_138676-1626.jpg';
        } elseif ($gender === 'female') {
            $imageUrl = 'https://img.freepik.com/free-vector/cute-girl-reading-book-cartoon-vector-icon-illustration-people-education-icon-concept-isolated-flat_138676-9155.jpg';
        }
    } elseif ($role === 'teacher') {
        if ($gender === 'male') {
            $imageUrl = 'https://img.freepik.com/free-vector/cute-man-teacher-online-education-cartoon-vector-icon-illustration-people-education-icon-isolated_138676-8413.jpg';
        } elseif ($gender === 'female') {
            $imageUrl = 'https://img.freepik.com/premium-vector/cute-woman-teacher-online-education-cartoon-vector-icon-illustration-people-education-isolated-flat_138676-6343.jpg';
        }
    } elseif ($role === 'staff') {
        if ($gender === 'male') {
            $imageUrl = 'https://img.freepik.com/free-vector/male-cashier-cartoon-icon-illustration-people-profession-icon-concept_138676-2123.jpg';
        } elseif ($gender === 'female') {
            $imageUrl = 'https://img.freepik.com/premium-vector/woman-customer-service-working-laptop-with-headphone-people-technology-concept-isolated-vector-flat-cartoon-style_138676-2028.jpg';
        }
    }
    ?>

    <img src="<?php echo $imageUrl; ?>" alt="Avatar" style="width:190px; height: 190px;">

    <div class="text-container">
        <div class="heading"><?php echo $rdata['fullname']; ?></div> <br>
        <div class="subheading"><?php echo 'ID: ' . $rdata['ID']; ?></div><br>
        
    </div>
    
<button class="open-button contract" onclick="openForm()"><i class="fas fa-comment"></i>Contract</button>

<div class="chat-popup" id="myForm">
  <form action="../Controller/controller_send-msg.php" method="post" class="form-container">
    <h3 class="heading">Contract <?php echo $rdata['fullname']; ?></h3>

    
    <input type="hidden" name="loggedInUserID" value="<?php echo $_SESSION['ID']; ?>">
    <input type="hidden" name="receiverID" value="<?php echo $_GET['view_full_profile']; ?>">

    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>




</div>

  <div class="profile-section">
    <h2 class="section-title">Personal Information</h2>
    <div class="info-item">
      <i class="fa-solid fa-user"></i>
      <span>Name:</span>
      <p><?php echo $rdata['fullname']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-envelope"></i>
      <span>Email:</span>
      <p><?php echo $rdata['email']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-mobile"></i>
      <span>Mobile No.:</span>
      <p><?php echo $rdata['phone_number']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-id-card"></i>
      <span>ID:</span>
      <p><?php echo $rdata['ID']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-venus-mars"></i>
      <span>Gender:</span>
      <p><?php echo $rdata['gender']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-cake"></i>
      <span>Date of Birth:</span>
      <p><?php echo $rdata['date_of_birth']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-map-marker"></i>
      <span>Present Address:</span>
      <p><?php echo $rdata['address']; ?></p>
    </div>
  </div>

 </div>
</div>


    
 <div class="dashboard-insights">
    <div class="dashboard-insights-container">
 <div class="profile-section academics">
    <h2 class="section-title">Academics</h2>
    <div class="info-item <?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-graduation-cap"></i>
      <span>Class:</span>
      <p><?php echo $rdata['class']; ?></p>
    </div>
       <div class="info-item <?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-star"></i>
      <span>CGPA:</span>
      <p><?php echo $rdata['class_grade']; ?></p>
    </div>

    <div class="info-item not-<?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-calendar-check"></i>
      <span>Join Date:</span>
      <p><?php echo $rdata['joindate']; ?></p>
    </div>

    <div class="info-item not-<?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-user-tie"></i>
      <span>Position:</span>
      <p><?php echo $rdata['position']; ?></p>
    </div>

    <div class="info-item not-<?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-lightbulb"></i>
      <span>Area of Expertise:</span>
      <p><?php echo $rdata['area_of_expertise']; ?></p>
    </div>

    <div class="info-item not-<?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-money-bill"></i>
      <span>Salary:</span>
      <p><?php echo $rdata['salary']; ?></p>
    </div>

    <div class="info-item not-<?php echo $rdata['role']; ?>">
      <i class="fa-solid fa-door-open"></i>
      <span>Room:</span>
      <p><?php echo $rdata['room_number']; ?></p>
    </div>
  </div></div>

<div class="dashboard-insights-container  <?php echo $rdata['role']; ?>">

    <div class="card guardian-card" >
  <img src="https://img.freepik.com/free-vector/children-back-school-with-parents_23-2148597326.jpg" alt="Avatar" style="width:190px; height: 190px;">
  <div class="text-container">
    <div class="heading"><?php echo $rdata['guardian_name']; ?></div>  
</div>
</div>

  <div class="profile-section guardians">
    <h2 class="section-title">Guardian Information</h2>
    <div class="info-item">
      <i class="fa-solid fa-user-tie"></i>
      <span>Guardian Name:</span>
      <p><?php echo $rdata['guardian_name']; ?></p>
    </div>
    <div class="info-item">
      <i class="fa-solid fa-mobile"></i>
      <span>Guardian Number:</span>
      <p><?php echo $rdata['guardian_number']; ?></p>
    </div>
  </div>
</div>
</div>



    </div>
    </div>

  
 
 





          </body>
          </html>