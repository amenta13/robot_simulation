<?php

require_once 'web_elements/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <title>Login Page</title>
        <nav>
            <a href="controls.php">Controls</a>
        </nav>
        <nav>
            <a href="about.php">About</a>
        </nav>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </head>
    <body>
        <div class="login-container">
            <h2>Login</h2>
            <form action="authenticate.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>

<?php

require_once 'web_elements/footer.php';

?>