<?php
require "connect.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
?>

<?php
// Fetch user details from database
$username = $_SESSION['username'];
$sql = "SELECT name FROM admin_details WHERE email = '$username'";
$result = mysqli_query($conn, $sql);

// Check if user details are found
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error or redirect to login page
    echo "<script>alert('Bad request! Database error!') </script>";
    header('Location: admin-login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Dashboard</h1>
    <p>Hello, <?php echo $user['name']; ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
}

else{
    header('Location: admin-login.php'); // Redirect to index page if not logged in
    exit();
    
}

?>