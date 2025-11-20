<?php
require_once 'web_elements/navbar.php';
// Start session to detect logged-in user
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Determine login state
$isLoggedIn = !empty($_SESSION['loggedin']);
$loggedInUser = $isLoggedIn ? htmlspecialchars($_SESSION['Name']) : null;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <title>Login Page</title>
    </head>
    <body>
        <?php if ($isLoggedIn): ?>
            <div class="loggedin-banner">
                <span>You are currently logged in as <strong><?php echo $loggedInUser; ?></strong></span>
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        <?php endif; ?>

        <div class="page-wrap">
            <div class="login-container">
                <h2>Login</h2>
                <form action="authenticate.php" method="POST">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    
                    <button type="submit">Login</button>
                </form>

                <div class="actions">
                    <span>Don't have an account?</span>
                    <a href="register.php"><button type="button">Register</button></a>
                </div>
            </div>
        </div>
    <?php
    require_once 'web_elements/footer.php';
    ?>
    </body>
</html>