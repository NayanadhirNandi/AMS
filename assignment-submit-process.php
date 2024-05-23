<?php
// Establish a connection to your database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ams";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Get data from the form
// $enrollment_id = $_POST['enrollment_id'];
// $semester = $_POST['sem'];
// $department_id = $_POST['department'];
// $paper_1_id = $_POST['paper1'];
// $paper_1_submit = $_POST['paper1_submit'];
// $paper_2_id = $_POST['paper2'];
// $paper_2_submit = $_POST['paper2_submit'];
// $paper_3_id = $_POST['paper1'];
// $paper_3_submit = $_POST['paper3_submit'];
// // Get other data from the form as needed

// // Check if the enrollment ID exists in student_details table
// $check_query = "SELECT * FROM student_details WHERE enrollment_id = $enrollment_id";
// $result = $conn->query($check_query);

// if ($result->num_rows > 0) {
//     // Enrollment ID exists, proceed with inserting data into student_marks table
//     if($paper_1_submit=='1' && $paper_2_submit=='1' && $paper_3_submit=='1'){

//         echo "Enroll id exists";
//         $insert_query = "INSERT INTO student_department_paper_marks (enrollment_id, semester, department_id, paper_1_id, paper_1_is_submit, paper_2_id, paper_2_is_submit, paper_3_id, paper_3_is_submit) VALUES ('$enrollment_id', '$semester', '$department_id', '$paper_1_id', '$paper_1_submit', '$paper_2_id', '$paper_2_submit', '$paper_3_id', '$paper_3_submit')";
//         // Execute the insert query
//         if ($conn->query($insert_query) === TRUE) {
//             echo "Data inserted successfully!";
//         } else {
//             echo "Error inserting data: " . $conn->error;
//         }
//     }
//     else{
//         // echo "<script>alert('student Have to submit 3 paper together')</script>";
//         header("Location: assignment-submit.php");
//     } 
// }
// else {
//     // Enrollment ID does not exist in student_details table
//     echo "<script>alert('Invalid Enrollment Id')</script>";
//      header("Location: assignment-submit.php");
// }

// // Close the connection
// $conn->close();
?>

<?php

session_start(); // Start the session

// Establish a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ams";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$enrollment_id = $_POST['enrollment_id'];
$semester = $_POST['sem'];
$department_id = $_POST['department'];
$paper_1_id = $_POST['paper1'];
$paper_1_submit = $_POST['paper1_submit'];
$paper_2_id = $_POST['paper2'];
$paper_2_submit = $_POST['paper2_submit'];
$paper_3_id = $_POST['paper3'];
$paper_3_submit = $_POST['paper3_submit'];
$_SESSION['enrollment_id']=$enrollment_id;
// Get other data from the form as needed
if ($department_id=='COSC'){
    $department_name='Computer Science';
}
elseif ($department_id=='MATH'){
    $department_name='Mathematics';
}
elseif ($department_id=='PHYS'){
    $department_name='Physics';
}
elseif ($department_id=='CHEM'){
    $department_name='Chemistry';
}

// Check if the enrollment ID, semster, department_id and match exists in student_details table
$check_query = "SELECT * FROM student_details WHERE enrollment_id = $enrollment_id AND semester='$semester' AND department_id='$department_id'";
$result = $conn->query($check_query);
//check if student already submitted the paper or not
$check_query2 = "SELECT * FROM student_department_paper_marks WHERE enrollment_id = $enrollment_id AND semester='$semester' AND department_id='$department_id'";
$result2 = $conn->query($check_query2);

if ($result->num_rows > 0) {
    // Enrollment ID exists, proceed with inserting data into student_marks table
    if($paper_1_submit=='1' && $paper_2_submit=='1' && $paper_3_submit=='1' && $paper_1_id != $paper_2_id && $paper_1_id != $paper_3_id && $paper_2_id != $paper_3_id ){
        echo "Enroll id exists";
        $insert_query = "INSERT INTO student_department_paper_marks (enrollment_id, semester, department_id, department_name, paper_1_id, paper_1_is_submit, paper_2_id, paper_2_is_submit, paper_3_id, paper_3_is_submit) VALUES ('$enrollment_id', '$semester', '$department_id', '$department_name', '$paper_1_id', '$paper_1_submit', '$paper_2_id', '$paper_2_submit', '$paper_3_id', '$paper_3_submit')";
        // Execute the insert query
        if ($conn->query($insert_query) === TRUE) {
            echo "Data inserted successfully!";
            $_SESSION['alert_message'] = 'Assignment details are submitted successfully';
            header("Location: assignment-submit-confirm.php");
        }
        elseif($result2->num_rows > 0){
            $_SESSION['alert_message'] = 'Duplicate Entry! Student already submitted the papers';
            header("Location: assignment-submit.php");
        }
         else {
            echo "Error inserting data: " . $conn->error;
            $_SESSION['alert_message'] = 'Database Error! Data is not submitted';
            header("Location: assignment-submit.php");
        }
    }
    else{
        // Set the session variable with the alert message
        $_SESSION['alert_message'] = 'Data mismatch in paper ID or Submission status ';
        echo "Error" . $conn->error;
        echo "$paper_1_id<br>";
        echo "$paper_2_id<br>";
        echo "$paper_3_id<br>";
        header("Location: assignment-submit.php");
    } 
}
else {
    // Set the session variable with the alert message
    $_SESSION['alert_message'] = 'Invalid Enrollment ID or Semester or Department Name';
    header("Location: assignment-submit.php");
}

// Close the connection
$conn->close();
?>


