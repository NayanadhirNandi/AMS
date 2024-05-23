<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ams_test";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die('Connection Failed: ' . mysqli_connect_error());
}

$aadhar_no = $_POST['aadhar_no'];

$sql = "SELECT * FROM student_details WHERE aadhar_no = '$aadhar_no'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<p style="color: #ff5733; font-size: 20px; font-weight: bold; text-align: center;font-family: verdana ; border: 2px solid #ff5733; padding: 10px;">Record Already Present in The Database!</p>';
} else {
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $mobile_no  = $_POST['mobile_no'];
    $gender  = $_POST['gender'];
    $address = $_POST['address'];
    $reg_cen_code = $_POST['reg_cen_code'];
    $study_centre = $_POST['study_centre'];
    $date_admission = $_POST['date_admission'];
    $programme = $_POST['programme'];
    $subject = $_POST['subject'];


    // Generate enrollment ID
    $sql_last_id = "SELECT enrollment_id FROM student_details ORDER BY enrollment_id DESC LIMIT 1";
    $result_last_id = mysqli_query($conn, $sql_last_id);

    if (mysqli_num_rows($result_last_id) > 0) {
        $row = mysqli_fetch_assoc($result_last_id);
        $last_enrollment_id = $row['enrollment_id'];
        $enrollment_id = $last_enrollment_id + 1; // Increment the last ID
    } 
    else {
        // If there are no existing IDs, start from 1000000001
        $enrollment_id = 1000000001;
    }
    $sql_insert = "INSERT INTO student_details (enrollment_id, full_name, date_of_birth, email, mobile_no, gender, address, aadhar_no, reg_cen_code, study_centre, date_admission, programme, subject) VALUES ('$enrollment_id', '$full_name', '$date_of_birth', '$email', '$mobile_no', '$gender', '$address', '$aadhar_no','$reg_cen_code', '$study_centre', '$date_admission', '$programme', '$subject')";

    if (mysqli_query($conn, $sql_insert)) {
        // directed to the cormifation page
        header("Location: stureg_confirm.php?enrollment_id=$enrollment_id");
    } else {
        echo "<script>
        alert('Data base error! Please check your data before input.')</script>";
        echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        
    }
}
mysqli_close($conn);
?>
