<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? $_POST['email'] ?? $_POST['user'] ?? '');
    $pwd  = $_POST['password'] ?? '';

    if ($user === '' || $pwd === '') {
        header('Location: register.php?error=invalid');
        exit;
    }

    // Map to keys expected by data_src/api/create.php
    $_POST['user'] = $user;
    $_POST['password'] = $pwd;

    // Include the create API; it will insert and redirect back to login.php on success/failure
    require_once __DIR__ . '/../data_src/api/create.php';

    // If included script returns here, fallback:
    header('Location: login.php?error=server');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php require_once 'web_elements/navbar.php'; ?>
    <div class="login-container">
        <h2>Register</h2>
        <form method="post" novalidate>
            <label>Username: <input type="text" name="username" required></label><br>
            <label>Password: <input type="password" name="password" required minlength="8"></label><br>
            <p>Password must contain between 8 and 20 characters, a capital letter, a lowercase letter, a number, and a special character.</p>
            <button type="submit">Register</button>
        </form>
        <p><a href="login.php">Back to login</a></p>
    </div>
    <?php require_once 'web_elements/footer.php'; ?>
</body>
</html>