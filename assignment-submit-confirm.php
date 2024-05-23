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
            session_start(); // Start the session

            // Check if the session variable is set and not empty
            if (!isset($_SESSION['enrollment_id'])) {
                echo "Error: Enrollment ID not found in session.";
                exit;
            }

            $enrollment_id = $_SESSION['enrollment_id'];

            // Establish a connection to your database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ams";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                echo "<script>alert('Connection Failure!')</script>";

            }

            // Retrieve data from the student_department_paper_marks table based on the enrollment ID
            $select_query = "SELECT * FROM student_department_paper_marks WHERE enrollment_id = $enrollment_id";
            $result = $conn->query($select_query);

            if ($result->num_rows > 0) {
                // Output the data in a formatted way
                echo "<h2>Assignment Submission Confirmation</h2>";
                

                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>Enrollment ID: </strong>{$row['enrollment_id']}</p>";
                    echo "<p><strong>Semester: </strong>{$row['semester']}</p>";
                    echo "<p><strong>Department ID: </strong>{$row['department_id']}</p>";
                    echo "<p><strong>Department Name: </strong>{$row['department_name']}</p>";
                    echo "<p><strong>First Paper: </strong>{$row['paper_1_id']}</td>";
                    echo "<p><strong>First paper Submission Status: </strong>Submitted</p>";
                    echo "<p><strong>Second Paper: </strong>{$row['paper_2_id']}</p>";
                    echo "<p><strong>Second paper Submission Status: </strong>Submitted</p>";
                    echo "<p><strong>Third Paper: </strong>{$row['paper_3_id']}</p>";
                    echo "<p><strong>Third Paper Submission Status:</strong> Submitted</p>";
                    echo "<p><strong>Submission Date And Time: </strong>{$row['submit_date']}</p>";
                }

                
            } else {
                echo "<script>alert('No data found.')</script>";
            }

            // Close the connection
            $conn->close();
            ?>

        <div class="buttons-container">
            <a href="#" class="print-button" onclick="window.print();">Print</a>
            <a href="assignment-submit.php" class="exit-button" onclick="window.close();history.back();">Exit</a>
        </div>
    </div>
</body>

</html>

