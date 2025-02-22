<?php

include('../Model/DBOperations.php');

$loggedInUserID= $senderID = $_POST['loggedInUserID'];
$receiverID = $_POST['receiverID'];
$messageContent = $_POST['msg'];

function orderUserIDs($user1ID, $user2ID) {
    $priority = array("Principal" => 4, "Teacher" => 3, "Staff" => 2, "Student" => 1);

    // Function to get the priority of a user role
    function getRolePriority($userID, $priority) {
        $role = explode('-', $userID)[0];
        return isset($priority[$role]) ? $priority[$role] : 0;
    }

    $priority1 = getRolePriority($user1ID, $priority);
    $priority2 = getRolePriority($user2ID, $priority);


    if ($priority1 !== $priority2) {
        return $priority1 > $priority2 ? [$user1ID, $user2ID] : [$user2ID, $user1ID];
    } else {
        // If roles are the same, use numeric part for ordering
        $num1 = (int)explode('-', $user1ID)[1];
        $num2 = (int)explode('-', $user2ID)[1];

        return $num1 < $num2 ? [$user1ID, $user2ID] : [$user2ID, $user1ID];
    }
}


[$orderedUser1ID, $orderedUser2ID] = orderUserIDs($loggedInUserID, $receiverID);







$checkConversationQuery = "SELECT ConversationID FROM Conversations
                           WHERE (User1ID = '$orderedUser1ID' AND User2ID = '$orderedUser2ID')";
$checkConversationResult = mysqli_query($conn, $checkConversationQuery);

if (mysqli_num_rows($checkConversationResult) > 0) {
    // Conversation already exists
    $conversationData = mysqli_fetch_assoc($checkConversationResult);
    $conversationID = $conversationData['ConversationID'];

    echo $conversationID . "ALREADY EXIST";



     $insertMessageQuery = "INSERT INTO Messages (ConversationID, SenderID, ReceiverID, MessageContent) VALUES ('$conversationID', '$senderID', '$receiverID', '$messageContent')";

     $insertMessageResult = mysqli_query($conn, $insertMessageQuery);  

    if ($insertMessageResult) {
    // Update the timestamp in the Conversations Table
    $updateTimestampQuery = "UPDATE Conversations SET LastActive = CURRENT_TIMESTAMP WHERE ConversationID = '$conversationID'";
    $updateTimestampResult = mysqli_query($conn, $updateTimestampQuery);

    if ($updateTimestampResult) {
        echo "Message sent successfully! Timestamp updated";
    } 
    else {
        echo "Error updating timestamp: " . mysqli_error($conn);
    }

    } 



} 





else {
    // Conversation doesn't exist
    $createConversationQuery = "INSERT INTO Conversations (User1ID, User2ID, LastActive)
                               VALUES ('$orderedUser1ID', '$orderedUser2ID', CURRENT_TIMESTAMP)";
    $createConversationResult = mysqli_query($conn, $createConversationQuery);

    if ($createConversationResult) {
        // Retrieve the ConversationID 
        $conversationID = mysqli_insert_id($conn);
        echo $conversationID . "NEW INSERTED SUCCESSFULLY";


        // Insert the message 
        $insertMessageQuery = "INSERT INTO Messages (ConversationID, SenderID, ReceiverID, MessageContent) VALUES ('$conversationID', '$senderID', '$receiverID', '$messageContent')";

        $insertMessageResult = mysqli_query($conn, $insertMessageQuery);  

    if ($insertMessageResult) {
    // Update the timestamp in the Conversations Table
    $updateTimestampQuery = "UPDATE Conversations SET LastActive = CURRENT_TIMESTAMP WHERE ConversationID = '$conversationID'";
    $updateTimestampResult = mysqli_query($conn, $updateTimestampQuery);

    if ($updateTimestampResult) {
        echo "Message sent successfully! Timestamp updated";
    } 
    else {
        echo "Error updating timestamp: " . mysqli_error($conn);
    }

    } 

     else {
            echo "Error inserting message: " . mysqli_error($conn);
        }

    } 
    else {
        // Handle error if the conversation creation fails
        echo "Error creating conversation: " . mysqli_error($conn);
        exit();  // You may want to handle this differently based on your application's logic
    }
}

// Now you have the $conversationID, and you can proceed with inserting the message into the Messages table
// ...

// Close the database connection
mysqli_close($conn);
header("Location: ../View/communication.php");

?>
