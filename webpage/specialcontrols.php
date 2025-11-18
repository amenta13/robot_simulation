<?php

require_once 'web_elements/navbar.php';
require_once '../data_src/includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'pupd':
                $sql = "INSERT INTO Instruction (User_UserID, Robot_RobotID, Instruction, Status, Log) VALUES (1, 1, 'Pick up put down', 'Not started', SYSDATE());";
                $successText = "Instruction inserted: Pick up & Put Down Duck";
                break;
            case 'throwball':
                $sql = "INSERT INTO Instruction (User_UserID, Robot_RobotID, Instruction, Status, Log) VALUES (1, 1, 'Throw ball', 'Not started', SYSDATE());";
                $successText = "Instruction inserted: Throw Ball";
                break;
            case 'wave':
                $sql = "INSERT INTO Instruction (User_UserID, Robot_RobotID, Instruction, Status, Log) VALUES (1, 1, 'Wave', 'Not started', SYSDATE());";
                $successText = "Instruction inserted: Wave";
                break;
            case 'wiggle':
                $sql = "INSERT INTO Instruction (User_UserID, Robot_RobotID, Instruction, Status, Log) VALUES (1, 1, 'Wiggle', 'Not started', SYSDATE());";
                $successText = "Instruction inserted: Wiggle";
                break;
            default:
                $sql = null;
        }

        if ($sql) {
            if ($conn->query($sql) === TRUE) {
                $message = $successText;
            } else {
                $message = "SQL Error: " . $conn->error;
            }
        }
    }
}

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
        <div class="speccontrols-grid">

            <!-- PUPD -->
            <form method="POST" style="display:inline-block; text-align:center;">
                <input type="hidden" name="action" value="pupd">
                <button type="submit" style="border:none; background:none;">
                    <img class="speccontrol-image" src="./web_elements/PUPD.gif" alt="Pick Up & Put Down Duck">
                </button>
                <p class="speccontrol-label">Pick & Put Down Duck</p>
            </form>

            <!-- Throw Ball -->
            <form method="POST" style="display:inline-block; text-align:center;">
                <input type="hidden" name="action" value="throwball">
                <button type="submit" style="border:none; background:none;">
                    <img class="speccontrol-image" src="./web_elements/green.png" alt="Throw Ball">
                </button>
                <p class="speccontrol-label">Throw Ball</p>
            </form>

            <!-- Wave -->
            <form method="POST" style="display:inline-block; text-align:center;">
                <input type="hidden" name="action" value="wave">
                <button type="submit" style="border:none; background:none;">
                    <img class="speccontrol-image" src="./web_elements/Wave.gif" alt="Wave">
                </button>
                <p class="speccontrol-label">Wave</p>
            </form>

            <!-- Wiggle -->
            <form method="POST" style="display:inline-block; text-align:center;">
                <input type="hidden" name="action" value="wiggle">
                <button type="submit" style="border:none; background:none;">
                    <img class="speccontrol-image" src="./web_elements/Wiggle.gif" alt="Wiggle">
                </button>
                <p class="speccontrol-label">Wiggle</p>
            </form>
            
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