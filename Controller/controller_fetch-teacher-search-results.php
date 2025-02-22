<?php
include('../Model/DBConnection.php');

if (isset($_POST['query'])) {
    $sqlQuery = $_POST['query'];
    $result = mysqli_query($conn, $sqlQuery);
    if(!$result)
        { 
        $errorMessage = "Error executing query: " . mysqli_error($conn);
        echo "<p>An error occurred while processing your request. Please try again later.</p>";
    }
    
    // Process the results and generate HTML
   $html = "
   <br><center>
    <table align='center' class='table'>

    <tr><thead>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Subject</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Teachers Room</th>
                    <th>Details</th></thead>
                </tr><tbody>";

while($row= mysqli_fetch_assoc($result)){
    $html .= "<tr>";
    $html .= "<td>" . $row['ID'] . "</td>";
    $html .= "<td>" . $row['fullname'] . "</td>";
    $html .= "<td>" . $row['gender'] . "</td>";
    $html .= "<td>" . $row['area_of_expertise'] . "</td>";
    $html .= "<td>" . $row['phone_number'] . "</td>";
    $html .= "<td>" . $row['email'] . "</td>";
    $html .= "<td>" . $row['position'] . "</td>";
    $html .= "<td>" . $row['room_number'] . "</td>";
    
    $html .= " <td>
                            <form method='get' action='view_profile_details.php'>
                                <input type='hidden' name='user-role' value='" . $row['role'] . "'>
                                <button type='submit' name='view_full_profile' value='" . $row['ID'] . "'>View Full</button>
                            </form>
                        </td></tbody";
    $html .= "</tr>";
}

$html .= "</tbody>
    </table>
</center>";

 echo $html;
}
?>