<?php $currentURL = $_SERVER['REQUEST_URI']; ?>
<head>
<style>

.table {
  border-collapse: collapse;
  font-size: 15px;
  min-width: 98%;
  overflow: hidden;
}


.table td {
   padding: 8px 12px;
   overflow: hidden;
   text-overflow: ellipsis; 
   white-space: nowrap;
   text-align: left;
}
.table th{
  border-top: 1px solid grey;
  padding: 12px 12px;
  white-space: nowrap;
  text-align: left;
}


.table tbody tr:last-child {
  border-bottom: 1px solid grey;
}


body {
    font-family: 'Arial', sans-serif;
    background-color:#F1F4F8;
    margin: 0;
    height: 100%;
}

ul.sidebar {
    list-style: none;
    padding: 5px 10px;
    margin: 0;
    background-color: #40556B;
    height: 100%;
    overflow: hidden;
    width: 95%;
    align-content: center;
    justify-content: center;
    align-items: center;   
    position: sticky;
}

ul.sidebar li {
    margin: 0;
    padding: 0;
}
ul.sidebar li:last-child {
    position: absolute;
     bottom: 16px;

}



ul.sidebar li a {
    padding: 15px;
    text-decoration: none;
    color: white;
    display: flex;
    align-items: center;
    transition: 0.3s;
}



ul.sidebar li i {
    margin-right: 10px;
}

ul.sidebar li:last-child a:hover,
ul.sidebar li:last-child a.current {
    background-color: red;
    color: white;
    border-radius: 5px;
}

ul.sidebar li a:hover,
ul.sidebar li.current a {
  background-color: white;
  color: #40556B;
  border-radius: 5px;
}

       body {

            margin: 0;
             font-family: 'Open Sans', sans-serif;
             overflow: hidden;
        }

        
           
        }
         .sidebar {
            width: 13vw;
            background-color: red;
            padding: 0;
            margin: 0;
            position: sticky;
            top: 0;
            height: 98vh; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
        }

        .header {
            height: 8vh; 
            background-color: white;
            margin-left: 10px;
            display: flex;
            align-items: center;
            justify-content: left;
            font-size: 1.2rem;
            padding-left: 15px;
            position: sticky;
            color: #7373c9;
            top: 0;
            box-shadow: 0 2px 4px #888888;
        }

        .header h2 {
            color:#40556B ;
        }

         .main-content {
            flex: 1;
            overflow-y: auto;

        }
        .main-content::-webkit-scrollbar {
            width: 10px;
        }

        .main-content::-webkit-scrollbar-thumb{
            background-color: #7C8D9D;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background-color: #40556B;
        }
        .main-content::-webkit-scrollbar-track {
            background-color:#6f6f70;
        }
        .conversations-list-container::-webkit-scrollbar {
          width: 6px; /* Width of the scrollbar */
        }

        .conversations-list-container::-webkit-scrollbar-thumb {
          background-color: #ccc;
         background-color: #7C8D9D;
        }

        .conversations-list-container::-webkit-scrollbar-thumb:hover {
          background-color: #40556B;
        }
        .conversations-list-container::-webkit-scrollbar-track {
            background-color:#F0F4F6;
        }
        
         .container {
              display: flex;
              height: 100vh;
            }
        .white-container {
            padding: 10px;
            margin: 16px ;
            background-color: white;
            border-radius: 5px ;
            box-shadow: 0 2px 4px #888888;
        }
 .white-container h2 {
            
            margin-left: 16px ;
        }

    .profile-container {
      display: flex;
      align-items: center;
      width: 220px;
      margin: 0 auto;
      position: absolute;
      right: 10px;
}


    .text-container {
      margin-left: 10px;
      display: flex;
      flex-direction: column;
    }

    .heading {
      font-size: 18px;
      font-weight: bold;
      color: gray;
      white-space: nowrap;
    }

    .subheading {
      font-size: 12px;
      color: gray;
      text-transform:capitalize
    }
.logo {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    margin-top: 15px;
}
.logo img {

    margin: 10px 3px; 
    height: 60px;
    width: 60px;
}
.logo p {
  font-size: 23px;
  color: white;
  font-weight: bold;
  font-family: 'Pacifico';
  margin: 0;
  padding: 0;

}

.logo-text {
    display: flex;
    flex-direction: column;
    align-items: start;
    
}

