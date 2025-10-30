<?php

require_once 'web_elements/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Sean Control</title>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <nav>
        <a href="about.php">About</a>
    </nav>
    <nav>
        <a href="login.php">Login</a>
    </nav>
    <button id="W" onclick="Wbutt()">W</button>
    <br>
    <button id="A" onclick="Abutt()">A</button>
    <button id="S" onclick="Sbutt()">S</button>
    <button id="D" onclick="Dbutt()">D</button>
    <script src="func.js"></script>
</body>
<footer>
    <h1 id="Footer">Designed by Andrew Ament, Hunter Rohrbaugh, Braden Scott, and Ryan Woodruff</h1>
</footer>
</html>