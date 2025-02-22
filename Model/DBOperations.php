<?php
 include('DBconnection.php');
 


function getTopPerformers($conn) {
    $sql = "SELECT ID, fullname, date_of_birth, gender, address, class_grade, guardian_name, class, phone_number, email FROM users WHERE role='Student' ORDER BY class_grade DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error!");
    }
    $topPerformers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $topPerformers[] = $row;
    }
    return $topPerformers;
}

function getEmployeeOverview($conn,$role) {
    $sql = "SELECT ID, fullname, address, area_of_expertise, salary, joindate, position, room_number, phone_number, email FROM users WHERE role='$role' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error!");
    }
    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
    return $employees;
}


function getDashboardInsights($conn) {
    $num_students = countUsersByRole($conn, 'Student');
    $num_teachers = countUsersByRole($conn, 'Teacher');
    $num_staffs = countUsersByRole($conn, 'Staff');
    $boypercent = calculateBoysPercentage($conn);
    $boycount = calculateMaleStudents($conn);
    $girlcount = calculateFemaleStudents($conn);
    $totalfundamount = getTotalFundAmount($conn);

    return [
        'num_students' => $num_students,
        'num_teachers' => $num_teachers,
        'num_staffs' => $num_staffs,
        'boypercent' => $boypercent,
        'boycount' => $boycount,
        'girlcount' => $girlcount,
        'totalfundamount' => $totalfundamount,
    ];
}

function getUserDetailsById($conn, $ID) {
    $sql = "SELECT * FROM users WHERE ID = '$ID'";
    $result = mysqli_query($conn,$sql);
    if ($result && $result->num_rows > 0) {
        $userDetails = mysqli_fetch_assoc($result);

        return $userDetails;
    } else {
        
        return null;
    }
}

function countUsersByRole($conn, $role) {
    $query = "SELECT * FROM users WHERE role='$role'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    return mysqli_num_rows($result);
}

function calculateMaleStudents($conn) {
    $maleStudentsQuery = "SELECT * FROM users WHERE role='student' AND gender='Male'";
    $resultMaleStudents = mysqli_query($conn, $maleStudentsQuery);

    if (!$resultMaleStudents) {
        die("Error: " . mysqli_error($resultMaleStudents));
    }
    return mysqli_num_rows($resultMaleStudents);  
}

function calculateFemaleStudents($conn) {
    $femaleStudentsQuery = "SELECT * FROM users WHERE role='student' AND gender='Female'";
    $resultFemaleStudents = mysqli_query($conn, $femaleStudentsQuery);
    
    if (!$resultFemaleStudents) {
        die("Error: " . mysqli_error($resultFemaleStudents));
    }
    return mysqli_num_rows($resultFemaleStudents);  
}

function calculateBoysPercentage($conn) {
    $totalStudentsQuery = "SELECT COUNT(*) as total FROM users WHERE role='student'";
    $resultTotalStudents = mysqli_query($conn, $totalStudentsQuery);
    $rowTotalStudents = mysqli_fetch_assoc($resultTotalStudents);
    $totalStudents = $rowTotalStudents['total'];

    $maleStudentsQuery = "SELECT COUNT(*) as males FROM users WHERE role='student' AND gender='Male'";
    $resultMaleStudents = mysqli_query($conn, $maleStudentsQuery);
    $rowMaleStudents = mysqli_fetch_assoc($resultMaleStudents);
    $maleStudents = $rowMaleStudents['males'];

    if ($totalStudents > 0) {
        $boysPercentage = ($maleStudents / $totalStudents) * 100;
        return $boysPercentage;
    } else {
        return 0; 
    }
}

function getTotalFundAmount($conn) {
    $query = "SELECT SUM(amount) as total_amount FROM school_funds";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_amount'];
    } else {
        // Handle the error, for example:
        // echo "Error: " . mysqli_error($conn);
        return false;
    }
}

function getAllStudents($conn) {
    global $conn;
    $sql = "SELECT role, ID, fullname, date_of_birth, gender, address, admit_date, class_grade FROM users WHERE role='Student' ORDER BY ID COLLATE utf32_general_ci";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error!");
    }

    $students = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
    return $students;
}

function getAllTeachers($conn) {
    global $conn;
    $sql = "SELECT role, ID, fullname, gender, area_of_expertise, position, room_number, phone_number, email FROM users WHERE role='Teacher'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error!");
    }

    $teachers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $teachers[] = $row;
    }

    return $teachers;
}

function getAllStaff() {
    global $conn;
    $sql = "SELECT role, ID, fullname, gender, phone_number, email, area_of_expertise, position, room_number FROM users WHERE role='Staff'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error!");
    }

    $staff = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $staff[] = $row;
    }

    return $staff;
}


function getAnnouncements($conn) {
    global $conn;

    $readsql = "SELECT * FROM announcements ORDER BY post_date DESC ";
    return mysqli_query($conn, $readsql);
}

function getRecentFundHistory($conn) {
    $sql = "SELECT * FROM school_funds ORDER BY fund_date LIMIT 5";
    return mysqli_query($conn, $sql);
}

function getAllPolicyAndRules($conn) {
    $sql = "SELECT * FROM policy_rules";
    return mysqli_query($conn, $sql);
}

function changePassword($conn, $oldPassword, $newPassword, $userId) {
    $checkOldPass = "SELECT * FROM users WHERE ID='$userId' AND password='$oldPassword'";
    $result = mysqli_query($conn, $checkOldPass);

    if ($result->num_rows == 1) {
        
            $updatePass = "UPDATE users SET password='$newPassword' WHERE ID='$userId'";
            mysqli_query($conn,$updatePass);
            return true;
        
    }

    return false;
}

function createUserQuery($role ,$id) {
    switch ($role) {
        case 'student':
           return "select role,ID, fullname, date_of_birth, gender, address, admit_date, class_grade, guardian_name, guardian_number, class, phone_number, email from users where role='Student' and ID='$id' ;";
            break;
        case 'Teacher':
             return "select role,ID, fullname, date_of_birth, gender, address, area_of_expertise, salary, joindate, position, room_number, phone_number, email from users where role='Teacher' and ID='$id' ;";
            break;
        case 'Staff':
           return "select role, ID, fullname, date_of_birth, gender, address, area_of_expertise, salary, joindate, position, room_number, phone_number, email  from users where role='Staff' and ID='$id' ;";
            break;
        default:
            echo "Unknown role";
            break;
    }
}
?>