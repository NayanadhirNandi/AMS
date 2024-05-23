<?php
ob_start();
  require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="user-login.css" />
<style>
      * {
  margin: 0;
  padding: 0;
}
body {
  font-family: Rubik;
  overflow-x: hidden;
}


nav{
display:flex;
background-color: rgb(126, 43, 204);
justify-content: space-around;
padding:20px 0;
color:rgb(255, 254, 254);

align-items: center;
}
nav.logo{
letter-spacing: 3px;
}
.logo a{
  text-decoration: none;
  color:white;
}
nav ul{
display:flex;
list-style: none;
width:40%;
justify-content: space-between;
}
nav ul li a {
  color:rgb(255, 254, 254);
  text-decoration: none;
  font-size: 1em;
}

.btn{
border-radius: 40px;
}
/*Hamburger */
.menu-bars{
display:none;
flex-direction: column;
height:20px;
justify-content: space-between;
position:relative;
}
.menu-bars input{
position: absolute;
width:40px;
height:28px;
left:-5px;
top:-3px;
opacity: 0;
cursor:pointer;
z-index: 2;
}

.menu-bars span{
display:block;
width:28px;
height:3px;
background-color:rgb(255, 254, 254);
border-radius: 3px;
transition: all 0.3s;
}

.menu-bars span:nth-child(2){
transform-origin: 0 0 ;
}

.menu-bars span:nth-child(4){
  transform-origin: 0 100% ;
  }

.menu-bars input:checked ~ span:nth-child(2){
background-color: white;
transform: rotate(45deg) translate(-1px, -1px);
}
.menu-bars input:checked ~ span:nth-child(4){
  background-color: white;
  transform: rotate(-45deg) translate(-1px,0); 
  }

  .menu-bars input:checked ~ span:nth-child(3){
    opacity: 0;
    transform: scale(0); 
    }


@media only screen and (max-width: 768px){
nav ul{
width:50%;
}

}

@media only screen and (max-width: 576px){
  .menu-bars{
  display:flex;
  }
  nav ul{
  position:absolute;
  right:0;
  top:0;
  width:80%;
  height:100vh;
  justify-content: space-evenly;
  flex-direction: column;
  align-items: center;
  background-color: rgb(126, 43, 204);
  z-index: -1;
  transform: translateX(100%);
  transition: all 1s;
  }
  }
  nav ul.slide{
    transform: translateX(0);
  }
</style>

    <title>Assignment Management System</title>
  </head>
<body>
<nav>
      <div class="logo">
      <h2><a href="index.php">Assignment Management System</a></h2>
    </div>

<ul>
<li><a href="index.php">User Login</a></li>
<li><a href="teacher-login.php">Teacher Login</a></li>
<li><a href="admin-login.php">Admin Login</a></li>
<li><a href="contact-us.php">Contact Us</a></li>
</ul>
<div class="menu-bars">
  <input type="checkbox">
<span></span>
<span></span>
<span></span>
</div>
</nav>

<div class="container">
    <div class="login">
      <div class="login__content">
        <!-- <img class="login__img" src="./assets/img/bg-login.png" alt="Login image" /> -->

        <form class="login__form" method="POST" action="#">
          <div>
            <h1 class="login__title">
              <span>Admin</span> Log In
            </h1>

            <p class="login__description">
              Welcome! Please login to continue.
            </p>
          </div>

          <div>
            <div class="login__inputs">
              <div>
                <label for="email" class="login__label">Email</label>
                <input class="login__input" type="email" id="email" name="email" placeholder="Enter your email address" required />
              </div>

              <div>
                <label for="password" class="login__label">Password</label>
                <div class="login__box">
                  <input class="login__input" type="password" id="password" name="password" placeholder="Enter your password" required />
                  <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                </div>
              </div>
            </div>

            <div class="login__check">
              <label class="login__check-label" for="check">
                <input class="login__check-input" type="checkbox" id="check" />
                <i class="ri-check-line login__check-icon"></i>
                Remember me
              </label>
            </div>
          </div>

          <div>
            <div class="login__buttons">
              <button class="login__button">Log In</button>
              
            </div>

            <!-- <a class="login__forgot" href="#">Forgot Password?</a> -->
          </div>
        </form>
      </div>
    </div>
  </div>

<!--=============== MAIN JS ===============-->
<script>
    /*=============== SHOW HIDDEN - PASSWORD ===============*/
const showHiddenPassword = (inputPassword, inputIcon) => {
  const input = document.getElementById(inputPassword),
        iconEye = document.getElementById(inputIcon)

  iconEye.addEventListener('click', () => {
    // Change password to text
    if (input.type === 'password') {
      // Switch to text
      input.type = 'text'

      // Add icon
      iconEye.classList.add('ri-eye-line')

      // Remove icon
      iconEye.classList.remove('ri-eye-off-line')
    } else {
      // Change to password
      input.type = 'password'

      // Remove icon
      iconEye.classList.remove('ri-eye-line')

      // Add icon
      iconEye.classList.add('ri-eye-off-line')
    }
  })
}

showHiddenPassword('password', 'input-icon')
</script>
    
</body>
</html>


<?php
// Login form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_email = test_input($_POST["email"]);
  $input_password = test_input($_POST["password"]);

  $sql = "SELECT * FROM admin_details WHERE email='$input_email'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
    if ( $input_password == $user_data['password']) {
      // Login successful, redirect to dashboard
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $input_email;
      header("Location: admin-dashboard.php");
      exit;
    } else {
      //$error = "Invalid password";
      echo "<script>
            alert('Invalid Email or Password');
            </script>";
    }
  } else {
    echo "<script>
            alert('Invalid Email or Password');
            </script>";
    $error = "Email not found";
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

ob_end_flush()
?>