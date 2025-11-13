<?php
require_once "../../webpage/site_config_vars.php";
require_once "../includes/db_config.php";
require_once "../classes/RobotDatabase.php";

session_start();

if (!isset($_POST['Name'], $_POST['Password'])) {
    exit('Please complete the form!');
}

$sql = "SELECT * FROM User WHERE Name = :u";
$params=[":u"=> $_POST["Name"]];
$users = RobotDatabase::getDataFromSQL($sql,$params);


if (is_array($users) && count($users) > 0) {
    $password=$users[0]["Password"];
    $id=$users[0]["UserID"];
    $username = $users[0]["Name"];

    if (MD5($salt1 . $_POST["password"] . $salt2) == $password) { 
        session_regenerate_id();
        $_SESSION["loggedin"] = true;
        $_SESSION["Name"] = $username;
        $_SESSION["UserID"] = $id;
        $response = ["status" => "success", "message" => "Login successfull."];
        header("Location: ../../webpage/index.php");
    }
    else {
        $response = ["status" => "Error", "message" => "Incorrect username or password."];
        header("Location: ../../webpage/login.php");
    }
} else {
    $response = ["status" => "Error", "message" => "Incorrect username or password."];
    
    header("Location: ../../webpage/login.php");
}

?>