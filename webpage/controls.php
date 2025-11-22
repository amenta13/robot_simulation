<?php

require_once 'web_elements/navbar.php';

?>

<!-- Coming soon banner (controls page only) -->
<div class="loggedin-banner" id="coming-soon-banner" role="status" aria-live="polite">
    <strong>Coming soon:</strong> This is an aspirational goal of ours. We hope to eventually have free control 
                                of the robot using the W A S D keys.
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Robot Control</title>
</head>
<body>
    <div class="wasd-container">
        <button id="W" onclick="Wbutt()">W</button>
        <div class="wasd-row">
            <button id="A" onclick="Abutt()">A</button>
            <button id="S" onclick="Sbutt()">S</button>
            <button id="D" onclick="Dbutt()">D</button>
        </div>
    </div>
    <script src="func.js"></script>
</body>
</html>

<?php

require_once 'web_elements/footer.php';

?>