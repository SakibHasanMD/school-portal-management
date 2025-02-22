<?php
include('../Model/DBOperations.php');
session_start();  


if (!isset($_SESSION['ID'])) {

    exit();
        header("Location: login.php");
    echo "You Need To Login First!";
}

$loggedUserID=$_SESSION['ID'];
$receiverID=$_POST['receiverID'];
$userDetails = getUserDetailsById($conn, $receiverID);

$imageUrl = generateProfileImageUrl($userDetails['gender'], $userDetails['role']);

if (isset($_POST['conversationID'])) {
    $conversationID = $_POST['conversationID'];

   
    $fetchMessagesQuery = "
        SELECT M.SenderID, M.ReceiverID, M.MessageContent, M.Timestamp, U.fullname
        FROM Messages M
        JOIN Users U ON (M.SenderID = U.ID)
        WHERE M.ConversationID = '$conversationID'
        ORDER BY M.Timestamp ASC";

    $fetchMessagesResult = mysqli_query($conn, $fetchMessagesQuery);

    if (!$fetchMessagesResult) {
        $errorMessage = "Error executing query: " . mysqli_error($conn);
        echo "<p>An error occurred while processing your request. Please try again later.</p>";
    }

    // Process the results and generate HTML for messages
    $html = "<div class='conversation-indi-msg-container'>";

// Header
$html .= "<div class='msg-profile-header'>";
$html .= "<div class='msg-profile-container'>";
$html .= "<img width='50px' height='50px' src='$imageUrl'>";
$html .= "<div class='text-container'>";
$html .= "<div class='heading'>";
$html .= $userDetails['fullname'];
$html .= "</div>";
$html .= "<div class='subheading'>" . $userDetails['role'] . "</div>";
$html .= "</div>";
$html .= "</div>";
$html .= "<i class='fas fa-bars'></i>";
$html .= "</div>";


// Messages
$html .= "<div class='message-container'>";

while ($message = mysqli_fetch_assoc($fetchMessagesResult)) {
    $messageClass = ($message['SenderID'] == $_SESSION['ID']) ? 'sent' : 'received';

    $html .= "<div class='message $messageClass'>";
    $html .= "<div class='message-content'>";
    $html .= $message['MessageContent'];
    $html .= "</div>";
    $html .= "<div class='timestamp'>";
    $html .= formatLastActive($message['Timestamp']);
    $html .= "</div>";
    $html .= "</div>";
}

$html .= "</div>"; // Closing msg-container

$html .= "</div>"; // Closing conversation-indi-msg-container

    $html .= "
                <div class='msg-send-action-bar'>
     <form action='../Controller/controller_send-msg.php' method='post'>
    <input type='text' placeholder='Type your message...' class='msg-input' name='msg'>
    <input type='hidden' name='loggedInUserID' value='$loggedUserID'>
    <input type='hidden' name='receiverID' value='$receiverID'>
  <input type='submit' class='send-button' value='Send'>
</form>

  </div></div>";


    echo $html;
} 



else {
    echo "Conversation ID not provided.";
}


 mysqli_close($conn);
    date_default_timezone_set('Asia/Dhaka');
    function formatLastActive($lastActiveTimestamp) {
       $lastActiveDateTime = new DateTime($lastActiveTimestamp, new DateTimeZone('Asia/Dhaka'));
    $currentDateTime = new DateTime(null, new DateTimeZone('Asia/Dhaka'));
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





function generateProfileImageUrl($gender, $role) {
    $gender = strtolower($gender);
    $role = strtolower($role);
    $imageUrl = '';

    if ($role === 'student') {
        $imageUrl = ($gender === 'male') ? 'https://img.freepik.com/premium-vector/cut-boy-reading-book-cartoon-icon-illustration-kid-education-icon-concept-isolated-premium-flat-cartoon-style_138676-1626.jpg' :
                                            'https://img.freepik.com/free-vector/cute-girl-reading-book-cartoon-vector-icon-illustration-people-education-icon-concept-isolated-flat_138676-9155.jpg';
    } elseif ($role === 'teacher') {
        $imageUrl = ($gender === 'male') ? 'https://img.freepik.com/free-vector/cute-man-teacher-online-education-cartoon-vector-icon-illustration-people-education-icon-isolated_138676-8413.jpg' :
                                            'https://img.freepik.com/premium-vector/cute-woman-teacher-online-education-cartoon-vector-icon-illustration-people-education-isolated-flat_138676-6343.jpg';
    } elseif ($role === 'staff') {
        $imageUrl = ($gender === 'male') ? 'https://img.freepik.com/free-vector/male-cashier-cartoon-icon-illustration-people-profession-icon-concept_138676-2123.jpg' :
                                           'https://img.freepik.com/premium-vector/woman-customer-service-working-laptop-with-headphone-people-technology-concept-isolated-vector-flat-cartoon-style_138676-2028.jpg';
    }

    return $imageUrl;
}




?>
