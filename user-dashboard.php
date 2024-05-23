<?php
require "connect.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
?>

<?php
// Fetch user details from database
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
    <title>User dashboard</title>

    <!-- CSS -->

    <link rel="stylesheet" href="Student_DataEntry.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="User-dashboard.css">

    <!-- Boxicons -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- JavaScript -->

    

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
                        <a href="assignment-submit.php">
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
                    <a href="logout.php" >
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
            <span class="text">User Dashboard</span>
            <!-- <span style="margin-left: 60vw;"> Welcome <?php echo $user['name']; ?></span> -->
        </div>
    </header>

    <div class="maintainWidth">
    <section class="home">
        
       <div>
        <?php require "includes/clock.php"; ?>
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