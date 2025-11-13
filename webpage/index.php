<?php

require_once 'web_elements/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <title>Home Page</title>
        <nav>
            <a href="controls.php">Controls</a>
        </nav>
        <nav>
            <a href="about.php">About</a>
        </nav>
        <nav>
            <a href="login.php">Login</a>
        </nav>
    </head>
    <body>
        <h1 style="text-align:center;font-weight:bold;font-size: 110px;color:#3498db;">Robot Arm Project</h1>
        <h2 style="text-align:center;font-size: 25px;color:#084873;">This website pairs with the MyCobot robotic arm from Elephant Robotics to demonstrate web design, database management, and programming. Navigate to the "Controls or Special Controls" page to input commands to the arm over the web or visit the "About" page to learn more.</h2>
        <img src="./web_elements/robotic-arm.gif" alt="" style="width:200px;height:auto;display:block;margin:0 auto;">
    </body>
</html>

<?php

require_once 'web_elements/footer.php';

?>