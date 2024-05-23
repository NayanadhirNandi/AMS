<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 36px;
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }

        p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .enrollment-number {
            font-size: 48px;
            color: #008000;
            margin-bottom: 30px;
            text-align: center;
        }

        .buttons-container {
            text-align: center;
            margin-top: 30px;
        }

        .exit-button,
        .print-button {
            display: inline-block;
            width: 150px;
            margin: 0 10px;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 20px;
        }

        .exit-button:hover,
        .print-button:hover {
            background-color: #0056b3;
        }
</style>
</head>

<body>

    <div class="container">
        <?php
        // Retrieve the enrollment ID from the URL
        if (isset($_GET['enrollment_id'])) {
            $enrollment_id = $_GET['enrollment_id'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ams_test";

            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die('Connection Failed: ' . mysqli_connect_error());
            }

            // Retrieve student details from the database
            $sql = "SELECT * FROM student_details WHERE enrollment_id = '$enrollment_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $full_name = $row['full_name'];
                $date_of_birth = $row['date_of_birth'];
                $gender = $row['gender'];
                $email = $row['email'];
                $mobile_no = $row['mobile_no'];
                $address =  $row['address'];
                $reg_cen_code = $row['reg_cen_code'];
                $study_centre = $row['study_centre'];
                $date_admission = $row['date_admission'];
                $programme = $row['programme'];
                $subjects = $row['s_subject'];
                // Add more details here as needed
            }

            // Display student details and enrollment number
            echo "<h2>Registration Confirmation</h2>";
            echo "<p><strong>Full Name:</strong> $full_name</p>";
            echo "<p><strong>Date of Birth:</strong> $date_of_birth</p>";
            echo "<p><strong>Gender:</strong> $gender</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Mobile Number:</strong> $mobile_no</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Regional Centre Code:</strong> $reg_cen_code</p>";
            echo "<p><strong>Study Centre:</strong> $study_centre</p>";
            echo "<p><strong>Date of Admission:</strong> $date_admission</p>";
            echo "<p><strong>Programme:</strong> $programme</p>";
            echo "<p><strong>Subject:</strong> $subjects</p>";


            // Add more details here as needed

            // Display the enrollment number with big size and green color
            echo "<p class='enrollment-number'><b>Your Enrollment Number: <br><span>$enrollment_id</span></p></b>";

            // Close the database connection
            mysqli_close($conn);
        } else {
            // Handle case where enrollment ID is not found in the URL
            echo "<p>Error: Enrollment ID not found.</p>";
        }
        ?>
        <div class="buttons-container">
            <a href="user-add-student.php" class="print-button" onclick="window.print();">Print</a>
            <a href="user-add-student" class="exit-button" onclick="window.close();history.back();">Exit</a>
        </div>
    </div>
</body>

</html>