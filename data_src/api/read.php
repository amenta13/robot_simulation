<?php
require_once __DIR__ . "/../../webpage/site_config_vars.php";
require_once __DIR__ . "/../includes/db_config.php";
require_once __DIR__ . "/../classes/RobotDatabase.php";

session_start();

// Expect Name and Password keys
if (!isset($_POST['Name'], $_POST['Password'])) {
    header('Location: /webpage/login.php?error=invalid');
    exit();
}

$sql = "SELECT * FROM `User` WHERE Name = :u";
$params=[":u"=> $_POST["Name"]];
$users = RobotDatabase::getDataFromSQL($sql,$params);

if (is_array($users) && count($users) > 0) {
    $passwordHash = $users[0]["Password"];
    $id = $users[0]["UserID"];
    $username = $users[0]["Name"];

    // Compare using the configured salts and lowercase/uppercase consistency
    $incoming = isset($_POST['password']) ? $_POST['password'] : $_POST['Password'];
    if (MD5($salt1 . $incoming . $salt2) === $passwordHash) {
        session_regenerate_id(true);
        $_SESSION["loggedin"] = true;
        $_SESSION["Name"] = $username;
        $_SESSION["UserID"] = $id;
        header('Location: /webpage/index.php');
        exit();
    } else {
        header('Location: /webpage/login.php?error=invalid');
        exit();
    }
} else {
    header('Location: /webpage/login.php?error=invalid');
    exit();
}

?>