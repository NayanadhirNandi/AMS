<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "ams"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo"<script>
    alert('Connection Failed');
    </script>
    ";
    //die("Connection failed: " . $conn->connect_error);
}
else{
//echo "connection successful";
// echo"<script>
//     alert('Connection Success');
//     </script>
//     ";
}


?>
