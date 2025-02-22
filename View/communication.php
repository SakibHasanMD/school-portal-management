<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    echo "You Need To Login First!";
    exit();
}

$loggedUserID=$_SESSION['ID'];

/*if (!isset($_GET['user-role']) ||!isset($_GET['view_full_profile'])) {
    header("Location: principal-dashboard");
    exit();
}*/


// SQL query to fetch conversations for the logged user


$fetchConversationsQuery = "SELECT C.ConversationID, U.fullname AS OtherUserName, C.LastActive,U.ID AS receiverID,
    M.MessageContent AS last_message
    FROM Conversations C
    JOIN Users U ON (C.User1ID = U.ID OR C.User2ID = U.ID)
    LEFT JOIN (
        SELECT ConversationID, MAX(Timestamp) AS MaxTimestamp
        FROM Messages
        GROUP BY ConversationID
    ) MaxMsg ON C.ConversationID = MaxMsg.ConversationID
    LEFT JOIN Messages M ON MaxMsg.ConversationID = M.ConversationID AND MaxMsg.MaxTimestamp = M.Timestamp
    WHERE (C.User1ID = '$loggedUserID' OR C.User2ID = '$loggedUserID')
      AND U.ID <> '$loggedUserID'
    ORDER BY C.LastActive DESC;
";

$fetchConversationsResult = mysqli_query($conn, $fetchConversationsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User Details</title>
  
</head>
<body>
    <div class="container">
     <div class="sidebar">
        
        <?php include('sidebar.php') ?>
    </div>

   
    <div class="main-content">


        <div class="header">
            <h2>Commonications</h2>

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
       
         
    
    <div class="conversation-container">
<div class="conversations-list-container">
  <div class="search-bar">
    <input type="text" placeholder="Search conversations">
</div>
      <?php
      while ($conversation = mysqli_fetch_assoc($fetchConversationsResult)) {
      ?>
        <div class="user-tile" onclick="fetchMessages('<?php echo $conversation['ConversationID']; ?>','<?php echo $conversation['receiverID']; ?>', this)">
          <img src="../Resource/default-user.png" alt="User avatar">
          <div class="user-info">
            <h3 class="heading"><?php echo $conversation['OtherUserName']; ?></h3>
            <div class="subheading"><?php echo $conversation['last_message']; ?></div>
          </div>
        </div>
      <?php
      }
      ?>
   
</div>

<div id="msg-results">
 <div class="no-conv-selected"><img src="../Resource/chat.png" width="400px" height="400px">
  <h4>Select a Conversation to start Messaging !</h4>
</div>
</div>
 </div>





  </div>
</div>

          </body>
          </html>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
 function fetchMessages(conversationID,receiverID, element) {
    $('.user-tile').removeClass('active');
    $(element).addClass('active');
    $.ajax({
    type: "POST",
    url: "../Controller/controller_fetch-conversation-messages.php",
    data: { conversationID: conversationID ,
            receiverID: receiverID}, // Pass the conversationID
    success: function(result) {
        $('#msg-results').html(result);
    },
    error: function(error) {
        console.log("Error:", error);
    }
});

  }
</script>

<?php mysqli_close($conn);
    date_default_timezone_set('Asia/Dhaka');
    function formatLastActive($lastActiveTimestamp) {
    $lastActiveDateTime = new DateTime($lastActiveTimestamp);
    $currentDateTime = new DateTime();
    $interval = $currentDateTime->diff($lastActiveDateTime);

    $formattedTime = '';

    if ($interval->y > 0) {
        $formattedTime = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m > 0) {
        $formattedTime = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d > 0) {
        $formattedTime = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        $formattedTime = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } elseif ($interval->i > 0) {
        $formattedTime = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } else {
        $formattedTime = 'Just now';
    }

    return $formattedTime;
}


    ?>


