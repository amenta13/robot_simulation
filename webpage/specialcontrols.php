<?php

require_once 'web_elements/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Special Control</title>
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

    <div style="padding:40px; text-align:center;">
        <h1 style="color:#3498db; margin-bottom:40px;">Special Controls</h1>
        <div id="status" style="min-height:30px; margin-bottom:20px; font-weight:bold; color:#333;"></div>
        
        <!-- Image/GIF controls grid -->
        <div class="controls-grid">
            <img class="control-image" src="./web_elements/PUPD.gif" alt="Pick & Put Down Duck" 
                 onclick="PUPDbutt()" title="Pick & Put Down Duck">
            <img class="control-image" src="./web_elements/green.png" alt="Throw Ball" 
                 onclick="TBbutt()" title="Throw Ball">
            <img class="control-image" src="./web_elements/Wave.gif" alt="Wave" 
                 onclick="Wavebutt()" title="Wave">
            <img class="control-image" src="./web_elements/Wiggle.gif" alt="Wiggle" 
                 onclick="Wigglebutt()" title="Wiggle">
        </div>
    </div>

    <script src="func.js"></script>
    <script>
        // Disable keyboard events on this page (mouse-click only)
        document.addEventListener('keydown', (e) => {
            if (['w', 'a', 's', 'd'].includes(e.key.toLowerCase())) {
                e.preventDefault();
            }
        }, true);
    </script>
</body>
</html>

<?php

require_once 'web_elements/footer.php';

?>