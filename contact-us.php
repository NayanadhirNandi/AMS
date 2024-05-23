<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- main css file of the webpage -->
  <link rel="stylesheet" type="text/css" href="styles.css">

  <!-- favicon for the webpage -->
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">


  <title>Assignment Management System</title>

<style>
        /* Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('image/login-background.jpg'); /* Replace 'your-background-image.jpg' with the path to your image */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    
    }

    .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 120vh;
    padding: 20px;
    }

    .form-container {
    background-color: transparent; /* Transparent background */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Box shadow */
    padding: 20px;
    max-width: 900px; /* Adjust width as needed */
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-left: 10%;
    border-radius: 10px;
    }

    h1 {
    color: white; /* Dark color for heading */
    margin-top: 0; /* Remove default margin */
    font-family: "Poppins", sans-serif;
    font-weight: 700;
    font-style: normal;
    }

    form {
    flex: 1;
    }

    input[type="text"], input[type="email"], input[type="tel"], textarea {
    width: calc(100% - 22px); /* Adjust for padding */
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    background-color: transparent;
    color: white; /* Text color */
    box-shadow: 0px 0px 5px rgba(135, 206, 235, 0.7); /* Sky blue box shadow for input */
    transition: border-color 0.3s ease; /* Added transition */
    font-size: 16px;
    }

    textarea {
    resize: vertical;
    min-height: 100px;
    }

    input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    cursor: pointer;
    font-weight: 500;
    }

    input[type="submit"]:hover {
    background-image: linear-gradient(to bottom, #007bff, skyblue);
    font-weight: bold;
    color: white;
    }

    .image-container {
    flex: 1;
    padding-right: 20px;
    }

    .image-container img {
    width: 27rem;
    height: 25rem;
    border-radius: 5px;
    }

    input[type="text"]:focus, input[type="email"]:focus, input[type="tel"]:focus, textarea:focus {
    border-color: skyblue; /* Added border color when focused */
    }

    input[type="text"]::placeholder, input[type="email"]::placeholder, input[type="tel"]::placeholder, textarea::placeholder {
    color: white; /* Changed placeholder color */
    font-size: 16px;
    }



    @media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .form-container {
        margin-top: 20px;
        flex-direction: column;
    }
    form {
        margin-right: 0;
    }
    .image-container {
        margin-top: 20px;
    }
    }


    @media (max-width: 450px) {
    .container {
        height: auto; /* Removing the height */
        padding: 10px;
        margin-top: 0;
    }

    .form-container {
        margin-left: 0;
        margin-top: 20px;
    }

    .image-container {
        padding-right: 0;
    }

    .image-container img {
        width: 100%;
        height: auto;
    }

    input[type="submit"] {
        width: auto; /* Adjusting the width to fit content */
    }
    }

</style>

</head>
<body>
  <div class="container">
    <div class="form-container">
            <div class="image-container">
        <img src="image/contact-us-right-image.gif" alt="Image"> <!-- Replace 'your-image.jpg' with the path to your image -->
      </div>

      <form action="#" method="post">
        <h1>Contact Us</h1> <!-- Heading -->
        <input type="text" placeholder="Name" required autocomplete="off">
        <input type="email" placeholder="Email" required autocomplete="off">
        <input type="tel" placeholder="Phone Number" required autocomplete="off">
        <textarea placeholder="Message"></textarea required autocomplete="off">
        <input type="submit" value="Submit" onclick="alert('Your massege is send')">
      </form>

    </div>
  </div>
</body>
</html>