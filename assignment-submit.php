<?php
require "connect.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
?>

<?php
//Fetch user details from database
$username = $_SESSION['username'];
$sql = "SELECT name FROM user_details WHERE email = '$username'";
$result = mysqli_query($conn, $sql);

// Check if user details are found
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error or redirect to login page
    echo "<script>alert('Bad request! Database error!') </script>";
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>

    <!-- CSS -->

    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="User-dashboard.css">

    <!-- Boxicons -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Internal CSS -->
    <style>
        body{
            /* background-image: url(https://media.istockphoto.com/id/639392022/vector/bookshelves-background-vector-illustration.jpg?s=612x612&w=0&k=20&c=1DNOwFJabnlqHzShnSHfWOsNBUTtIaOgFBcpGQO_-oQ=); */
            background-size: cover;
            background-color: rgba(197, 189, 228, 0.967);
            /* height: 100%;
            width: 100%; */
        }
        body{
            font-size: 16px;
            font-family: monospace;
            font-weight:600;
            padding-bottom: 30px;
        }
        /* CSS styles for the popup */
        .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
            z-index: 1000; /* ensure popup is on top of other content */
        }
        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        .popup-content p{
            font-size: 15px;
            font-weight: 600;
        }
        form{
            background-color: antiquewhite;
            padding: 20px;
            margin-top: 10vh;
            margin-bottom: 7vh;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            min-width: 600px;
            max-width: 700px;
        }
        h2{
            text-align: center;
            font-size: 30px;
            color: darkblue;
        }
        fieldset{
            border: none;
        }
        label{
            display:block;
            font-size: 20px;
            margin-top:3px;
        }
        input, select{
            width: 100%;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 6px;
            border-radius: 5px;
            font-size: 15pt;
        }
        input[type="text"]{
            width: 100%;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 6px;
            border-radius: 5px;
            font-size: 15pt;

        }

        textarea {
            
                width: 100%;
                margin-top: 5px;
                margin-bottom: 5px;
                padding: 6px;
                border-radius: 5px;
                font-size: 15pt;
        
        }
        button{
            display: inline;
            width: 30%;
            padding: 0.75rem;
            background: #37af65;
            color: inherit;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            font-size: 10pt;
        }
        button:hover{
            background: #e7e7e7;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }

        .container{
            max-width:600px;
            min-width: 500px;
            margin-left: auto;
            margin-right: auto;
            font-size: 17pt;
        }
        .sign{
            margin-left: 10%;
            margin-right: 20%;
            font-size: 13pt;
        }


    </style>
    <!-- JS for Department And paper drop down menu -->
    <script>
        function updatePapers() {
            var departmentSelect = document.getElementById("department");
            var paper1Select = document.getElementById("paper1");
            var paper2Select = document.getElementById("paper2");
            var paper3Select = document.getElementById("paper3");

            // Get the selected department value
            var selectedDepartment = departmentSelect.value;

            // Clear previous options in the paper select inputs
            paper1Select.innerHTML = '';
            paper2Select.innerHTML = '';
            paper3Select.innerHTML = '';

            // Add new options based on the selected department
            if (selectedDepartment === 'COSC') {
                var papersIT = ['COSC101', 'COSC102', 'COSC103', 'COSC201', 'COSC202', 'COSC203', 'COSC301', 'COSC302', 'COSC303', 'COSC401', 'COSC402', 'COSC403', 'COSC501', 'COSC502', 'COSC503', 'COSC601', 'COSC602', 'COSC603'];
                           // Example papers for IT department
                fillSelectOptions(paper1Select, papersIT);
                fillSelectOptions(paper2Select, papersIT);
                fillSelectOptions(paper3Select, papersIT);
            } else if (selectedDepartment === 'MATH') {
                var papersCS = ['MATH101', 'MATH102', 'MATH103', 'MATH201', 'MATH202', 'MATH203', 'MATH301', 'MATH302', 'MATH303', 'MATH401', 'MATH402', 'MATH403', 'MATH501', 'MATH502', 'MATH503', 'MATH601', 'MATH602', 'MATH603'];
                 // Example papers for CS department
                fillSelectOptions(paper1Select, papersCS);
                fillSelectOptions(paper2Select, papersCS);
                fillSelectOptions(paper3Select, papersCS);
            } 
            else if (selectedDepartment === 'PHYS') {
                var papersCS = ['PHYS101', 'PHYS102', 'PHYS103', 'PHYS201', 'PHYS202', 'PHYS203', 'PHYS301', 'PHYS302', 'PHYS303', 'PHYS401', 'PHYS402', 'PHYS403', 'PHYS501', 'PHYS502', 'PHYS503', 'PHYS601', 'PHYS602', 'PHYS603'];

             // Example papers for CS department
                fillSelectOptions(paper1Select, papersCS);
                fillSelectOptions(paper2Select, papersCS);
                fillSelectOptions(paper3Select, papersCS);
            }
            else if (selectedDepartment === 'CHEM') {
                var papersCS = ['CHEM101', 'CHEM102', 'CHEM103', 'CHEM201', 'CHEM202', 'CHEM203', 'CHEM301', 'CHEM302', 'CHEM303', 'CHEM401', 'CHEM402', 'CHEM403', 'CHEM501', 'CHEM502', 'CHEM503', 'CHEM601', 'CHEM602', 'CHEM603'];

                // Example papers for CS department
                fillSelectOptions(paper1Select, papersCS);
                fillSelectOptions(paper2Select, papersCS);
                fillSelectOptions(paper3Select, papersCS);
            }
            else {
                // Default empty array
                var emptyArray = [];
                fillSelectOptions(paper1Select, emptyArray);
                fillSelectOptions(paper2Select, emptyArray);
                fillSelectOptions(paper3Select, emptyArray);
            }
        }

        function fillSelectOptions(selectElement, optionsArray) {
            optionsArray.forEach(function (optionText) {
                var option = document.createElement("option");
                option.text = option.value = optionText;
                selectElement.add(option);
            });
        }
    </script>




</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="image/logo.png" alt="Photo">
                </span>

                <div class="text header-text">
                    <span class="name">Assignment Management system</span>

                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt-2 icon'></i>
                    <input type="search" name="" id="" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="user-dashboard.php">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-upload icon'></i>
                            <span class="text nav-text">Assignment Submit Portal</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="user-add-student.php">
                            <i class='bx bxs-add-to-queue icon'></i>
                            <span class="text nav-text">Add Student</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="moon-sun">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <header>
        <div class="main-header sizeAdjust">
            <span class="text">Assignment Submission Portal</span>
        </div>
    </header>

    <div class="maintainWidth">
    <section class="home">
        <div class="">
            <!-- Popup container -->  
     <div class="popup-container" id="popupContainer">
        <div class="popup-content">
            <h2>Important instruction</h2>
            <p>1.Every Student have to submit all papers at once before submission date or NO PAPER WILL BE ACCEPTED.</p>
            <p>2.Failure to do so will disqualify the student for current academic year.</p>
            <button onclick="closePopup()">Close</button>
        </div>
    </div><!-- JavaScript to control the popup -->
    <script>
        function openPopup() {
            document.getElementById('popupContainer').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popupContainer').style.display = 'none';
        }

        // Call openPopup() when the page finishes loading
        window.onload = function() {
            openPopup();
        };
    </script>
                                         <!-- pop up ends here -->
    <main class="container">
                    <!-- Form Starts here -->
        <form action="assignment-submit-process.php" method="post" >
            <h2>Assignment Submission Portal</h2>
            <fieldset class="">
                <label for="enrollment">Enrollment Id
                    <input type="text" name="enrollment_id" required placeholder="Enter the Enrollment ID"></label>
                    <label for="department">Department</label>
                    <select id="department" name="department" onchange="updatePapers()" required>
                    <option value="" >Choose the department of the student</option>
            
                        <option value="COSC">Computer Science</option>
                        <option value="MATH">Math</option>
                        <option value="PHYS">Physics</option>
                        <option value="CHEM">Chemistry</option>
                    </select>
                    <label for="sem">Semester
                    <select id="sem" name="sem" required>
                    <option value="">Choose the Semester</option>
            
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <label for="paper1">First Paper Code</label>
                    <select id="paper1" name="paper1" required>
                    <option value="" >Choose your paper</option>
                    </select>
                    <label for="paper1_submit">First Paper Submission Status</label>
                    <select id="paper1_submit" name="paper1_submit" required>
                    <option value="" >Choose the following</option>
                    <option value="1" >Submitted</option>
                    <option value="0" >Not Submitted</option>
                    </select>
                    
                    <label for="paper2">Second Paper </label>
                    <select id="paper2" name="paper2" required>
                    <option value="" >Choose your paper</option>
                    </select>
                    <label for="paper2_submit">Second Paper Submission Status:</label>
                    <select id="paper2_submit" name="paper2_submit" required>
                    <option value="" >Choose the following</option>
                    <option value="1" >Submitted</option>
                    <option value="0" >Not Submitted</option>
                    </select>
            
                    <label for="paper3">Third Paper:</label>
                    <select id="paper3" name="paper3" required>
                    <option value="" >Choose your paper</option>
                    </select>
                    <label for="paper3_submit">Third Paper Submission Status:</label>
                    <select id="paper3_submit" name="paper3_submit" required>
                    <option value="" >Choose the following</option>
                    <option value="1">Submitted</option>
                    <option value="0">Not Submitted</option>
                    </select>
                <div>
                    <button name="Register" class="sign" type="submit" onclick="alert('Do You Want to Submit all the Data?')">Submit</button>
                    <button name="resetbutton" style="font-size: 13pt;" type="reset" onclick="alert('Do You Want to all Reset the Data?')">Reset</button>
                </div>
                

            </fieldset>
        </form>
    </main>
        </div>
        

    </section>
    </div>

    <footer>
        <div class="main-footer sizeAdjust">
            <span class="text footer-disclaimer" style="color: white;">
                <p>&copy;Disclaimer:</p>
                <p>This website, developed by Bankim Chandra Das, Arijit Das, Nayanadhir Nandi, and Jagatbandhu Tudu,
                    serves as an assignment management system for educational purposes only. While every effort has been
                    made to ensure its functionality and reliability, users are advised to verify critical information
                    independently. We do not take responsibility for any inaccuracies or disruptions in service. Use at
                    your own discretion.
                </p>
            </span>
            <span class="img"> <img src="image/FooterLogo.png" alt="image" class="footerlogo"> 
                <img src="image/FooterLogo2.png" alt="image" class="footerlogo">
                <img src="image/FooterLogo3.png" alt="image" class="footerlogoEnd">
            </span>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>

<?php
}

else{
    header('Location: index.php'); // Redirect to index page if not logged in
    exit();
    
}

?>