.divider {
    border-top: 2px solid #7C8D9D;
    margin: 2px 9px;
}

.dashboard{}

.dashboard-insights {
    display: flex;
    
}
.dashboard-insights-container{
            flex-grow: 1;
            padding: 20px;
            margin: 8px 15px;
            background-color: white;
            border-radius: 5px ;
            box-shadow: 0 2px 4px #888888;
            max-width: 100%;
            display: flex;
        }
.dash-img-container {
     display: flex;
      align-items: center;
      width: 50px;
      margin: 0 ;
      
}

.pie {
    margin:20px 0px;
  width: 200px;
  height: 200px;
  background-image: conic-gradient(#3399ff var(--percent), #ff66b2 var(--percent) 100%);
  border-radius: 50%
}

.gender-stats {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stat {
  display: flex;
  align-items: center;
}

.dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  margin-right: 10px;
}

.blue {
  background-color: #3399ff;
}

.pink {
  background-color: #ff66b2;
}

.bold  {
  font-weight: bold;
}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
   width: 82vw;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  color: gray;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;

}

input[type=text],input[type=email], input[type=password] {
  padding: 4px 15px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


textarea {
  width: 96%;
  padding: 10px;
  border: 1px solid #ccc;
  outline: none;
  font-size: 16px;
  resize: vertical; /* Allow vertical resizing */
  transition: border-color 0.3s ease-in-out;
}

/* Add focus styles */
textarea:focus {
  border-color: #3498db;
  box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

/* Placeholder text color */
textarea::placeholder {
  color: #95a5a6;
}


.password-container {
            position: relative;
        }

.toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
}
.search-container {
    display: flex;
    align-items: center;
}

.search-container textarea {
    height: 20px;
    width: 80%;
    margin:0px 15px;
}

#column-dropdown {
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 11px 8px;
  margin-right: 5px; 
  font-size: 16px; 
  cursor: pointer;
}

#column-dropdown:hover {
  outline: 1px solid  #40556B; 
}


/* Button styling */
.search-container button {
  background-color:#ff9f68;
  border: none;
  color: #fff; /* White text for contrast */
  padding: 12px 15px; /* Increase padding for better readability */
  font-size: 16px; /* Larger, more readable font */
  cursor: pointer; /* Indicate interactivity */
  transition: all 0.2s ease-in-out; /* Smoother hover effects */
}

 button , input[type="submit"]{
  background-color:#ff9f68;
  border: none;
  color: #fff; 
  padding: 12px 15px; 
  font-size: 16px;
  cursor: pointer; 
  transition: all 0.2s ease-in-out; 
}

table button{
    font-size: 14px;
    padding: 7px 15px;
}
button.red {
   background-color: indianred;
}
button.red:hover {
   background-color: red;
}

/* Hover state */
 button:hover ,input[type="submit"]:hover {
  background-color: #f85959;
}

.search-container button i {
  margin-right: 5px; 
}


.announcement {
  border: 1px solid #ddd; /* Optional border */
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 5px; /* Rounded corners */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow */
}

.announcement-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 5px;
}
.announcement-actions  button  {
 padding: 6px 15px; 
 margin-right: 5px; 
}
.announcement-meta {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  color: #888;
  margin-bottom: 10px;
  
}

.announcement-subject {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
}

.announcement-details {
  font-size: 14px;
  line-height: 1.5;
  margin-bottom: 10px;
  transition: max-height 0.3s ease-in-out;
  overflow: hidden;
}

.announcement-actions {
  display: flex;
  justify-content: flex-end;
}



.read-more-button {
  margin-left: 10px;
  color: #fff;
  border: none;
  padding: 5px 10px;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}



.conversation-container {
   max-height: 87vh;
   padding: 12px;
   margin: 8px 15px;
   background-color: white;
   border-radius: 5px ;
   box-shadow: 0 2px 4px #888888;
   max-width: 100%;
   display: flex;
}
.conversations-list-container {
  overflow-y: auto; 
  width: 295px;
  background-color: white; 
  padding: 5px;
  overflow-x: hidden;
}
.conversation-indi-msg-container {
  height: 82vh;
  width: 100%;
  background-color: #e8eced;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between; 
}
.msg-profile-header{
    height: 7vh; 
    background-color: white;
    width: 100%;
    display: flex;
    justify-content: space-between; 
     box-shadow: 0 2px 4px #888888;
}
.msg-profile-header i{
    margin-top: 18px;
    margin-right: 15px;
     font-size: 24px;

}
 .msg-profile-container {
     margin-right: auto;
     margin-left: 15px;
      display: flex;
      align-items: center;
      width: 220px;
}

