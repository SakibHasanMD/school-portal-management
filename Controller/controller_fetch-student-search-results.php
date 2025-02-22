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
    <table align='center' class='table' id='result-table'>
                    <tr><thead>
                <th>ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Date of Admission</th>
                <th>Class Grade</th>
                <th>View Full</th></thead>
            </tr>
        
        <tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>";
    $html .= "<td>" . $row['ID'] . "</td>";
    $html .= "<td>" . $row['fullname'] . "</td>";
    $html .= "<td>" . $row['date_of_birth'] . "</td>";
    $html .= "<td>" . $row['admit_date'] . "</td>";
    $html .= "<td>" . $row['class_grade'] . "</td>";
    $html .= "<td>
        <form method='get' action='view_profile_details.php'>
            <input type='hidden' name='user-role' value='" . $row['role'] . "'>
            <button type='submit' name='view_full_profile' value='" . $row['ID'] . "'>View Full</button>
        </form>
    </td>";
    $html .= "</tr>";
}

$html .= "</tbody>
    </table>
</center>";

 echo $html;
}
?>