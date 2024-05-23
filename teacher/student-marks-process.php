<?php

session_start(); // Start the session

//Establish a connection to  database

require "../connect.php";

// Get data from the form
$enrollment_id = $_POST['enrollment_id'];
$semester = $_POST['sem'];
$department_id = $_POST['department'];
$paper_id = $_POST['paper'];
$paper_marks=$_POST['paper_marks'];
$_SESSION['enrollment_id']=$enrollment_id;
// Get other data from the form as needed


// Check if the enrollment ID, semster, department_id and match exists in student_details table
$check_query = "SELECT * FROM student_department_paper_marks WHERE enrollment_id = $enrollment_id AND semester='$semester' AND department_id='$department_id' AND (paper_1_id='$paper_id' OR paper_2_id='$paper_id' OR paper_3_id='$paper_id') ";
$result = $conn->query($check_query);

if ($result->num_rows > 0) {
    // Enrollment ID exists, proceed with inserting data into student_marks table
    echo "Student submitted his copy";
    while($row = $result->fetch_assoc()){
        $paper_1_id=$row['paper_1_id'];
        $paper_2_id=$row['paper_2_id'];
        $paper_3_id=$row['paper_3_id'];
    }
    // echo "$paper_1_id <br>";
    // echo "$paper_2_id <br>";
    // echo "$paper_3_id <br>";
    if($paper_1_id == $paper_id){
        // echo "$paper_id";
        $sql = "UPDATE student_department_paper_marks
                SET paper_1_marks = '$paper_marks' 
                WHERE enrollment_id = '$enrollment_id' 
                AND paper_1_id = '$paper_id' AND semester='$semester' AND department_id='$department_id'";

        if ($conn->query($sql) === TRUE) {
            echo "$paper_id marks updated successfully.";
            $_SESSION['alert_message'] = 'Marks Updated successfully';
            header("Location: student-marks.php");
        } else {
            echo "Error updating $paper_id record: " . $conn->error;
            $_SESSION['alert_message'] = 'Database Failure! Marks are not updated';
           header("Location: student-marks.php");
        }
    }
    elseif($paper_2_id == $paper_id){
        // echo "$paper_id";
        $sql = "UPDATE student_department_paper_marks 
                SET paper_2_marks = '$paper_marks' 
                WHERE enrollment_id = '$enrollment_id' 
                AND paper_2_id = '$paper_id' AND semester='$semester' AND department_id='$department_id'";

        if ($conn->query($sql) === TRUE) {
            echo "$paper_id marks updated successfully.";
            $_SESSION['alert_message'] = 'Marks Updated successfully';
           header("Location: student-marks.php");
        } else {
            echo "Error updating $paper_id record: " . $conn->error;
            $_SESSION['alert_message'] = 'Database Failure! Marks are not updated';
            header("Location: student-marks.php");
        }
    }
    elseif($paper_3_id == $paper_id){
        // echo "$paper_id";
        $sql = "UPDATE student_department_paper_marks 
                SET paper_3_marks = '$paper_marks' 
                WHERE enrollment_id = '$enrollment_id' 
                AND paper_3_id = '$paper_id' AND semester='$semester' AND department_id='$department_id'";

        if ($conn->query($sql) === TRUE) {
            echo "$paper_id marks updated successfully.";
            $_SESSION['alert_message'] = 'Marks Updated successfully';
            header("Location: student-marks.php");

        } else {
            echo "Error updating $paper_id record: " . $conn->error;
            $_SESSION['alert_message'] = 'Database Failure! Marks are not updated';
            header("Location: student-marks.php");

        }
    }
    else{
        echo "Invalid paper ID";
        $_SESSION['alert_message'] = 'Invalid Paper ID';
        header("Location: student-marks.php");
    }
    
}
else {
    // Set the session variable with the alert message
    $_SESSION['alert_message'] = 'Invalid Enrollment ID or Semester or Department Name or Paper ID';
    //header("Location: student-marks.php");
    echo "Invalid Enrollment id";
}

// Close the connection
$conn->close();
?>