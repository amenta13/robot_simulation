<?php
require_once 'web_elements/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <title>Login Page</title>
    </head>
    <body>
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