<?php
 $display_errors = true; // set to false in production
 if ($display_errors) {
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
 }

require_once __DIR__ . "/../../webpage/site_config_vars.php";
require_once __DIR__ . "/../includes/db_config.php";
require_once __DIR__ . "/../classes/RobotDatabase.php";
session_start();

// Validate incoming POST keys
if (!isset($_POST['user'], $_POST['password'])) {
    header('Location: /webpage/register.php?error=invalid_input');
    exit();
}

$username = trim($_POST['user']);
$rawpassword = $_POST['password'];

if ($username === '' || $rawpassword === '') {
    header('Location: /webpage/register.php?error=invalid_input');
    exit();
}

// Check if username already exists
$qry = "SELECT * FROM `User` WHERE Name = :u";
$params = [":u"=> $username];
$users = RobotDatabase::getDataFromSQL($qry,$params);

if (is_array($users) && count($users) > 0) {
    // Username exists
    header('Location: /webpage/register.php?error=User+already+exists');
    exit();
}

// Password policy
$minlength = 8;
$maxlength = 20;
if (!(strlen($rawpassword) >= $minlength && strlen($rawpassword) <= $maxlength && preg_match('/[A-Z]/', $rawpassword) && preg_match('/[a-z]/', $rawpassword) && preg_match('/[0-9]/', $rawpassword) && preg_match('/[^A-Za-z0-9]/', $rawpassword))) {
    $password_error_message = "Password needs to contain between 8 and 20 characters, a capital letter, a lowercase letter, a number, and a special character.";
    echo "<script> alert(" . json_encode($password_error_message) . "); window.history.back(); </script>";
    exit();
}

$hashed_password = MD5($salt1 . $rawpassword . $salt2);

// Insert user
$sql = "INSERT INTO `User` (`Name`, `Password`) VALUES (:u, :p);";
$params = [":u" => $username, ":p" => $hashed_password];
try {
    $insertId = RobotDatabase::executeSQL($sql,$params, true);
    if ($insertId) {
        header('Location: /webpage/login.php');
        exit();
    } else {
        // Unknown error
        if ($display_errors) echo "Database insert failed.";
        header('Location: /webpage/register.php?error=server');
        exit();
    }
} catch (Exception $e) {
    if ($display_errors) {
        echo "Database error: " . htmlspecialchars($e->getMessage());
    }
    http_response_code(500);
    exit();
}
?>