.msg-container {
    margin: 8px;
  flex-grow: 1; 
  background-color: #DDE5E9;
  padding: 10px;
}
.msg-send-action-bar{
    height: 5vh; 
    background-color: white;
    width: 100%;
    display: flex;
    justify-content: space-between; 
}


.msg-input {
  margin-right: auto;
  padding: 8px;
  margin-right: 10px;
  border-radius: 5px;

}
.msg-send-action-bar input[type=text] {
  width: 118vh;
  height: 4vh;
  border: none;
  outline: none;
}



.send-button:hover {
  background-color: #45a049;
}


.search-bar input[type=text]{
        width: 100%;
        padding: 8px;
         margin-bottom: 20px;
        outline: none;
}

.user-tile {
  width: 258px;
  display: flex;
  align-items: center;
  padding: 12px 15px;
  cursor: pointer;
   transition: all 0.3s ease-in;

}

.user-tile:hover {
  background-color: #e0e0e0; 
}

.user-tile.active {
  background-color: #F2F2EE;
  border-left: 4px solid #3B556E;
   transition: all 0.3s ease-in; 
}

.user-tile img {
  width: 47px;
  height: 47px;
  border-radius: 50%;
  margin-right: 15px;
}



.user-info h3 {
  font-weight: bold;
  margin:0px;
  font-size: medium;
}

.user-info p {
  color: #888;
  font-size: 0.9rem;
}

.message-container {
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 122vh;
}

.message {
    max-width: 70%;
    padding: 10px;
    border-radius: 10px;
    word-wrap: break-word;
}

.sent {
    background-color: #dcf8c6; /* Light green for sent messages */
    align-self: flex-end;
}

.received {
    background-color: #fff; /* White for received messages */
    align-self: flex-start;
}

.timestamp {
    font-size: 0.8rem;
    color: #888;
    margin-top: 5px;
}

.no-conv-selected {
    display: flex;
    align-items: center;
    margin-top: 193px;
    margin-left: 375px;
    flex-direction: column;
}
  .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico:wght@400;700&display=swap">
</head>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <ul class="sidebar">
        <div class="logo" > <img src="../Resource/Logo_Mascot.png"><div class="logo-text"><p>School Portal</p> <p>Management</p></div></div>
        <div class="divider"></div>
        <br>
          <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/principal-dashboard.php') ? 'current' : ''; ?>"><a href="principal-dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/student-info-management.php') ? 'current' : ''; ?>"><a href="student-info-management.php"><i class="fas fa-user"></i>Student Information</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/teacher-info-management.php') ? 'current' : ''; ?>"><a href="teacher-info-management.php"><i class="fas fa-chalkboard-teacher"></i>Teacher Information</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/staff-management.php') ? 'current' : ''; ?>"><a href="staff-management.php"><i class="fas fa-users"></i>Staff Management</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/announcement.php') ? 'current' : ''; ?>"><a href="announcement.php"><i class="fas fa-bullhorn"></i>Add Announcements</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/view-announcements.php') ? 'current' : ''; ?>"><a href="view-announcements.php"><i class="far fa-eye"></i>View Announcements</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/school_fund_management.php') ? 'current' : ''; ?>"><a href="school_fund_management.php"><i class="fas fa-money-bill-wave"></i>Fund Management</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/communication.php') ? 'current' : ''; ?>"><a href="communication.php"><i class="fas fa-comments"></i>Communication</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/policy-and-rules.php') ? 'current' : ''; ?>"><a href="policy-and-rules.php"><i class="fas fa-file-alt"></i>Add Policies/Rules</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/view-policy_n_rules.php') ? 'current' : ''; ?>"><a href="view-policy_n_rules.php"><i class="far fa-file-alt"></i>View Policies/Rules</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/View/change-pass.php') ? 'current' : ''; ?>"><a href="change-pass.php"><i class="fas fa-key"></i>Change Password</a></li>
        <li class="<?php echo ($currentURL === '/School_Management_Project-Principal/login.php') ? 'current' : ''; ?>"><a href="../Controller/controller_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>

</body>

</html>
<script>
function openTab(evt, Name) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(Name).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>