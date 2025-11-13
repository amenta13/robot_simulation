<?php
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Accept multiple input names from your forms and map to API-expected names
$name = trim($_POST['username'] ?? $_POST['email'] ?? $_POST['Name'] ?? '');
$pwd  = $_POST['password'] ?? $_POST['Password'] ?? '';

if ($name === '' || $pwd === '') {
    header('Location: login.php?error=invalid');
    exit;
}

// Set POST keys expected by data_src/api/read.php
$_POST['Name'] = $name;
$_POST['Password'] = $pwd;   // read.php checks this initially
$_POST['password'] = $pwd;   // read.php later references lowercase 'password'

// Include the API script — it will perform authentication, set session and redirect
require_once __DIR__ . '/../data_src/api/read.php';

// If the included script returns here, fallback:
header('Location: login.php?error=server');
exit;
?>