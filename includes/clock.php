<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock</title>
    <style>
        /* Importing Open Sans Condensed Google font */
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@800&display=swap');

        #digital-clock {
         background-color:#e4e9f7;     /* #66ffff; */
        /* width: 35%; */
        margin-top: 0vh ;
        /* padding-top: 50px;
        padding-bottom: 50px;
        padding-left: 50px;
        padding-right: 50px; */
        font-family: "Orbitron",'Open Sans Condensed', sans-serif;
        font-size: 75px;
        color: black;
        text-align: center;
        /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
        }
        .d-image{
            margin-left:10vw;
            margin-right:10vw;
            margin-top:10vh;
            
            padding:0;
        }
    </style>
</head>
<body>
    <div class='d-image'>
        <img src="./image/dashboard-welcome.jpg" alt="dashboard-image">
    </div>
    <div id = "digital-clock"> </div>
    <script>
        function Time() {

        // Creating object of the Date class
        var date = new Date();

        // Get current hour
        var hour = date.getHours();
        // Get current minute
        var minute = date.getMinutes();
        // Get current second
        var second = date.getSeconds();

        // Variable to store AM / PM
        var period = "";

        // Assigning AM / PM according to the current hour
        if (hour >= 12) {
        period = "PM";
        } else {
        period = "AM";
        }

        // Converting the hour in 12-hour format
        if (hour == 0) {
        hour = 12;
        } else {
        if (hour > 12) {
        hour = hour - 12;
        }
        }

        // Updating hour, minute, and second
        // if they are less than 10
        hour = update(hour);
        minute = update(minute);
        second = update(second);

        // Adding time elements to the div
        document.getElementById("digital-clock").innerText = hour + " : " + minute + " : " + second + " " + period;

        // Set Timer to 1 sec (1000 ms)
        setTimeout(Time, 1000);
        }

        // Function to update time elements if they are less than 10
        // Append 0 before time elements if they are less than 10
        function update(t) {
        if (t < 10) {
        return "0" + t;
        }
        else {
        return t;
        }
        }

        Time();
    </script>
</body>
</html>